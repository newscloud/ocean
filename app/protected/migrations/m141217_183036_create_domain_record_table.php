<?php

class m141217_183036_create_domain_record_table extends CDbMigration
{
  protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
  public $tablePrefix;
  public $tableName;
  
	public function before() {
     $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
     if ($this->tablePrefix <> '')
       $this->tableName = $this->tablePrefix.'domain_record';
   }

 	public function safeUp()
 	{
 	  $this->before();
  $this->createTable($this->tableName, array(
             'id' => 'pk',
             'domain_id'=> 'INTEGER DEFAULT 0',             
             'record_id'=> 'INTEGER DEFAULT 0',             
             'record_type'=> 'string NOT NULL',
             'record_name'=> 'string NOT NULL',
             'record_data'=> 'string NOT NULL',
             'priority'=> 'INTEGER DEFAULT NULL',
             'port'=> 'INTEGER DEFAULT NULL',
             'weight'=> 'INTEGER DEFAULT NULL',
             'active' => 'TINYINT default 0',
             'created_at' => 'DATETIME NOT NULL DEFAULT 0',
             'modified_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
               ), $this->MySqlOptions);
              $this->addForeignKey('fk_dr_domain', $this->tableName, 'domain_id', $this->tablePrefix.'domain', 'id', 'CASCADE', 'CASCADE');
                	}

    	public function safeDown()
    	{
    	  	$this->before();
          $this->dropForeignKey('fk_dr_domain', $this->tableName);
    	    $this->dropTable($this->tableName);
    	}
}