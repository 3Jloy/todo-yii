'use strict';

var app = angular.module('todoyii', ['ui.bootstrap', 'ngRoute']);

app.config(function($routeProvider) {
  $routeProvider.when('/', {
    templateUrl: 'partials/list.html',
    controller: 'TasksListController'
  })
  .when('/add', {
    templateUrl: 'partials/form.html',
    controller: 'TasksFormController'
  })
  .when('/view/:taskId', {
    templateUrl: 'partials/view.html',
    controller: 'TasksViewController'
  })
  .when('/view/:taskId/comments', {
    templateUrl: 'partials/view.html',
    controller: 'TasksViewController'
  })
  .when('/edit/:taskId', {
    templateUrl: 'partials/form.html',
    controller: 'TasksFormController'
  })
  .otherwise({
    redirectTo: '/'
  });
});
