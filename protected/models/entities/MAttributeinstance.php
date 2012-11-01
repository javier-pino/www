<?php

/**
 * This is the model class for table "m_attributeinstance".
 *
 * The followings are the available columns in table 'm_attributeinstance':
 * @property string $M_AttributeInstance_ID
 * @property string $M_AttributeSetInstance_ID
 * @property string $M_Attribute_ID
 * @property string $M_AttributeValue_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 *
 * The followings are the available model relations:
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MAttributesetinstance $mAttributeSetInstance
 * @property MAttribute $mAttribute
 * @property MAttributevalue $mAttributeValue
 */
class MAttributeinstance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttributeinstance the static model class
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
		return 'm_attributeinstance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('M_AttributeSetInstance_ID, M_Attribute_ID, M_AttributeValue_ID, Created', 'required'),
			array('M_AttributeSetInstance_ID, M_Attribute_ID, M_AttributeValue_ID, CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_AttributeInstance_ID, M_AttributeSetInstance_ID, M_Attribute_ID, M_AttributeValue_ID, Created, CreatedBy, Updated, UpdatedBy', 'safe', 'on'=>'search'),
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
			'mAttributeSetInstance' => array(self::BELONGS_TO, 'MAttributesetinstance', 'M_AttributeSetInstance_ID'),
			'mAttribute' => array(self::BELONGS_TO, 'MAttribute', 'M_Attribute_ID'),
			'mAttributeValue' => array(self::BELONGS_TO, 'MAttributevalue', 'M_AttributeValue_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_AttributeInstance_ID' => 'M Attribute Instance',
			'M_AttributeSetInstance_ID' => 'M Attribute Set Instance',
			'M_Attribute_ID' => 'M Attribute',
			'M_AttributeValue_ID' => 'M Attribute Value',
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

		$criteria->compare('M_AttributeInstance_ID',$this->M_AttributeInstance_ID,true);
		$criteria->compare('M_AttributeSetInstance_ID',$this->M_AttributeSetInstance_ID,true);
		$criteria->compare('M_Attribute_ID',$this->M_Attribute_ID,true);
		$criteria->compare('M_AttributeValue_ID',$this->M_AttributeValue_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}