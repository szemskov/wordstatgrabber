<?php
class GrabberCommand extends CConsoleCommand {
    /**
     * обработчик консольного граббера
     * задача - запустить выборку за сегодняшний день
     */
    public function actionCreate($limit=10) {
    	//return;
        $error = false;
        //текущее время
        $time = time();
        $date = getdate(strtotime('-1 month'));
        //обработчик яндекса
        $api = Yii::app()->params['yandex']['api_uri'];
        $method = Yii::app()->params['yandex']['methods']['create'];
        //есть необработанные отчеты не грузим базу
        $rep_cnt = Report::model()->count();
        if($rep_cnt>=10) return 0;

        //вытаскиваем приложение которое сегодня еще не запускалось
        $app = Applications::model()->find("timestamp < :time and token <> '' ORDER BY rand()",
                                           array(':time'=>$time-24*3600));
        
        if($app){
            //фиксируем время запуска чтобы не запускать вновь
            if($app->limit-$limit<=0&&
               $app->timestamp==0){
                $app->timestamp = $time;
            }
            //если наступил новый день обновляем параметры приложения
            if($app->timestamp>0 && $app->limit<=0){
            	$app->limit = 1000;
            	$app->timestamp = 0;
            	$app->count = 0;
            }
            $app->limit-=$limit;
            $app->save(false);
            $words = Keywords::model()->with(array(
                         'statistic'=>array(
                             // записи нам не нужны
                             'select'=>false,
                             // но нужно выбрать только ключевики у которых нет данных за прошлый месяц
                             'joinType'=>'LEFT JOIN',
                             'on'=>'statistic.year=:year and statistic.month=:mon',
                             'condition'=>'statistic.shows is NULL',
                             'params'=>array(':year'=>$date['year'],':mon'=>$date['mon']),
                         ),
                     ))->findAll(array('limit'=>$limit,'together'=>true));

            // входные данные
            $params = array(
                'Phrases' => array(),
            );

            foreach ($words as $w){
                //обработка текста под требования Yandex
                //Only letters from the English, Turkish, Kazakh, Russian, and Ukrainian alphabets can be used in the text
                //of key phrases, quotes, round brackets, quotes, symbols "-", "+", "!", and spaces
                $safe_name = trim(preg_replace('/[^a-zA-ZА-Яа-яЁё0-9\s]/u','',$w->name));
                //A keyword phrase cannot contain more than 7 words
                $safe_name = implode(' ', array_slice(explode(' ', $safe_name), 0, 7));

                if($safe_name!=$w->name){
                    $w->name = $safe_name;
                    if($dub = Keywords::model()->find('name like :name',array(':name'=>$safe_name.'%'))){
                        $dub->delete();
                    }

                    $w->save(false);
                }
                echo "'",$w->name,"'",' ',"'",$safe_name,"'","\n";
                $params['Phrases'][] = utf8_encode($safe_name);
                //сохраняем пустую запись в статистике чтобы в след раз были выбраны новые слова
                $st = new Statistic;
                $st->kid = $w->kid;
                $st->year = $date['year'];
                $st->month = $date['mon'];
                $st->shows = 0;
                $st->save(false);
            }
            // формирование запроса
            $request = array(
                'application_id' => $app->application_id,
                'token' => $app->token,
                'login' => $app->login,
                'method'=> $method,
                'param' => $params,
            );

            // отправляем запрос и получаем ответ от сервера
            $result = $this->_send($api, $request);
            if($result){
                // Добавляем отчет в очередь для ожидания результата
                $returnValue = json_decode($result, true);
                if(!empty($returnValue['data'])){
                    $report = new Report;
                    $report->num = $returnValue['data'];
                    $report->aid = $app->aid;
                    $report->save(false);
                    //echo "Отчет $report->num создан\r\n";
                } else {
                    $error = 'Api сервер не вернул данные'."\r\n".(isset($returnValue['error_detail'])?$returnValue['error_detail']:'');
                    if($returnValue['error_code']==31){
                    	//'Report queue already contains 5 requests'
                    	//clear list
                    	$this->actionListClear($app->aid);
                    }
                }
            } else {
                $error = 'Нет ответа от api сервера';
            }
        } else {
            $error = 'Нет доступных приложений для запуска скрипта';
        }
        if($error){
            echo $error,"\r\n";
            return 1;
        }
        return 0;
    }

