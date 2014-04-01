<?php

/**
 * This is the model class for table "applications".
 *
 * The followings are the available columns in table 'applications':
 * @property string $aid
 * @property string $login
 * @property string $application_id
 * @property string $token
 * @property integer $limit
 * @property integer $count
 * @property integer $timestamp
 */
class Applications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('limit, count, timestamp', 'numerical', 'integerOnly'=>true),
			array('login, application_id, token', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('aid, login, application_id, token, limit, count, timestamp', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'aid' => 'id',
			'login' => 'User account login',
			'application_id' => 'Client ID',
			'token' => 'token',
			'limit' => 'limit',
			'count' => 'count',
			'timestamp' => 'last execution time',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('aid',$this->aid,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('limit',$this->limit);
		$criteria->compare('count',$this->count);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
					'pageSize' => Yii::app()->params['itemsPerPage'],
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Applications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
