<?php

class m140612_114514_add_data_to_statuses_table extends CDbMigration
{
  
  public function safeUp()
  {
    $statuses = ['New', 'Complete', 'Not possible to perform'];

    foreach ($statuses as $status) {
      # code...
      $this->insert('tbl_statuses',array(
        'title'=> $status,
      ));
    }
  }

  public function safeDown()
  {
    $this->dropForeignKey('status_id', 'tbl_tasks');
    $this->truncateTable('tbl_statuses');
    $this->addForeignKey('status_id', 'tbl_tasks', 'status_id', 'tbl_statuses', 'id', 'CASCADE', 'CASCADE');
  }
  
}