<?php

/**
 * This is the model class for table "m_attributeset".
 *
 * The followings are the available columns in table 'm_attributeset':
 * @property string $M_AttributeSet_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Finder
 *
 * The followings are the available model relations:
 * @property MAttributesetinstance[] $mAttributesetinstances
 * @property MAttributesetuse[] $mAttributesetuses
 * @property MSupply[] $mSupplies
 */
class MAttributeset extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttributeset the static model class
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
		return 'm_attributeset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created', 'required'),
			array('CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Finder', 'length', 'max'=>200),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_AttributeSet_ID, Created, CreatedBy, Updated, UpdatedBy, Finder', 'safe', 'on'=>'search'),
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
			'mAttributesetinstances' => array(self::HAS_MANY, 'MAttributesetinstance', 'M_AttributeSet_ID'),
			'mAttributesetuses' => array(self::HAS_MANY, 'MAttributesetuse', 'M_AttributeSet_ID'),
			'mSupplies' => array(self::HAS_MANY, 'MSupply', 'M_AttributeSet_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
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