<?php

/**
 * This is the model class for table "{{droplet}}".
 *
 * The followings are the available columns in table '{{droplet}}':
 * @property integer $id
 * @property integer $droplet_id
 * @property string $name
 * @property integer $memory
 * @property integer $vcpus
 * @property integer $disk
 * @property string $status
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 */
class Droplet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Droplet the static model class
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
		return '{{droplet}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, modified_at', 'required'),
			array('droplet_id, memory, vcpus, disk, active', 'numerical', 'integerOnly'=>true),
			array('name, status', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, droplet_id, name, memory, vcpus, disk, status, active, created_at, modified_at', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'droplet_id' => 'Droplet',
			'name' => 'Name',
			'memory' => 'Memory',
			'vcpus' => 'Vcpus',
			'disk' => 'Disk',
			'status' => 'Status',
			'active' => 'Active',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('droplet_id',$this->droplet_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('memory',$this->memory);
		$criteria->compare('vcpus',$this->vcpus);
		$criteria->compare('disk',$this->disk);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}