<?php

/**
 * This is the model class for table "c_bpartner".
 *
 * The followings are the available columns in table 'c_bpartner':
 * @property string $C_BPartner_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $RIF
 * @property string $Name
 * @property string $LegalName
 * @property string $Description
 * @property string $Rating
 * @property integer $Is_Active
 *
 * The followings are the available model relations:
 * @property AdUser $updatedBy
 * @property AdUser $createdBy
 * @property MSupply[] $mSupplies
 */
class CBpartner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CBpartner the static model class
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
		return 'c_bpartner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, RIF, Name, LegalName, Rating', 'required'),
			array('Is_Active', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('RIF, Name, LegalName', 'length', 'max'=>60),
			array('Description', 'length', 'max'=>255),
			array('Rating', 'length', 'max'=>9),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('C_BPartner_ID, Created, CreatedBy, Updated, UpdatedBy, RIF, Name, LegalName, Description, Rating, Is_Active', 'safe', 'on'=>'search'),
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
			'mSupplies' => array(self::HAS_MANY, 'MSupply', 'C_BPartner_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'C_BPartner_ID' => 'C Bpartner',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'RIF' => 'Rif',
			'Name' => 'Name',
			'LegalName' => 'Legal Name',
			'Description' => 'Description',
			'Rating' => 'Rating',
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

		$criteria->compare('C_BPartner_ID',$this->C_BPartner_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('RIF',$this->RIF,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('LegalName',$this->LegalName,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Rating',$this->Rating,true);
		$criteria->compare('Is_Active',$this->Is_Active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}