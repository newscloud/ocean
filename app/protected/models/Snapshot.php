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
       //$image_id = $i->id;
       if ($image_id!==false) {
         echo $image_id;lb();
         pp($i);        
       }
     }	      
   }

   public function add($snapshot) {
      $i = Snapshot::model()->findByAttributes(array('image_id'=>$snapshot->id));
     if (empty($i)) {
       $i = new Snapshot;
       $i->created_at =new CDbExpression('NOW()');          
     }
     if (isset($snapshot->public) and $snapshot->public ==1) {
       return false; // no need to save public images right now
     } else 
       $i->user_id = Yii::app()->user->id; 	  
       $i->image_id = $snapshot->id;
       $i->name = $snapshot->name;
       $i->region = $snapshot->regions[0];
       /*
       $i->distribution = $snapshot->distribution;
       if (isset($snapshot->slug))
         $i->slug = $snapshot->slug;
       else
         $i->slug ='';
       $i->minDiskSize = $snapshot->minDiskSize;
       */
       $i->active =1;
       $i->modified_at =new CDbExpression('NOW()');          
      $i->save();
    return $i->id;
    }	
    
    public function launch_droplet($id) {
      $snapshot = Snapshot::model()->findByAttributes(array('id'=>$id));
      $ocean = new Ocean();
      $created = $ocean->launch_droplet($snapshot->name,$snapshot->region,$snapshot->image_id);
    }

    public function duplicate($id) {
      $image = Snapshot::model()->findByAttributes(array('id'=>$id));
      $ocean = new Ocean();
      $created = $ocean->duplicate($image->name,$image->region,$image->image_id);
    }
    
    public function testing($id=9) {
      $droplet_id = 3487144;
      $snapshot = Snapshot::model()->findByAttributes(array('id'=>$id));
      $ocean = new Ocean();
      $created = $ocean->duplicate($snapshot->name,$snapshot->region,$snapshot->image_id);
      
    }
}