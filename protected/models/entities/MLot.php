<?php

/**
 * This is the model class for table "m_lot".
 *
 * The followings are the available columns in table 'm_lot':
 * @property string $M_Lot_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $M_Supply_ID
 * @property integer $Year
 * @property integer $Month
 * @property string $Price
 *
 * The followings are the available model relations:
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MSupply $mSupply
 * @property MStorage[] $mStorages
 * @property MStorageHistorical[] $mStorageHistoricals
 */
class MLot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MLot the static model class
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
		return 'm_lot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, M_Supply_ID, Year, Month, Price', 'required'),
			array('Year, Month', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, UpdatedBy, M_Supply_ID', 'length', 'max'=>20),
			array('Price', 'length', 'max'=>10),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_Lot_ID, Created, CreatedBy, Updated, UpdatedBy, M_Supply_ID, Year, Month, Price', 'safe', 'on'=>'search'),
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
			'mSupply' => array(self::BELONGS_TO, 'MSupply', 'M_Supply_ID'),
			'mStorages' => array(self::HAS_MANY, 'MStorage', 'M_Lot_ID'),
			'mStorageHistoricals' => array(self::HAS_MANY, 'MStorageHistorical', 'M_Lot_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_Lot_ID' => 'M Lot',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'M_Supply_ID' => 'M Supply',
			'Year' => 'Year',
			'Month' => 'Month',
			'Price' => 'Price',
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

		$criteria->compare('M_Lot_ID',$this->M_Lot_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('M_Supply_ID',$this->M_Supply_ID,true);
		$criteria->compare('Year',$this->Year);
		$criteria->compare('Month',$this->Month);
		$criteria->compare('Price',$this->Price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}