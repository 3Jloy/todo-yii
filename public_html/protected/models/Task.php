<?php

/**
 * This is the model class for table "tbl_tasks".
 *
 * The followings are the available columns in table 'tbl_tasks':
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $created_at
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Statuses $status
 * @property Comments $comment
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tasks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text, status_id', 'required'),
			array('status_id, comments_count', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, text, created_at, status_id', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'task_id'),
			'commentsCount' => array(self::STAT, 'Comment', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'text' => 'Text',
			'created_at' => 'Created At',
			'status_id' => 'Status',
			'comments_count' => 'CommentsCount',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('comments_count',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Save datetime automaticly for task before save tsk
	 * @todo add updated_at column to Task for save update date
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
}
