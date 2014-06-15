<?php

class m140612_110804_create_statuses_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_statuses', array(
			'id' => 'pk',
			'title' => 'string NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('tbl_statuses');
	}
}