<?php

/**
 * This is the model class for table "tbl_comments".
 *
 * The followings are the available columns in table 'tbl_comments':
 * @property integer $id
 * @property string $text
 * @property integer $task_id
 *
 * The followings are the available model relations:
 * @property Tasks $task
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			array('task_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, text, task_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'task' => array(self::BELONGS_TO, 'Tasks', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
			'task_id' => 'Task',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('task_id',$this->task_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Save datetime automaticly for comment before save tsk
	 * @todo add updated_at column to Comment for save update date
	 */
	protected function beforeSave() 
	{
    if(parent::beforeSave()) {
      if($this->isNewRecord) {
        $this->created_at = date("Y-m-d H:i:s", time());
      } else {
        // $this->updated_at=time();
      }
      return true;
    } else {
      return false;
    }
	}

	/**
	 * Save count comments to Task
	 */
	protected function afterSave()
	{
    parent::afterSave();
    $task = Task::model()->findByPk($this->task_id);
    $task->attributes = array('comments_count' => $task->commentsCount);
    if ($task->save()) {
    	return true;
    } else {
    	return false;
    }
	}
}
