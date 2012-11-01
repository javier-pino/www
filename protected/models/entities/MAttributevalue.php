<?php

/**
 * This is the model class for table "m_attributevalue".
 *
 * The followings are the available columns in table 'm_attributevalue':
 * @property string $M_AttributeValue_ID
 * @property string $M_Attribute_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Value
 * @property string $ValueNumeric
 *
 * The followings are the available model relations:
 * @property MAttributeinstance[] $mAttributeinstances
 * @property MAttribute $mAttribute
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 */
class MAttributevalue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttributevalue the static model class
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
		return 'm_attributevalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('M_Attribute_ID, Created, Value', 'required'),
			array('M_Attribute_ID, CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Value', 'length', 'max'=>40),
			array('ValueNumeric', 'length', 'max'=>10),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_AttributeValue_ID, M_Attribute_ID, Created, CreatedBy, Updated, UpdatedBy, Value, ValueNumeric', 'safe', 'on'=>'search'),
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
			'mAttributeinstances' => array(self::HAS_MANY, 'MAttributeinstance', 'M_AttributeValue_ID'),
			'mAttribute' => array(self::BELONGS_TO, 'MAttribute', 'M_Attribute_ID'),
			'createdBy' => array(self::BELONGS_TO, 'AdUser', 'CreatedBy'),
			'updatedBy' => array(self::BELONGS_TO, 'AdUser', 'UpdatedBy'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_AttributeValue_ID' => 'M Attribute Value',
			'M_Attribute_ID' => 'M Attribute',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Value' => 'Value',
			'ValueNumeric' => 'Value Numeric',
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

		$criteria->compare('M_AttributeValue_ID',$this->M_AttributeValue_ID,true);
		$criteria->compare('M_Attribute_ID',$this->M_Attribute_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Value',$this->Value,true);
		$criteria->compare('ValueNumeric',$this->ValueNumeric,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}