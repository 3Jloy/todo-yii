<?php

class TasksController extends RestController
{

	public $defaultAction = 'index';

	public function actionIndex() {
		$this->render('index');
	}

	public  function actionList() {
		$tasks = Task::model()->findAll();
		echo CJSON::encode($tasks);
	}

	public function actionView($id) {
		$task = Task::model()->findByPk($id);
		if (null === $task) {
			$this->_sendResponse(404, CJSON::encode(array(
				'message' => 'Could not find task with id = '.$id
			)));
		} else {
			echo CJSON::encode($task);
		}

	}

	public function actionCreate() {
		$data = CJSON::decode(file_get_contents('php://input'));
		$task = new Task();
		$task->attributes = $data;
		if ($task->save()) {
			$this->_sendResponse(200, CJSON::encode($task));
		}else{
			$this->_sendResponse(500, CJSON::encode(array(
				'message' => 'Could not save task',
				'errors'	=> $task->getErrors(),
			)));
		}
	}

	public function actionUpdate($id) {
		$data = CJSON::decode(file_get_contents('php://input'));
		$task = Task::model()->findByPk($id);
		if (null === $task) {
			$this->_sendResponse(404, CJSON::encode(array(
				'message' => 'Could not find task with id = '.$id
			)));
		}
		$task->attributes = $data;
		if ($task->save()) {
			$this->_sendResponse(200, CJSON::encode($task));
		} else {
			$this->_sendResponse(500, CJSON::encode(array(
				'message' => 'Could not save task',
				'errors'  => $task->getErrors(),
			)));
		}
	}

	public function actionDelete($id) {
		$task = Task::model()->findByPk($id);
		if (null === $task) {
			$this->_sendResponse(404, CJSON::encode(array(
				'message' => 'Could not find task with id = '.$id,
			)));
		}

		if ($task->delete()) {
			$this->_sendResponse(200, CJSON::encode($task));
		} else {
			$this->_sendResponse(500, CJSON::encode(array(
				'message' => 'Could not delete task',
				'errors'  => $task->getErrors(),
			)));
		}
	}
}