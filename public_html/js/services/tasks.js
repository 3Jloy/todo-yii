'use strict';

app.factory('Tasks', ['$http', '$rootScope', function($http, $rootScope) {
  
  var tasks = [];
  var statuses = [];

  function getTasks() {
    $http({ method: 'GET', url: 'api/tasks' })
      .success(function(data, status, headers, config) {
        tasks = data;
        $http({ method: 'GET', url: 'api/statuses' })
          .success(function(data, status, headers, config) {
            statuses = data;
            $rootScope.$broadcast('tasks:updated');
          })
      })
      .error(function(data, status, headers, config) {
        console.log(data);
      });
  }
  getTasks();

  var service = {};

  service.getAll = function() {
    return tasks;
  }

  service.getAllStatuses = function() {
    return statuses;
  }

  service.get = function(id) {
    var task = null;
    
    angular.forEach(tasks, function(value) {
      if (parseInt(value.id) === parseInt(id)) {
        task = value;
        return false;
      };
    });

    return task;
  }

  service.add = function(task) {
    $http({method: 'POST', url: 'api/tasks', data: task})
      .success(function(data, status, headers, config) {
        tasks.push(data);
        $rootScope.$broadcast('task:added', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('task:error', data);
      });
  }

  service.update = function(task) {
    $http({method: 'PUT', url: 'api/tasks/'+task.id, data: task})
      .success(function(data, status, headers, config) {
        $rootScope.$broadcast('task:updated', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('task:error', data);
      });
  }

  service.delete = function(task) {
    $http({method: 'DELETE', url: 'api/tasks/'+task.id})
      .success(function(data, status, headers, config){
        angular.forEach(tasks, function(value, i) {
          if (parseInt(value.id) === parseInt(task.id)) {
            tasks.splice(i, 1);
            return false;
          };
        });
        $rootScope.$broadcast('task:deleted', data);
      })
      .error(function(data, status, headers, config) {
        $rootScope.$broadcast('task:error', data);
      });

  }

  service.save = function(task) {
    if (undefined !== task.id && parseInt(task.id) > 0) {
      service.update(task);
    } else {
      service.add(task);
    }
  }

  return service;
}]);