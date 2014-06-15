<?php

class m140614_195407_add_column_created_at_to_comments_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_comments', 'created_at', 'datetime');
	}

	public function down()
	{
		$this->dropColumn('tbl_comments', 'created_at');
	}
}