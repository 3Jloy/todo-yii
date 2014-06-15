'use strict';

app.controller('CommentsFormController', 
  ['$scope', '$rootScope', 'Comments', '$routeParams', '$location',
  function($scope, $rootScope, Comments, $routeParams, $location) {
    $scope.comment = {};
    $scope.saving = false;

    $scope.showErrors = false;
    $scope.errors = [];

    $scope.save = function(task) {
      $scope.comment.task_id = task.id;
      Comments.save($scope.comment);
      $scope.saving = true;
      $scope.showErrors = false;
      $scope.comment = {};
    };

    $rootScope.$on('comment:updated', function() {
      $scope.saving = false;
      // $location.path('/list').replace();
    });

    $rootScope.$on('comment:added', function(event, data) {
      $scope.saving = false;
      // $location.path('/list').replace();
    });

    $rootScope.$on('comment:error', function(event, data) {
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