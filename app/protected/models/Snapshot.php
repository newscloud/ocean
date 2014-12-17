<?php

/**
 * This is the model class for table "{{snapshot}}".
 *
 * The followings are the available columns in table '{{snapshot}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $image_id
 * @property string $name
 * @property string $created_at
 * @property string $modified_at
 */
class Snapshot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Snapshot the static model class
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
		return '{{snapshot}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, modified_at', 'required'),
			array('user_id, image_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, image_id, name, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'image_id' => 'Image',
			'name' => 'Name',
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
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   public function sync() {
     $ocean = new Ocean();
     $snapshots = $ocean->getSnapshots();
     foreach ($snapshots as $i) {
       $image_id = $this->add($i);
       if ($image_id!==false) {
         echo $image_id;lb();
         pp($i);        
       }
     }	      
   }

    public function replicate($id) {
  	  // look up image_id
      $snapshot = Snapshot::model()->findByAttributes(array('id'=>$id));
  	  // create the droplet 
      $ocean = new Ocean();
      $droplet_id = $ocean->launch_droplet($snapshot->name,$snapshot->region,$snapshot->image_id);
  	  // add command to action table with droplet_id and image_id
      $a = new Action();
      $a->droplet_id = $droplet_id;
      $a->snapshot_id = $snapshot->image_id;
      $a->action = Action::ACTION_SNAPSHOT;
      $a->status = Action::STATUS_ACTIVE;
      $a->stage = 0;
      $a->end_stage = 3;
      $a->last_checked = 0;
      $a->modified_at =new CDbExpression('NOW()');          
      $a->created_at =new CDbExpression('NOW()');          
      $a->save(); 
    }
  
  public function take($action_id) {
    $result = false;
	  $a = Action::model()->findByPk($action_id);
    $snapshot = Snapshot::model()->findByAttributes(array('image_id'=>$a->snapshot_id));
    $ocean = new Ocean();
    // attempt shutdown
    // take snapshot
    $result = $ocean->snapshot($a->stage,$a->droplet_id,$snapshot->name,$snapshot->region,$snapshot->image_id);
    // if snapshot was successful
    if ($result) {
      // increment stage
      $a->stage+=1;
      // if last snapshot replication complete, end action
      if (($a->stage+1) >= $a->end_stage)  
        $a->status = Action::STATUS_COMPLETE;
    } 
	  // either way, update last_checked
    $a->last_checked = time();
    $a->save();              
	  return $result;
  }
	      
}