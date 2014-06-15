<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
  'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name'=>'Todo List on Yii, Angular and Bootstrap',
  'defaultController'=>'tasks',
  // preloading 'log' component
  'preload'=>array('log'),

  // path aliases
  'aliases' => array(
    'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
  ),
  
  // autoloading model and component classes
  'import'=>array(
    'application.models.*',
    'application.components.*',
    'bootstrap.helpers.TbHtml',
  ),

  'modules'=>array(
    // uncomment the following to enable the Gii tool
    
    'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'password',
      'generatorPaths' => array('bootstrap.gii'),
    ),
    
  ),

  // application components
  'components'=>array(
    'user'=>array(
      // enable cookie-based authentication
      'allowAutoLogin'=>true,
    ),
    
    'bootstrap' => array(
      'class' => 'bootstrap.components.TbApi',   
    ),
    
    // uncomment the following to enable URLs in path-format
    
    'urlManager'=>array(
      'urlFormat'=>'path',
      'rules'=>array(
          // REST patterns
            // tasks
            array('tasks/list', 'pattern'=>'api/tasks', 'verb'=>'GET'),
            array('tasks/view', 'pattern'=>'api/tasks/<id:\d+>', 'verb'=>'GET'),
            array('tasks/update', 'pattern'=>'api/tasks/<id:\d+>', 'verb'=>'PUT'),
            array('tasks/delete', 'pattern'=>'api/tasks/<id:\d+>', 'verb'=>'DELETE'),
            array('tasks/create', 'pattern'=>'api/tasks', 'verb'=>'POST'),
            array('comments/list', 'pattern'=>'api/tasks/<id:\d+>/comments', 'verb'=>'GET'),
            // statuses
            array('statuses/list', 'pattern'=>'api/statuses', 'verb'=>'GET'),
            // comments
            array('comments/create', 'pattern'=>'api/comments', 'verb'=>'POST'),
          // regular patterns
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
      ),
      'showScriptName'=>false,
    ),
    
    'db'=>array(
      'connectionString' => 'mysql:host=localhost;dbname=yii_todo',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '111',
      'charset' => 'utf8',
    ),
    
    'errorHandler'=>array(
      // use 'site/error' action to display errors
      'errorAction'=>'site/error',
    ),

    'log'=>array(
      'class'=>'CLogRouter',
      'routes'=>array(
        array(
          'class'=>'CFileLogRoute',
          'levels'=>'error, warning',
        ),
        // uncomment the following to show log messages on web pages
        /*
        array(
          'class'=>'CWebLogRoute',
        ),
        */
      ),
    ),
  ),

  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params'=>array(
    // this is used in contact page
    'adminEmail'=>'webmaster@example.com',
  ),
);