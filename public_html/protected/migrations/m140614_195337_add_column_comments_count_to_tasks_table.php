<?php

class m140614_195337_add_column_comments_count_to_tasks_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_tasks', 'comments_count', 'integer');
	}

	public function down()
	{
		$this->dropColumn('tbl_tasks', 'comments_count');
	}
}