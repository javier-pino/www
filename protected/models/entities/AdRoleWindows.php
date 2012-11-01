<?php

/**
 * This is the model class for table "ad_role_windows".
 *
 * The followings are the available columns in table 'ad_role_windows':
 * @property string $AD_Role_Windows_ID
 * @property string $AD_Role_ID
 * @property string $AD_Window_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 *
 * The followings are the available model relations:
 * @property AdUser $updatedBy
 * @property AdRole $aDRole
 * @property AdWindow $aDWindow
 * @property AdUser $createdBy
 */
class AdRoleWindows extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdRoleWindows the static model class
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
		return 'ad_role_windows';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AD_Role_ID, AD_Window_ID, Created, CreatedBy', 'required'),
			array('AD_Role_ID, AD_Window_ID, CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AD_Role_Windows_ID, AD_Role_ID, AD_Window_ID, Created, CreatedBy, Updated, UpdatedBy', 'safe', 'on'=>'search'),
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
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
			'aDRole' => array(self::BELONGS_TO, 'AdRole', 'AD_Role_ID'),
			'aDWindow' => array(self::BELONGS_TO, 'AdWindow', 'AD_Window_ID'),
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AD_Role_Windows_ID' => 'Ad Role Windows',
			'AD_Role_ID' => 'Ad Role',
			'AD_Window_ID' => 'Ad Window',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
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

		$criteria->compare('AD_Role_Windows_ID',$this->AD_Role_Windows_ID,true);
		$criteria->compare('AD_Role_ID',$this->AD_Role_ID,true);
		$criteria->compare('AD_Window_ID',$this->AD_Window_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}