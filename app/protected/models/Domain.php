<?php

/**
 * This is the model class for table "{{domain}}".
 *
 * The followings are the available columns in table '{{domain}}':
 * @property integer $id
 * @property string $name
 * @property integer $ttl
 * @property string $zone
 * @property string $ip_address
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property DomainRecord[] $domainRecords
 */
class Domain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Domain the static model class
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
		return '{{domain}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('ttl, active', 'numerical', 'integerOnly'=>true),
			array('name, ip_address', 'length', 'max'=>255),
			array('zone, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, ttl, zone, ip_address, active, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'domainRecords' => array(self::HAS_MANY, 'DomainRecord', 'domain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'ttl' => 'Ttl',
			'zone' => 'Zone',
			'ip_address' => 'Ip Address',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ttl',$this->ttl);
		$criteria->compare('zone',$this->zone,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sync() {
     $ocean = new Ocean();
     $domains = $ocean->getDomains();
     foreach ($domains as $d) {
       $domain_id = $this->add($d);
       if ($domain_id!==false) {
         echo $domain_id;lb();
         pp($d);        
       }
     }	      
   }

   public function add($domain) {
       $d = Domain::model()->findByAttributes(array('name'=>$domain->name));
      if (empty($d)) {
        $d = new Domain;
      }
      $d->name = $domain->name;
        $d->ttl = $domain->ttl;
        $d->zone = $domain->zoneFile;
        $d->active =1;
       $d->created_at = $d->created_at;
       $d->modified_at =new CDbExpression('NOW()');          
       $d->save();
       pp($d->getErrors());die();
      return $d->id;
     }
}