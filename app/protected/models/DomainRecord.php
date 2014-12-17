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
			array('record_type, record_name, record_data, modified_at', 'required'),
			array('domain_id, record_id, priority, port, weight, active', 'numerical', 'integerOnly'=>true),
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
	
	public function sync() {
     $ocean = new Ocean();
     $records = $ocean->getDomainRecords();
     foreach ($records as $d) {
       $record_id = $this->add($d);
       if ($record_id!==false) {
         echo $record_id;lb();
         pp($d);        
       }
     }	      
   }
   
   public function add($record) {
       $d = DomainRecord::model()->findByAttributes(array('name'=>$record->name));
      if (empty($d)) {
        $d = new DomainRecord;
      }
      $d->name = $record->name;
        $d->ttl = $record->ttl;
        $d->zone = $record->zoneFile;
        $d->active =1;
       $d->created_at =new CDbExpression('NOW()');          
       $d->modified_at =new CDbExpression('NOW()');          
       $d->save();
      return $d->id;
     }	

     public function of_domain($domain_id = 0)
     {
       $this->getDbCriteria()->mergeWith( array(
         'condition'=>'domain_id='.$domain_id,
       ));
         return $this;
     }
	
}