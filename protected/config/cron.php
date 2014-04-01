<?php
return array(
    // У вас этот путь может отличаться. Можно подсмотреть в config/main.php.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Grabber Yandex Wordstat 1.0',

    'preload'=>array('log'),

    'import'=>array(
        'application.components.*',
        'application.models.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.eauth.services.*',
    ),
    // Копирование yiic.php и console.php было сделано ради
    // перенаправления журнала для cron в отдельные файлы:
    'components'=>array(
        /*'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),*/

        // Соединение с СУБД
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=wordstatgrabber',
            'emulatePrepare' => true,
            'username' => 'wordstat',
            'password' => '100lica',
            'charset' => 'utf8',
        ),
    		'log'=>array(
    				'class'=>'CLogRouter',
    				'routes'=>array(
    						array(
    								'class'=>'CFileLogRoute',
    								'logFile'=>'cron.log',
    								'levels'=>'error, warning',
    						),
    						array(
    								'class'=>'CFileLogRoute',
    								'logFile'=>'cron_trace.log',
    								'levels'=>'profile',
    						),
    				),
    		),
    ),
    'params'=>array(
         'yandex'=>array(
             'api_uri' => 'https://api.direct.yandex.ru/v4/json/',
             'methods' => array(
                  'create' => 'CreateNewWordstatReport',
                  'report' => 'GetWordstatReport',
                  'delete' => 'DeleteWordstatReport',
             	  'list' => 'GetWordstatReportList',
             )
         ),
     )
);