'use strict';

app.controller('TasksViewController', 
  ['$scope', '$rootScope', 'Tasks', 'Comments', '$routeParams', '$location',
  function($scope, $rootScope, Tasks, Comments, $routeParams, $location) {
    $scope.task = {};
    $scope.statuses = Tasks.getAllStatuses();
    $scope.task = Tasks.get($routeParams.taskId);
    $scope.showComments = false;

    $rootScope.$on('tasks:updated', function() {
      $scope.statuses = Tasks.getAllStatuses();
      $scope.task = Tasks.get($routeParams.taskId);
    });

    $scope.getStatusTitle = function(task) {
      var status = null;
      angular.forEach($scope.statuses, function(value) {
        if (parseInt(value.id) === parseInt(task.status_id)) {
          status = value;
          return false;
        };
      });
      if (status !== null) {
        return status.title;  
      } else {
        return false;
      }

    }

    $scope.comments = Comments.getCommentsByTask($routeParams.taskId);

    $scope.getComments = function(task) {
      $scope.comments = Comments.getCommentsByTask(task.id);
      $rootScope.$on('comments:updated', function() {
        $scope.showComments= true;
      })
    }

    $rootScope.$on('comment:added', function(event, data) {
      $scope.comments = Comments.getComments();
      $scope.task.comments_count ++;
    });

}]);