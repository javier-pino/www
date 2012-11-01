<?php

/**
 * This is the model class for table "ad_user".
 *
 * The followings are the available columns in table 'ad_user':
 * @property string $AD_User_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Login
 * @property string $Name
 * @property string $Description
 * @property string $Comments
 * @property string $Password
 * @property string $Email
 * @property string $Phone
 * @property string $Phone2
 * @property string $Birthday
 * @property string $Supervisor_ID
 * @property integer $Is_Active
 *
 * The followings are the available model relations:
 * @property AdRole[] $adRoles
 * @property AdRole[] $adRoles1
 * @property AdRoleWindows[] $adRoleWindows
 * @property AdRoleWindows[] $adRoleWindows1
 * @property AdUser $updatedBy
 * @property AdUser[] $adUsers
 * @property AdUser $supervisor
 * @property AdUser[] $adUsers1
 * @property AdUser $createdBy
 * @property AdUser[] $adUsers2
 * @property AdUserRoles[] $adUserRoles
 * @property AdUserRoles[] $adUserRoles1
 * @property AdUserRoles[] $adUserRoles2
 * @property CBpartner[] $cBpartners
 * @property CBpartner[] $cBpartners1
 * @property CUom[] $cUoms
 * @property CUom[] $cUoms1
 * @property MAttribute[] $mAttributes
 * @property MAttribute[] $mAttributes1
 * @property MAttributeinstance[] $mAttributeinstances
 * @property MAttributeinstance[] $mAttributeinstances1
 * @property MAttributesetinstance[] $mAttributesetinstances
 * @property MAttributesetinstance[] $mAttributesetinstances1
 * @property MAttributesetuse[] $mAttributesetuses
 * @property MAttributesetuse[] $mAttributesetuses1
 * @property MAttributevalue[] $mAttributevalues
 * @property MAttributevalue[] $mAttributevalues1
 * @property MLocator[] $mLocators
 * @property MLocator[] $mLocators1
 * @property MLot[] $mLots
 * @property MLot[] $mLots1
 * @property MStorage[] $mStorages
 * @property MStorage[] $mStorages1
 * @property MStorageHistorical[] $mStorageHistoricals
 * @property MStorageHistorical[] $mStorageHistoricals1
 * @property MSupply[] $mSupplies
 * @property MSupply[] $mSupplies1
 * @property MSupplywarehouse[] $mSupplywarehouses
 * @property MSupplywarehouse[] $mSupplywarehouses1
 */
class AdUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdUser the static model class
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
		return 'ad_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, Login, Name, Password', 'required'),
			array('Is_Active', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, UpdatedBy, Supervisor_ID', 'length', 'max'=>20),
			array('Login, Name', 'length', 'max'=>60),
			array('Phone, Phone2', 'length', 'max'=>45),
			array('Updated, Description, Comments, Email, Birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AD_User_ID, Created, CreatedBy, Updated, UpdatedBy, Login, Name, Description, Comments, Password, Email, Phone, Phone2, Birthday, Supervisor_ID, Is_Active', 'safe', 'on'=>'search'),
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
			'adRoles' => array(self::HAS_MANY, 'AdRole', 'UpdatedBy'),
			'adRoles1' => array(self::HAS_MANY, 'AdRole', 'CreatedBy'),
			'adRoleWindows' => array(self::HAS_MANY, 'AdRoleWindows', 'UpdatedBy'),
			'adRoleWindows1' => array(self::HAS_MANY, 'AdRoleWindows', 'CreatedBy'),
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
			'adUsers' => array(self::HAS_MANY, 'AdUser', 'UpdatedBy'),
			'supervisor' => array(self::BELONGS_TO, 'AdUser', 'Supervisor_ID'),
			'adUsers1' => array(self::HAS_MANY, 'AdUser', 'Supervisor_ID'),
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'adUsers2' => array(self::HAS_MANY, 'AdUser', 'CreatedBy'),
			'adUserRoles' => array(self::HAS_MANY, 'AdUserRoles', 'AD_User_ID'),
			'adUserRoles1' => array(self::HAS_MANY, 'AdUserRoles', 'CreatedBy'),
			'adUserRoles2' => array(self::HAS_MANY, 'AdUserRoles', 'UpdatedBy'),
			'cBpartners' => array(self::HAS_MANY, 'CBpartner', 'UpdatedBy'),
			'cBpartners1' => array(self::HAS_MANY, 'CBpartner', 'CreatedBy'),
			'cUoms' => array(self::HAS_MANY, 'CUom', 'UpdatedBy'),
			'cUoms1' => array(self::HAS_MANY, 'CUom', 'CreatedBy'),
			'mAttributes' => array(self::HAS_MANY, 'MAttribute', 'UpdatedBy'),
			'mAttributes1' => array(self::HAS_MANY, 'MAttribute', 'CreatedBy'),
			'mAttributeinstances' => array(self::HAS_MANY, 'MAttributeinstance', 'CreatedBy'),
			'mAttributeinstances1' => array(self::HAS_MANY, 'MAttributeinstance', 'UpdatedBy'),
			'mAttributesetinstances' => array(self::HAS_MANY, 'MAttributesetinstance', 'CreatedBy'),
			'mAttributesetinstances1' => array(self::HAS_MANY, 'MAttributesetinstance', 'UpdatedBy'),
			'mAttributesetuses' => array(self::HAS_MANY, 'MAttributesetuse', 'CreatedBy'),
			'mAttributesetuses1' => array(self::HAS_MANY, 'MAttributesetuse', 'UpdatedBy'),
			'mAttributevalues' => array(self::HAS_MANY, 'MAttributevalue', 'CreatedBy'),
			'mAttributevalues1' => array(self::HAS_MANY, 'MAttributevalue', 'UpdatedBy'),
			'mLocators' => array(self::HAS_MANY, 'MLocator', 'CreatedBy'),
			'mLocators1' => array(self::HAS_MANY, 'MLocator', 'UpdatedBy'),
			'mLots' => array(self::HAS_MANY, 'MLot', 'CreatedBy'),
			'mLots1' => array(self::HAS_MANY, 'MLot', 'UpdatedBy'),
			'mStorages' => array(self::HAS_MANY, 'MStorage', 'CreatedBy'),
			'mStorages1' => array(self::HAS_MANY, 'MStorage', 'UpdatedBy'),
			'mStorageHistoricals' => array(self::HAS_MANY, 'MStorageHistorical', 'CreatedBy'),
			'mStorageHistoricals1' => array(self::HAS_MANY, 'MStorageHistorical', 'UpdatedBy'),
			'mSupplies' => array(self::HAS_MANY, 'MSupply', 'CreatedBy'),
			'mSupplies1' => array(self::HAS_MANY, 'MSupply', 'UpdatedBy'),
			'mSupplywarehouses' => array(self::HAS_MANY, 'MSupplywarehouse', 'CreatedBy'),
			'mSupplywarehouses1' => array(self::HAS_MANY, 'MSupplywarehouse', 'UpdatedBy'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AD_User_ID' => 'Ad User',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Login' => 'Login',
			'Name' => 'Name',
			'Description' => 'Description',
			'Comments' => 'Comments',
			'Password' => 'Password',
			'Email' => 'Email',
			'Phone' => 'Phone',
			'Phone2' => 'Phone2',
			'Birthday' => 'Birthday',
			'Supervisor_ID' => 'Supervisor',
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

		$criteria->compare('AD_User_ID',$this->AD_User_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Login',$this->Login,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Comments',$this->Comments,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Phone2',$this->Phone2,true);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('Supervisor_ID',$this->Supervisor_ID,true);
		$criteria->compare('Is_Active',$this->Is_Active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}