    /**
     * обработчик консольного граббера
     * задача - обработка отчетов
     */
    public function actionReport($report=0) {
        //обработчик яндекса
        $api = Yii::app()->params['yandex']['api_uri'];
        $method = Yii::app()->params['yandex']['methods']['report'];

        if(!$report){
        	//выбираем любой отчет
        	//$criteria = new CDbCriteria;
        	//$criteria->order = '`t`.kid, `t`.shows';
        	$rep = Report::model()->find();
        } else {
        	//выбираем отчет 
        	$rep = Report::model()->findByPk($report);
        }
        if(!$rep) return 0;
        //вытаскиваем приложение
        $app = Applications::model()->findByPk($rep->aid);

        $request = array(
            'application_id' => $app->application_id,
            'token' => $app->token,
            'login' => $app->login,
            'method'=> $method,
            'param' => $rep->num,
        );

        // отправляем запрос и получаем ответ от сервера
        $result = $this->_send($api, $request);
		$cnt=0;
        if($result){
            $res = json_decode($result,true);

            $date = getdate(strtotime('-1 month')); //показы за прошлый месяц
            if(isset($res['data'])){

                foreach ($res['data'] as $item){
                    foreach ($item as $k=>$v){
                        //обрабатываем массивы поисковых фраз
                        if(in_array($k, array('SearchedWith', 'SearchedAlso'))){
                            foreach ($v as $key){
                                //поиск фразы в базе если нет добавляем
                                $phrase = Keywords::model()->find('name=:name',array(':name'=>$key['Phrase']));
                                if(!$phrase){
                                    $phrase = new Keywords;
                                    $phrase->name = $key['Phrase'];
                                    $phrase->save(false);
                                }
                                //проверяем есть ли статистика за указнный период
                                $st = Statistic::model()->find('kid=:kid and year=:year and month=:month',
                                                               array(':kid'=>$phrase->kid,':year'=>$date['year'],':month'=>$date['mon']));
                                if(!$st){
                                    $st = new Statistic;
                                }
                                //обновляем также статистику поисковой фразы за предыдущий месяц
                                $st->kid = $phrase->kid;
                                $st->year = $date['year'];
                                $st->month = $date['mon'];
                                $st->shows = $key['Shows'];
                                $st->save(false);
                                $cnt++;
                                echo $phrase->kid,' --- ', $st->sid, ' --- ', $key['Phrase'], ' ', $key['Shows'], PHP_EOL;
                            }
                        }
                    }

                }
            } else {
                var_dump($result);
            }

            $this->actionDelete($app->aid, $rep->num);
            $rep->delete();
            $app->count+=$cnt;
            $app->save(false);
        }
    }

    public function actionDelete($app_id, $report_id) {
        //TODO:: add ralation to Report with App
        $app = Applications::model()->findByPk($app_id);
        $api = Yii::app()->params['yandex']['api_uri'];
        //удаляем отчет из базы яндекса
        $request = array(
            'application_id' => $app->application_id,
            'token' => $app->token,
            'login' => $app->login,
            'method'=> Yii::app()->params['yandex']['methods']['delete'],
            'param' => $report_id,
        );

        // отправляем запрос и получаем ответ от сервера
        $result = $this->_send($api, $request);
        echo 'App: ', $app_id,' Report: ', $report_id," was delete\r\n";
    }
    
    public function actionListClear($app_id) {
    	$app = Applications::model()->findByPk($app_id);
    	$api = Yii::app()->params['yandex']['api_uri'];
    	//выбираем отчеты из базы яндекса
    	$request = array(
    			'application_id' => $app->application_id,
    			'token' => $app->token,
    			'login' => $app->login,
    			'method'=> Yii::app()->params['yandex']['methods']['list'],
    	);
    
    	// отправляем запрос и получаем ответ от сервера
    	$result = $this->_send($api, $request);
    	//{"data":[{"StatusReport":"Done","ReportID":22841531},{"StatusReport":"Done","ReportID":22841536},{"StatusReport":"Done","ReportID":22841700},{"StatusReport":"Done","ReportID":22841752},{"StatusReport":"Done","ReportID":22842235}]}
    	if($r = json_decode($result,true)){
    		foreach ($r['data'] as $item){
    			if($item['StatusReport']=='Done'){
    				//echo $item['ReportID'];
    				$this->actionDelete($app->aid,$item['ReportID']);
    			}
    		}
    	}
    }

    private function _send($url, $request){
        // преобразование в JSON-формат
        $request = json_encode($request);

        // параметры запроса
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'header' => "".
                "Connection: close\r\n".
                "Content-Length: ".strlen($request)."\r\n".
                "Content-type: "."application/x-www-form-urlencoded"."\r\n",
                'content'=>$request,
                'timeout'=>120
            )
        );
        // создание контекста потока
        $context = stream_context_create($opts);

        return file_get_contents($url, 0, $context);
    }
}