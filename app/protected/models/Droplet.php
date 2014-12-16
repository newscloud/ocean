<?php

/**
 * This is the model class for table "{{droplet}}".
 *
 * The followings are the available columns in table '{{droplet}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $droplet_id
 * @property string $name
 * @property integer $memory
 * @property integer $vcpus
 * @property integer $disk
 * @property string $status
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property Users $user
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
			array('user_id, droplet_id, memory, vcpus, disk, active', 'numerical', 'integerOnly'=>true),
			array('name, status', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, droplet_id, name, memory, vcpus, disk, status, active, created_at, modified_at', 'safe', 'on'=>'search'),
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
//			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
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
		$criteria->compare('user_id',$this->user_id);
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
	
	public function sync() {
    $ocean = new Ocean();
    $droplets = $ocean->getDroplets();
    // pp ($droplets);
    foreach ($droplets as $d) {
      $droplet_id = $this->add($d);
      // echo $droplet_id;lb();
    }	      
  }

  public function add($droplet) {
     $d = Droplet::model()->findByAttributes(array('droplet_id'=>$droplet->id));
    if (empty($d)) {
      $d = new Droplet;
    }
    $d->user_id = Yii::app()->user->id;
      $d->droplet_id = $droplet->id;
      $d->name = $droplet->name;
      $d->vcpus = $droplet->vcpus;
      $d->memory = $droplet->memory;
      $d->disk = $droplet->disk;
      $d->status = $droplet->status;
      $d->active =1;
     $d->created_at = $d->created_at;
     $d->modified_at =new CDbExpression('NOW()');          
     $d->save();
    return $d->id;
   }
   
}