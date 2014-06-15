'use strict';

app.controller('TasksListController', 
  ['$scope', '$rootScope', 'Tasks', '$dialog',
  function($scope, $rootScope, Tasks, $dialog) {
    $scope.tasks = Tasks.getAll();
    $scope.statuses = Tasks.getAllStatuses();
    
    $rootScope.$on('tasks:updated', function() {
      $scope.tasks = Tasks.getAll();
      $scope.statuses = Tasks.getAllStatuses();
    });

    $scope.isEmpty = function() {
      if ($scope.tasks.length === 0) {
        return true;
      }
      return false;
    }

    $scope.getStatusTitle = function(task) {
      var status = null;
      angular.forEach($scope.statuses, function(value) {
        if (parseInt(value.id) === parseInt(task.status_id)) {
          status = value;
          return false;
        };
      });

      return status.title;
    }

    $scope.confirm = function(task) {
      var title = 'Confirm';
      var msg = 'Do you really want to delete this task?';
      var btns = [{result: 'no', label: 'No'}, {result: 'yes', label: 'Yes', cssClass: 'btn-danger'}];

      $dialog.messageBox(title, msg, btns).open().then(function(result) {
        if (result === 'yes') { $scope.delete(task) };
      });
    };

    $scope.delete = function(task) {
      Tasks.delete(task);
    };

    $scope.show = function(task) {
      $rootScope.$broadcast('task:show', task);
    };
}]);