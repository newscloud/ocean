<?php

/**
 * This is the model class for table "{{image}}".
 *
 * The followings are the available columns in table '{{image}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $image_id
 * @property string $name
 * @property string $distribution
 * @property string $slug
 * @property integer $public
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Image extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Image the static model class
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
		return '{{image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, distribution', 'required'),
			array('user_id, image_id, public, active', 'numerical', 'integerOnly'=>true),
			array('name, distribution, slug', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, image_id, name, distribution, slug, public, active, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
			'distribution' => 'Distribution',
			'slug' => 'Slug',
			'public' => 'Public',
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
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('distribution',$this->distribution,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('public',$this->public);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sync() {
    $ocean = new Ocean();
    $images = $ocean->getImages();
    foreach ($images as $i) {
      $image_id = $this->add($i);
      //$image_id = $i->id;
      if ($image_id!==false) {
        echo $image_id;lb();
        pp($i);        
      }
    }	      
  }

  public function add($image) {
     $i = Image::model()->findByAttributes(array('image_id'=>$image->id));
    if (empty($i)) {
      $i = new Image;
      $i->created_at =new CDbExpression('NOW()');          
    }
    $i->user_id = Yii::app()->user->id; 	  
      $i->image_id = $image->id;
      $i->name = $image->name;
      $i->distribution = $image->distribution;
      $i->slug = $image->slug;
      $i->minDiskSize = $image->minDiskSize;
      $i->region = $image->regions[0];
      if (isset($image->public) and $image->public ==1) {
        $i->public = 1;
        return false; // no need to save public images right now
      } else 
        $i->public =0;
      $i->active =1;
      $i->modified_at =new CDbExpression('NOW()');          
     $i->save();
   return $i->id;
   }
  
   public function new_droplet($image_id) {
     $ocean = new Ocean();
     $droplet = $ocean->getImages();
     foreach ($images as $i) {
       $image_id = $this->add($i);
       if ($image_id!==false) {
         echo $image_id;lb();
         pp($i);        
       }
     }	      
   }
}