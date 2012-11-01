<?php

/**
 * This is the model class for table "m_attributesetinstance".
 *
 * The followings are the available columns in table 'm_attributesetinstance':
 * @property string $M_AttributeSetInstance_ID
 * @property string $M_AttributeSet_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Finder
 *
 * The followings are the available model relations:
 * @property MAttributeinstance[] $mAttributeinstances
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MAttributeset $mAttributeSet
 * @property MStorage[] $mStorages
 * @property MStorageHistorical[] $mStorageHistoricals
 */
class MAttributesetinstance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttributesetinstance the static model class
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
		return 'm_attributesetinstance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('M_AttributeSet_ID, Created, Finder', 'required'),
			array('M_AttributeSet_ID, CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_AttributeSetInstance_ID, M_AttributeSet_ID, Created, CreatedBy, Updated, UpdatedBy, Finder', 'safe', 'on'=>'search'),
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
			'mAttributeinstances' => array(self::HAS_MANY, 'MAttributeinstance', 'M_AttributeSetInstance_ID'),
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
			'mAttributeSet' => array(self::BELONGS_TO, 'MAttributeset', 'M_AttributeSet_ID'),
			'mStorages' => array(self::HAS_MANY, 'MStorage', 'M_AttributeSetInstance_ID'),
			'mStorageHistoricals' => array(self::HAS_MANY, 'MStorageHistorical', 'M_AttributeSetInstance_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_AttributeSetInstance_ID' => 'M Attribute Set Instance',
			'M_AttributeSet_ID' => 'M Attribute Set',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Finder' => 'Finder',
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

		$criteria->compare('M_AttributeSetInstance_ID',$this->M_AttributeSetInstance_ID,true);
		$criteria->compare('M_AttributeSet_ID',$this->M_AttributeSet_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Finder',$this->Finder,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}