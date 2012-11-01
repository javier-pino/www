<?php

/**
 * This is the model class for table "m_attribute".
 *
 * The followings are the available columns in table 'm_attribute':
 * @property string $M_Attribute_ID
 * @property string $Created
 * @property string $CreatedBy
 * @property string $Updated
 * @property string $UpdatedBy
 * @property string $Finder
 * @property string $Name
 *
 * The followings are the available model relations:
 * @property AdUser $updatedBy
 * @property AdUser $createdBy
 * @property MAttributeinstance[] $mAttributeinstances
 * @property MAttributesetuse[] $mAttributesetuses
 * @property MAttributevalue[] $mAttributevalues
 */
class MAttribute extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MAttribute the static model class
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
		return 'm_attribute';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Created, Finder, Name', 'required'),
			array('CreatedBy, UpdatedBy', 'length', 'max'=>20),
			array('Finder', 'length', 'max'=>15),
			array('Name', 'length', 'max'=>40),
			array('Updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('M_Attribute_ID, Created, CreatedBy, Updated, UpdatedBy, Finder, Name', 'safe', 'on'=>'search'),
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
			'mAttributeinstances' => array(self::HAS_MANY, 'MAttributeinstance', 'M_Attribute_ID'),
			'mAttributesetuses' => array(self::HAS_MANY, 'MAttributesetuse', 'M_Attribute_ID'),
			'mAttributevalues' => array(self::HAS_MANY, 'MAttributevalue', 'M_Attribute_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'M_Attribute_ID' => 'M Attribute',
			'Created' => 'Created',
			'CreatedBy' => 'Created By',
			'Updated' => 'Updated',
			'UpdatedBy' => 'Updated By',
			'Finder' => 'Finder',
			'Name' => 'Name',
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

		$criteria->compare('M_Attribute_ID',$this->M_Attribute_ID,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy,true);
		$criteria->compare('Finder',$this->Finder,true);
		$criteria->compare('Name',$this->Name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}