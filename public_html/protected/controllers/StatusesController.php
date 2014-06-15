<?php

class StatusesController extends RestController
{
  public  function actionList() {
    $statuses = Status::model()->findAll();
    echo CJSON::encode($statuses);
  }

  public function actionView($id) {

  }

  public function actionCreate() {

  }

  public function actionUpdate($id) {

  }

  public function actionDelete($id) {

  }
}