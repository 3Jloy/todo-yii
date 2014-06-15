<?php

class m140613_182842_add_column_to_comments_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_comments', 'task_id', 'integer');
		$this->addForeignKey('task_id', 'tbl_comments', 'task_id', 'tbl_tasks', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('task_id', 'tbl_comments');
		$this->dropColumn('tbl_comments', 'task_id');
	}
}