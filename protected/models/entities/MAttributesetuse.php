<?php

/**
 * This is the model class for table "m_attributesetuse".
 *
 * The followings are the available columns in table 'm_attributesetuse':
 * @property string $M_AttributeSetUse_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $M_AttributeSet_ID
 * @property string $M_Attribute_ID
 *
 * The followings are the available model relations:
 * @property AdUser $createdBy
 * @property AdUser $updatedBy
 * @property MAttributeset $mAttributeSet
 * @property MAttribute $mAttribute
 */
class MAttributesetuse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttributesetuse the static model class
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
		return 'm_attributesetuse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, M_AttributeSet_ID, M_Attribute_ID', 'required'),
			array('CreatedBy, UpdatedBy, M_AttributeSet_ID, M_Attribute_ID', 'length', 'max'=>20),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_AttributeSetUse_ID, Created, CreatedBy, Updated, UpdatedBy, M_AttributeSet_ID, M_Attribute_ID', 'safe', 'on'=>'search'),
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
			'mAttributeSet' => array(self::BELONGS_TO, 'MAttributeset', 'M_AttributeSet_ID'),
			'mAttribute' => array(self::BELONGS_TO, 'MAttribute', 'M_Attribute_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_AttributeSetUse_ID' => 'M Attribute Set Use',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'M_AttributeSet_ID' => 'M Attribute Set',
			'M_Attribute_ID' => 'M Attribute',
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

		$criteria->compare('M_AttributeSetUse_ID',$this->M_AttributeSetUse_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('M_AttributeSet_ID',$this->M_AttributeSet_ID,true);
		$criteria->compare('M_Attribute_ID',$this->M_Attribute_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}