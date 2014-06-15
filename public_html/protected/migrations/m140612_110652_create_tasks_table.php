<?php

class m140612_110652_create_tasks_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_tasks', array(
			'id' 					=> 'pk',
			'title'				=> 'string NOT NULL',
			'text'				=> 'text NOT NULL',
			'created_at' 	=> 'datetime NOT NULL',
			'status_id'		=> 'integer NOT NULL',
			'comment_id'	=> 'integer'
		));
	}

	public function down()
	{
		$this->dropTable('tbl_tasks');
	}
}