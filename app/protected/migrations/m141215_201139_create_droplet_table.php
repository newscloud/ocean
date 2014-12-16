<?php

class m141215_201139_create_droplet_table extends CDbMigration
{
   protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci';
   public $tablePrefix;
   public $tableName;

   public function before() {
     $this->tablePrefix = Yii::app()->getDb()->tablePrefix;
     if ($this->tablePrefix <> '')
       $this->tableName = $this->tablePrefix.'droplet';
   }

 	public function safeUp()
 	{
 	  $this->before();
  $this->createTable($this->tableName, array(
             'id' => 'pk',
             'user_id'  => 'integer default 0',
             'droplet_id' => 'integer default 0',
             'name' => 'string NOT NULL',
             'memory' =>  'integer default 0',
             'vcpus' =>  'integer default 0',
             'disk' =>  'integer default 0',
             'status' => 'string NOT NULL',
             'active'=> 'tinyint default 0',
             'created_at' => 'DATETIME NOT NULL DEFAULT 0',
             'modified_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
               ), $this->MySqlOptions);
//               $this->addForeignKey('fk_droplet_user', $this->tableName, 'user_id', $this->tablePrefix.'users', 'id', 'CASCADE', 'CASCADE');
 	}

 	public function safeDown()
 	{
 	  	$this->before();
 //	  	$this->dropForeignKey('fk_droplet_user', $this->tableName);
 	    $this->dropTable($this->tableName);
 	}
}