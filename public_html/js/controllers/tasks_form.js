'use strict';

app.controller('TasksFormController', 
  ['$scope', '$rootScope', 'Tasks', '$routeParams', '$location',
  function($scope, $rootScope, Tasks, $routeParams, $location) {
    $scope.task = {};
    $scope.task.status_id = '1';
    $scope.isNew = true;
    $scope.saving = false;
    $scope.statuses = Tasks.getAllStatuses();
    
    $rootScope.$on('tasks:updated', function() {
      $scope.statuses = Tasks.getAllStatuses();
    });

    $scope.showErrors = false;
    $scope.errors = [];

    if ($routeParams.taskId !== undefined) {
      $scope.task = Tasks.get($routeParams.taskId);
      if (undefined === $scope.task || null === $scope.task) {
        // task with this id not found
        $location.path('/add').replace();
      };
      $scope.isNew = false;
    };

    $scope.save = function() {
      Tasks.save($scope.task);
      $scope.saving = true;
      $scope.showErrors = false;
    };

    $rootScope.$on('task:updated', function() {
      $scope.saving = false;
      $location.path('/list').replace();
    });

    $rootScope.$on('task:added', function(event, data) {
      $scope.saving = false;
      $location.path('/list').replace();
    });

    $rootScope.$on('task:error', function(event, data) {
      $scope.showErrors = true;
      $scope.errors = [];
      angular.forEach(data.errors, function(error) {
        if (typeof error == 'object') {
          angular.forEach(error, function(err) {
            $scope.errors.push(err);
          });
        } else {
          $scope.errors.push(error);
        }
      });
      $scope.saving = false;
    });
}]);