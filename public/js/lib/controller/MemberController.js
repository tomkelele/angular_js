var url = 'http://127.0.0.1:8000/dashboard/member/';
app.controller('MemberController', function($scope, $http) {
	$http.get(url + 'list').then(function successCallback(response) {
		console.log(response.data);
		$scope.members = response.data;
	}, function errorCallback(response) {
		sweetAlert("Error", "Something went wrong!", "error");
	});

	$scope.modal = function() {
		$('#myModal').modal('show');
	}
});