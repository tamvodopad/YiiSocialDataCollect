<?php

/**
 * This is the model class for table "social_data".
 *
 * The followings are the available columns in table 'social_data':
 * @property integer $id
 * @property integer $social_type_id
 * @property integer $data_id
 * @property integer $status
 * @property string $data
 * @property string $created
 *
 * The followings are the available model relations:
 * @property SocialTypes $socialTypes
 */
class SocialData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'social_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('social_type_id, data_id, data', 'required'),
			array('social_type_id, status', 'numerical', 'integerOnly'=>true),
		//	array('data', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, social_type_id, data_id, status, data, created', 'safe', 'on'=>'search'),
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
			
			'socialTypes' => array(self::BELONGS_TO, 'SocialTypes', 'social_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'social_type_id' => 'Id of social type',
			'data_id' => 'Id of social type',
			'status' => 'Published status for this content',
			'data' => 'raw json data of single post',
			'created' => 'Created',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('social_type_id',$this->social_type_id);
		$criteria->compare('data_id',$this->data_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SocialData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
