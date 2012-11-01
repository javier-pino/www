<?php

/**
 * This is the model class for table "c_uom".
 *
 * The followings are the available columns in table 'c_uom':
 * @property string $C_UOM_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Finder
 * @property string $Name
 * @property string $Description
 * @property integer $StdPrecision
 *
 * The followings are the available model relations:
 * @property AdUser $updatedBy
 * @property AdUser $createdBy
 * @property MSupply[] $mSupplies
 */
class CUom extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CUom the static model class
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
		return 'c_uom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, Finder, Name, Description', 'required'),
			array('StdPrecision', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Finder', 'length', 'max'=>10),
			array('Name', 'length', 'max'=>60),
			array('Description', 'length', 'max'=>255),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('C_UOM_ID, Created, CreatedBy, Updated, UpdatedBy, Finder, Name, Description, StdPrecision', 'safe', 'on'=>'search'),
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
			'mSupplies' => array(self::HAS_MANY, 'MSupply', 'C_UOM_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'C_UOM_ID' => 'C Uom',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Finder' => 'Finder',
			'Name' => 'Name',
			'Description' => 'Description',
			'StdPrecision' => 'Std Precision',
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

		$criteria->compare('C_UOM_ID',$this->C_UOM_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Finder',$this->Finder,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('StdPrecision',$this->StdPrecision);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}