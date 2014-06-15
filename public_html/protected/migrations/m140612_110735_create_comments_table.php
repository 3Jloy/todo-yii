<?php

class m140612_110735_create_comments_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_comments', array(
			'id' 		=> 'pk',
			'text'	=> 'text NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('tbl_comments');
	}
}