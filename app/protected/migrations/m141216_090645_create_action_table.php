<?php

class m141216_090645_create_action_table extends CDbMigration
{
  protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
  public $tablePrefix;
  public $tableName;
  
	public function before() {
     $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
     if ($this->tablePrefix <> '')
       $this->tableName = $this->tablePrefix.'action';
   }

 	public function safeUp()
 	{
 	  $this->before();
  $this->createTable($this->tableName, array(
             'id' => 'pk',
             'droplet_id'=> 'INTEGER DEFAULT 0',
             'snapshot_id'=> 'INTEGER DEFAULT 0',
             'action' => 'TINYINT DEFAULT 0',
             'status' => 'TINYINT default 0',
             'stage' => 'INTEGER default 0',
             'end_stage' => 'INTEGER default 0',
             'last_checked' => 'INTEGER default 0',
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


