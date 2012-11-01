<?php

/**
 * This is the model class for table "ad_role".
 *
 * The followings are the available columns in table 'ad_role':
 * @property string $AD_Role_ID
 * @property string $Finder
 * @property string $Name
 * @property string $Description
 * @property string $AD_Tree_Menu_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property integer $Is_Active
 *
 * The followings are the available model relations:
 * @property AdUser $updatedBy
 * @property AdUser $createdBy
 * @property AdRoleWindows[] $adRoleWindows
 * @property AdUserRoles[] $adUserRoles
 */
class AdRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdRole the static model class
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
		return 'ad_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Finder, Name, Description, Created', 'required'),
			array('Is_Active', 'numerical', 'integerOnly'=>true),
			array('Finder, Name', 'length', 'max'=>60),
			array('AD_Tree_Menu_ID, CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AD_Role_ID, Finder, Name, Description, AD_Tree_Menu_ID, Created, CreatedBy, Updated, UpdatedBy, Is_Active', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'adRoleWindows' => array(self::HAS_MANY, 'AdRoleWindows', 'AD_Role_ID'),
			'adUserRoles' => array(self::HAS_MANY, 'AdUserRoles', 'AD_Role_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AD_Role_ID' => 'Ad Role',
			'Finder' => 'Finder',
			'Name' => 'Name',
			'Description' => 'Description',
			'AD_Tree_Menu_ID' => 'Ad Tree Menu',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Is_Active' => 'Is Active',
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

		$criteria->compare('AD_Role_ID',$this->AD_Role_ID,true);
		$criteria->compare('Finder',$this->Finder,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('AD_Tree_Menu_ID',$this->AD_Tree_Menu_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Is_Active',$this->Is_Active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}