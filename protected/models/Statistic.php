<?php

/**
 * This is the model class for table "statistic".
 *
 * The followings are the available columns in table 'statistic':
 * @property string $sid
 * @property string $kid
 * @property integer $year
 * @property integer $month
 * @property integer $shows
 */
class Statistic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'statistic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kid, year, month', 'required'),
			array('year, month, shows', 'numerical', 'integerOnly'=>true),
			array('kid', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sid, kid, year, month, shows', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            'keywords'=>array(self::HAS_ONE, 'Keywords', array('kid'=>'kid')),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sid' => 'Sid',
			'kid' => 'Kid',
			'year' => 'Year',
			'month' => 'Month',
			'shows' => 'Shows',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($defaultCriteria = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = $defaultCriteria != null ? $defaultCriteria : new CDbCriteria;

		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('kid',$this->kid,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('month',$this->month);
		$showsArr = explode(',', $this->shows);
		if(count($showsArr)>=2){
			foreach ($showsArr as $show)
			$criteria->compare('shows',trim($show));
		} else{
			$criteria->compare('shows',$this->shows);
		}
		$criteria->order = '`t`.kid, `t`.shows';
		$criteria->with = array('keywords'=>
							array(
								'select'=>array('name'),
								'joinType'=>'INNER JOIN',
							));
		//$criteria->together = TRUE;
		//составляем критерий запроса
		$request = Yii::app()->request;
		
		$keywordParams = $request->getQuery("Keywords");
		if(isset($keywordParams['name'])&&
		   ($name = $keywordParams['name'])){
			$criteria->addSearchCondition('keywords.name', $name);
		}
		
		$sort = new CSort();
		$sort->attributes = array(
			'keywords.name' => array(
				'asc' => 'keywords.name',
				'desc' => 'keywords.name desc',
			),
			'year',
			'month',
			'shows',
		);
		
		return new CActiveDataProvider('Statistic', array(
				'criteria'=>$criteria,
				//'sort'=>$sort,
				'pagination' => array(
						'pageSize' => Yii::app()->params['itemsPerPage'],
				),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Statistic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
