<?php

class m141216_010742_create_snapshot_table extends CDbMigration
{
	   protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
     public $tablePrefix;
     public $tableName;

     public function before() {
       $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
       if ($this->tablePrefix <> '')
         $this->tableName = $this->tablePrefix.'snapshot';
     }

   	public function safeUp()
   	{
   	  $this->before();
      $this->createTable($this->tableName, array(
                 'id' => 'pk',
                 'user_id'  => 'integer default 0',               
                 'image_id' => 'integer default 0',
                 'name' => 'string NOT NULL',
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