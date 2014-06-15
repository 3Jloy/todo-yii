<?php

class CommentsController extends RestController
{
  public  function actionList() {
    if (isset($_GET['id'])) {
      $task = Task::model()->findByPk($_GET['id']);
      $comments = $task->comments;
    } else {
      $comments = Comment::model()->findAll();
    }
    echo CJSON::encode($comments);
  }

  public function actionView($id) {
    
  }

  public function actionCreate() {
    $data = CJSON::decode(file_get_contents('php://input'));
    $comment = new Comment();
    $comment->attributes = $data;
    if ($comment->save()) {
      $this->_sendResponse(200, CJSON::encode($comment));
    }else{
      $this->_sendResponse(500, CJSON::encode(array(
        'message' => 'Could not save comment',
        'errors'  => $comment->getErrors(),
      )));
    }
  }

  public function actionUpdate($id) {

  }

  public function actionDelete($id) {

  }
}