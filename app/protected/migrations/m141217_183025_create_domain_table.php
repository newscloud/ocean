<?php

class m141217_183025_create_domain_table extends CDbMigration
{
  protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
  public $tablePrefix;
  public $tableName;
  
	public function before() {
     $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
     if ($this->tablePrefix <> '')
       $this->tableName = $this->tablePrefix.'domain';
   }

 	public function safeUp()
 	{
 	  $this->before();
  $this->createTable($this->tableName, array(
             'id' => 'pk',
             'name'=> 'string NOT NULL',
             'ttl'=> 'INTEGER DEFAULT 0',
             'zone' => 'TEXT DEFAULT NULL',
             'ip_address'=> 'string NOT NULL',
             'active' => 'TINYINT default 0',
             'created_at' => 'DATETIME NOT NULL DEFAULT 0',
             'modified_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
               ), $this->MySqlOptions);
 	}

 	public function safeDown()
 	{
 	  	$this->before();
 	    $this->dropTable($this->tableName);
 	}	
}