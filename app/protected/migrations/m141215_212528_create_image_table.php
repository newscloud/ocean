<?php

class m141215_212528_create_image_table extends CDbMigration
{
     protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
     public $tablePrefix;
     public $tableName;

     public function before() {
       $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
       if ($this->tablePrefix <> '')
         $this->tableName = $this->tablePrefix.'image';
     }

   	public function safeUp()
   	{
   	  $this->before();
    $this->createTable($this->tableName, array(
               'id' => 'pk',
               'user_id'  => 'integer default 0',               
               'image_id' => 'integer default 0',
               'name' => 'string NOT NULL',
               'distribution' => 'string NOT NULL',
               'slug' => 'string NOT NULL',
               'region'=>'string NOT NULL',
               'minDiskSize' => 'integer default 0',
               'public' =>  'integer default 0',
               'active' =>  'tinyint default 0',
               'created_at' => 'DATETIME NOT NULL DEFAULT 0',
               'modified_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                 ), $this->MySqlOptions);
                 $this->addForeignKey('fk_image_user', $this->tableName, 'user_id', $this->tablePrefix.'users', 'id', 'CASCADE', 'CASCADE');
                 
   	}

   	public function safeDown()
   	{
   	  	$this->before();
   	  	$this->dropForeignKey('fk_image_user', $this->tableName);
   	    $this->dropTable($this->tableName);
   	}	
}