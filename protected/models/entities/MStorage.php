<?php

/**
 * This is the model class for table "m_storage".
 *
 * The followings are the available columns in table 'm_storage':
 * @property string $M_Storage_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $M_Locator_ID
 * @property string $M_Supply_ID
 * @property string $M_Lot_ID
 * @property string $M_AttributeSetInstance_ID
 * @property string $QtyOnHand
 * @property string $QtyIn
 * @property string $QtyProcess
 *
 * The followings are the available model relations:
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MLocator $mLocator
 * @property MSupply $mSupply
 * @property MAttributesetinstance $mAttributeSetInstance
 * @property MLot $mLot
 */
class MStorage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MStorage the static model class
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
		return 'm_storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, M_Locator_ID, M_Supply_ID, M_Lot_ID, M_AttributeSetInstance_ID', 'required'),
			array('CreatedBy, UpdatedBy, M_Locator_ID, M_Supply_ID, M_Lot_ID, M_AttributeSetInstance_ID', 'length', 'max'=>20),
			array('QtyOnHand, QtyIn, QtyProcess', 'length', 'max'=>17),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_Storage_ID, Created, CreatedBy, Updated, UpdatedBy, M_Locator_ID, M_Supply_ID, M_Lot_ID, M_AttributeSetInstance_ID, QtyOnHand, QtyIn, QtyProcess', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
			'mLocator' => array(self::BELONGS_TO, 'MLocator', 'M_Locator_ID'),
			'mSupply' => array(self::BELONGS_TO, 'MSupply', 'M_Supply_ID'),
			'mAttributeSetInstance' => array(self::BELONGS_TO, 'MAttributesetinstance', 'M_AttributeSetInstance_ID'),
			'mLot' => array(self::BELONGS_TO, 'MLot', 'M_Lot_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_Storage_ID' => 'M Storage',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'M_Locator_ID' => 'M Locator',
			'M_Supply_ID' => 'M Supply',
			'M_Lot_ID' => 'M Lot',
			'M_AttributeSetInstance_ID' => 'M Attribute Set Instance',
			'QtyOnHand' => 'Qty On Hand',
			'QtyIn' => 'Qty In',
			'QtyProcess' => 'Qty Process',
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

		$criteria->compare('M_Storage_ID',$this->M_Storage_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('M_Locator_ID',$this->M_Locator_ID,true);
		$criteria->compare('M_Supply_ID',$this->M_Supply_ID,true);
		$criteria->compare('M_Lot_ID',$this->M_Lot_ID,true);
		$criteria->compare('M_AttributeSetInstance_ID',$this->M_AttributeSetInstance_ID,true);
		$criteria->compare('QtyOnHand',$this->QtyOnHand,true);
		$criteria->compare('QtyIn',$this->QtyIn,true);
		$criteria->compare('QtyProcess',$this->QtyProcess,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}