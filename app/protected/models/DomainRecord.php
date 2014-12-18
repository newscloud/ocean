<?php

/**
 * This is the model class for table "{{domain_record}}".
 *
 * The followings are the available columns in table '{{domain_record}}':
 * @property integer $id
 * @property integer $domain_id
 * @property integer $record_id
 * @property string $record_type
 * @property string $record_name
 * @property string $record_data
 * @property integer $priority
 * @property integer $port
 * @property integer $weight
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property Domain $domain
 */
class DomainRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DomainRecord the static model class
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
		return '{{domain_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_type, record_name, record_data', 'required'),
			array('domain_id, record_id, active', 'numerical', 'integerOnly'=>true),
			array('record_type, record_name, record_data', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain_id, record_id, record_type, record_name, record_data, priority, port, weight, active, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'domain' => array(self::BELONGS_TO, 'Domain', 'domain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'domain_id' => 'Domain',
			'record_id' => 'Record',
			'record_type' => 'Record Type',
			'record_name' => 'Record Name',
			'record_data' => 'Record Data',
			'priority' => 'Priority',
			'port' => 'Port',
			'weight' => 'Weight',
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
		$criteria->compare('domain_id',$this->domain_id);
		$criteria->compare('record_id',$this->record_id);
		$criteria->compare('record_type',$this->record_type,true);
		$criteria->compare('record_name',$this->record_name,true);
		$criteria->compare('record_data',$this->record_data,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('port',$this->port);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sync($id) {
	  // lookup domain
	   $d = Domain::model()->findByPk($id);
     $ocean = new Ocean();
     $records = $ocean->getDomainRecords($d->name);
     foreach ($records as $r) {
       $record_id = $this->add($id,$r);
/*
       if ($record_id!==false) {
         echo $record_id;lb();
         pp($d);        
       }
*/       
   }
  }
   
   public function add($domain_id,$record) {
       $dr = DomainRecord::model()->findByAttributes(array('record_id'=>$record->id));
      if (empty($dr)) {
        $dr = new DomainRecord;
      }
      $dr->domain_id = $domain_id;
      $dr->record_id = $record->id;
      $dr->record_name = $record->name;
      $dr->record_type = $record->type;
        $dr->record_data = $record->data;
        if (isset($record->priority))
          $dr->priority = $record->priority;
        else
          $dr->priority = null;
        if (isset($record->port))
          $dr->port = $record->port;
        else
          $dr->port = null;
        if (isset($record->weight))
          $dr->weight = $record->weight;
        else
          $dr->weight = null;
          
        $dr->active =1;
       $dr->created_at =new CDbExpression('NOW()');          
       $dr->modified_at =new CDbExpression('NOW()');          
       $dr->save();
      return $dr->id;
     }	

     public function of_domain($domain_id = 0)
     {
       $this->getDbCriteria()->mergeWith( array(
         'condition'=>'domain_id='.$domain_id,
       ));
         return $this;
     }
     
     public function remote_add($id) {
  	   $d = Domain::model()->findByPk($id);
       $ocean = new Ocean();
       $record = $ocean->createDomainRecord($d->name,$this->record_type,$this->record_name,$this->record_data,$this->priority,$this->port,$this->weight);
       $this->domain_id = $id;
       $this->record_id = $record->id;
       $this->active =1;
       $this->created_at =new CDbExpression('NOW()');          
       $this->modified_at =new CDbExpression('NOW()');                 
       $this->save();
       return true;
       
     }
	
}