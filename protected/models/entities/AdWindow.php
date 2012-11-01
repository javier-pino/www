<?php

/**
 * This is the model class for table "ad_window".
 *
 * The followings are the available columns in table 'ad_window':
 * @property string $AD_Window_ID
 * @property string $Name
 * @property string $Module
 * @property string $DocumentDir
 * @property string $Class
 *
 * The followings are the available model relations:
 * @property AdRoleWindows[] $adRoleWindows
 */
class AdWindow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdWindow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ad_window';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Module, Class', 'required'),
			array('Name, Module, DocumentDir', 'length', 'max'=>60),
			array('Class', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AD_Window_ID, Name, Module, DocumentDir, Class', 'safe', 'on'=>'search'),
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
			'adRoleWindows' => array(self::HAS_MANY, 'AdRoleWindows', 'AD_Window_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AD_Window_ID' => 'Ad Window',
			'Name' => 'Name',
			'Module' => 'Module',
			'DocumentDir' => 'Document Dir',
			'Class' => 'Class',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('AD_Window_ID',$this->AD_Window_ID,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Module',$this->Module,true);
		$criteria->compare('DocumentDir',$this->DocumentDir,true);
		$criteria->compare('Class',$this->Class,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}