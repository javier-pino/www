<?php

/**
 * This is the model class for table "m_supply".
 *
 * The followings are the available columns in table 'm_supply':
 * @property string $M_Supply_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property integer $I_IsImported
 * @property string $SKU
 * @property string $Name
 * @property string $Description
 * @property string $C_UOM_ID
 * @property string $M_AttributeSet_ID
 * @property string $C_BPartner_ID
 * @property string $VendorProductNo
 * @property string $Manufacturer
 *
 * The followings are the available model relations:
 * @property MLot[] $mLots
 * @property MStorage[] $mStorages
 * @property MStorageHistorical[] $mStorageHistoricals
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property CBpartner $cBPartner
 * @property CUom $cUOM
 * @property MAttributeset $mAttributeSet
 */
class MSupply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MSupply the static model class
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
		return 'm_supply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, SKU, Name, C_UOM_ID, M_AttributeSet_ID', 'required'),
			array('I_IsImported', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, UpdatedBy, C_UOM_ID, M_AttributeSet_ID, C_BPartner_ID', 'length', 'max'=>20),
			array('SKU', 'length', 'max'=>30),
			array('Name', 'length', 'max'=>60),
			array('Description', 'length', 'max'=>255),
			array('VendorProductNo', 'length', 'max'=>40),
			array('Updated, Manufacturer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_Supply_ID, Created, CreatedBy, Updated, UpdatedBy, I_IsImported, SKU, Name, Description, C_UOM_ID, M_AttributeSet_ID, C_BPartner_ID, VendorProductNo, Manufacturer', 'safe', 'on'=>'search'),
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
			'mLots' => array(self::HAS_MANY, 'MLot', 'M_Supply_ID'),
			'mStorages' => array(self::HAS_MANY, 'MStorage', 'M_Supply_ID'),
			'mStorageHistoricals' => array(self::HAS_MANY, 'MStorageHistorical', 'M_Supply_ID'),
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
			'cBPartner' => array(self::BELONGS_TO, 'CBpartner', 'C_BPartner_ID'),
			'cUOM' => array(self::BELONGS_TO, 'CUom', 'C_UOM_ID'),
			'mAttributeSet' => array(self::BELONGS_TO, 'MAttributeset', 'M_AttributeSet_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_Supply_ID' => 'M Supply',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'I_IsImported' => 'I Is Imported',
			'SKU' => 'Sku',
			'Name' => 'Name',
			'Description' => 'Description',
			'C_UOM_ID' => 'C Uom',
			'M_AttributeSet_ID' => 'M Attribute Set',
			'C_BPartner_ID' => 'C Bpartner',
			'VendorProductNo' => 'Vendor Product No',
			'Manufacturer' => 'Manufacturer',
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

		$criteria->compare('M_Supply_ID',$this->M_Supply_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('I_IsImported',$this->I_IsImported);
		$criteria->compare('SKU',$this->SKU,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('C_UOM_ID',$this->C_UOM_ID,true);
		$criteria->compare('M_AttributeSet_ID',$this->M_AttributeSet_ID,true);
		$criteria->compare('C_BPartner_ID',$this->C_BPartner_ID,true);
		$criteria->compare('VendorProductNo',$this->VendorProductNo,true);
		$criteria->compare('Manufacturer',$this->Manufacturer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}