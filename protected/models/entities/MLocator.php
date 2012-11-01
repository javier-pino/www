<?php

/**
 * This is the model class for table "m_locator".
 *
 * The followings are the available columns in table 'm_locator':
 * @property string $M_Locator_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Shelf
 * @property string $Row
 * @property string $Column
 * @property string $Finder
 * @property string $M_SupplyWarehouse_ID
 *
 * The followings are the available model relations:
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MSupplywarehouse $mSupplyWarehouse
 * @property MStorage[] $mStorages
 * @property MStorageHistorical[] $mStorageHistoricals
 */
class MLocator extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MLocator the static model class
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
		return 'm_locator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, Shelf, Row, Column, Finder, M_SupplyWarehouse_ID', 'required'),
			array('CreatedBy, UpdatedBy, M_SupplyWarehouse_ID', 'length', 'max'=>20),
			array('Shelf, Row, Column', 'length', 'max'=>60),
			array('Finder', 'length', 'max'=>120),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_Locator_ID, Created, CreatedBy, Updated, UpdatedBy, Shelf, Row, Column, Finder, M_SupplyWarehouse_ID', 'safe', 'on'=>'search'),
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
			'mSupplyWarehouse' => array(self::BELONGS_TO, 'MSupplywarehouse', 'M_SupplyWarehouse_ID'),
			'mStorages' => array(self::HAS_MANY, 'MStorage', 'M_Locator_ID'),
			'mStorageHistoricals' => array(self::HAS_MANY, 'MStorageHistorical', 'M_Locator_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_Locator_ID' => 'M Locator',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Shelf' => 'Shelf',
			'Row' => 'Row',
			'Column' => 'Column',
			'Finder' => 'Finder',
			'M_SupplyWarehouse_ID' => 'M Supply Warehouse',
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

		$criteria->compare('M_Locator_ID',$this->M_Locator_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Shelf',$this->Shelf,true);
		$criteria->compare('Row',$this->Row,true);
		$criteria->compare('Column',$this->Column,true);
		$criteria->compare('Finder',$this->Finder,true);
		$criteria->compare('M_SupplyWarehouse_ID',$this->M_SupplyWarehouse_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}