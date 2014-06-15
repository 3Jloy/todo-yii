<?php

class m140612_114142_add_foreign_kes_to_tasks_table extends CDbMigration
{
	public function up()
	{
		$this->addForeignKey('status_id', 'tbl_tasks', 'status_id', 'tbl_statuses', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('comment_id', 'tbl_tasks', 'comment_id', 'tbl_comments', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('status_id', 'tbl_tasks');
		$this->dropForeignKey('comment_id', 'tbl_tasks');
	}
}