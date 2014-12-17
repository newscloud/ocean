<?php

/**
 * This is the model class for table "{{action}}".
 *
 * The followings are the available columns in table '{{action}}':
 * @property integer $id
 * @property integer $droplet_id
 * @property integer $snapshot_id
 * @property integer $action
 * @property integer $status
 * @property integer $stage
 * @property integer $end_stage
 * @property integer $last_checked
 * @property string $created_at
 * @property string $modified_at
 */
class Action extends CActiveRecord
{
  const ACTION_SNAPSHOT = 10;
  
  const STATUS_ACTIVE = 10;
  const STATUS_PAUSED = 20;
  const STATUS_TERMINATED = 30;
  const STATUS_COMPLETE = 100;
  
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Action the static model class
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
		return '{{action}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modified_at', 'required'),
			array('droplet_id, snapshot_id, action, status, stage, end_stage, last_checked', 'numerical', 'integerOnly'=>true),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, droplet_id, snapshot_id, action, status, stage, end_stage, last_checked, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'snapshot_id' => 'Snapshot',
			'action' => 'Action',
			'status' => 'Status',
			'stage' => 'Stage',
			'end_stage' => 'End Stage',
			'last_checked' => 'Last Checked',
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
		$criteria->compare('snapshot_id',$this->snapshot_id);
		$criteria->compare('action',$this->action);
		$criteria->compare('status',$this->status);
		$criteria->compare('stage',$this->stage);
		$criteria->compare('end_stage',$this->end_stage);
		$criteria->compare('last_checked',$this->last_checked);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
  public function scopes()
    {
        return array(   
          'active'=>array(
              'condition'=>'status='.self::STATUS_ACTIVE, 
          ),
            'overdue'=>array(
              'condition'=>'last_checked < '.(time()-(15*60)),               
            ),
        );
    }
    	
       public function renderStatus($data,$row)
            {
              if ($data->status == self::STATUS_ACTIVE) {
                $result = 'Active';
              } else if ($data->status == self::STATUS_COMPLETE) {
                $result = 'Complete';
              } else if ($data->status == self::STATUS_PAUSED) {
                $result = 'Paused';
              } else if ($data->status == self::STATUS_TERMINATED) {
                $result = 'Terminated';
               } else {
                 $result = 'n/a';
               }
               return $result;    
           }

           public function renderAction($data,$row)
                {
                  if ($data->status == self::ACTION_SNAPSHOT) {
                    $result = 'Snapshot';
                   } else {
                     $result = 'n/a';
                   }
                   return $result;    
               }

  public function renderLastChecked($data,$row) {
     if (is_null($data->last_checked)) return 'n/a';
     if ($data->last_checked==0) return 'Pending';
      // if day of year of now is less than or equal to time_str
      if (date('z',time()) > date('z',$data->last_checked)) {
        $date_str = Yii::app()->dateFormatter->format('h:mm a',$data->last_checked,'medium',null);
      }
        else {
          $date_str = Yii::app()->dateFormatter->format('MMM d',$data->last_checked,'medium',null);
        }
      return $date_str;
  }	
  
	public function process() {
	  set_time_limit(0);
	  // look for overdue actions	  
	  $todo = Action::model()->overdue()->findAllByAttributes(array('status'=>self::STATUS_ACTIVE));
	  foreach ($todo as $item) {
	    if ($item->action == self::ACTION_SNAPSHOT) {
          $result = Snapshot::model()->take($item->id);          
	    }
	  }
	}
	
}