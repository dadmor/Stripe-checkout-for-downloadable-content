angular.module('hakaToRun', ['ngMaterial'])

	.controller('mainController', function($scope, $http) {

		$http.get('config.json').success(function(data) {
			$scope.credentials = data;
			console.log(data);
		});
		
	});