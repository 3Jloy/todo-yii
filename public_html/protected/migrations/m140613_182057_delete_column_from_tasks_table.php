<?php

class m140613_182057_delete_column_from_tasks_table extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('comment_id', 'tbl_tasks');
		$this->dropColumn('tbl_tasks', 'comment_id');
	}

	public function down()
	{
		$this->addColumn('tbl_tasks', 'comment_id', 'integer');
		$this->addForeignKey('comment_id', 'tbl_tasks', 'comment_id', 'tbl_comments', 'id', 'CASCADE', 'CASCADE');
	}
}