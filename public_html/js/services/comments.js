'use strict';

app.factory('Comments', ['$http', '$rootScope', function($http, $rootScope) {
  
  var comments = [];

  // function getComments() {
  //   $http({ method: 'GET', url: 'api/comments' })
  //     .success(function(data, status, headers, config) {
  //       comments = data;
  //       $rootScope.$broadcast('comments:updated');
  //     })
  //     .error(function(data, status, headers, config) {
  //       console.log(data);
  //     });
  // }
  // getComments();

  var service = {};

  service.getCommentsByTask = function(id) {
    $http({ method: 'GET', url: 'api/tasks/'+id+'/comments' })
      .success(function(data, status, headers, config) {
        comments = data;
        $rootScope.$broadcast('comments:updated');
      })
      .error(function(data, status, headers, config) {
        console.log(data);
      });

    return comments;
  }

  service.getComments = function() {
    return comments;
  }

  service.get = function(id) {
    var comment = null;
    angular.forEach(comments, function(value) {
      if (parseInt(value.id) === parseInt(id)) {
        comment = value;
        return false;
      };
    });

    return comment;
  }

  service.add = function(comment) {
    $http({method: 'POST', url: 'api/comments', data: comment})
      .success(function(data, status, headers, config) {
        comments.push(data);
        $rootScope.$broadcast('comment:added', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('comment:error', data);
      });
  }

  service.update = function(comment) {
    $http({method: 'PUT', url: 'api/comments/'+comment.id, data: comment})
      .success(function(data, status, headers, config) {
        $rootScope.$broadcast('comment:updated', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('comment:error', data);
      });
  }

  service.delete = function(comment) {
    $http({method: 'DELETE', url: 'api/comments/'+comment.id})
      .success(function(data, status, headers, config){
        angular.forEach(comments, function(value, i) {
          if (parseInt(value.id) === parseInt(comment.id)) {
            comments.splice(i, 1);
            return false;
          };
        });
        $rootScope.$broadcast('comment:deleted', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('comment:error', data);
      });

  }

  service.save = function(comment) {
    service.add(comment);
  }

  return service;
}]);