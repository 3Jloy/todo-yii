<?php
Yii::app()->clientScript->registerScriptFile('//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular-route.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/ui-bootstrap-tpls-0.4.0.min.js', CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/angular-translate.min.js', CClientScript::POS_END);
// Yii::app()->clientScript->registerScript(
//     'langScript'
//     , '
//     var lang = "'.Yii::app()->getLanguage().'";
//     var translations = '.CJSON::encode(Yii::app()->messages->getAllMessages('frontend', Yii::app()->getLanguage())).';'
//     , CClientScript::POS_HEAD
// );
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/services/tasks.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/services/comments.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/tasks_list.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/tasks_form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/tasks_view.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/comments_form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('requiredScript', 'angular.bootstrap(document, ["todoyii"]);', CClientScript::POS_END);
?>
<div id='app' class="row-fluid">
  <div class="span12" ng-view></div>
</div>