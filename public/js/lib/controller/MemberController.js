var url =  window.location.href;

app.controller('MemberController', function ($scope, $http) {
	$http.get(url + '/member/list').then(function successCallback (response) {
		$scope.members = response.data;
	}, function errorCallback (response) {
		sweetAlert("Error", "Something went wrong!", "error");
	});

	$scope.modal = function (state, id) {
		$('#myModal').modal('show');
		$scope.state = state;
		var id_member = id;
		if (state == 'add') {
			$scope.member = {};
			$('input[type=file]').val('');
			$scope.modalForm.$setPristine(true);
			$scope.modalTitle = 'Add new members';
			$scope.modalBtn = 'Add';
		}else if(state == 'edit') {
			$scope.modalTitle = 'Edit members';
			$scope.modalBtn = 'Edit';
			$('input[type=file]').val('');
			$http({
				method : 'POST',
				url : url + '/member/detail',
				data : {
					id : id_member,
				},
			}).then(function successCallback (response) {
				$scope.member = response.data;
			}, function errorCallback (response) {
				sweetAlert("Error", "Something went wrong!", "error");
			});
		}
	}

	$scope.save = function (state,id) {
		if ( state == 'add' ) {
			if ($scope.modalForm.$invalid == false) {
				$http({
	                method: 'POST',
	                url: url + '/member/insert',
	                headers: {'Content-Type': undefined},
	                data: {
	                    name: $scope.member.name,
	                    age: $scope.member.age,
	                    gender: $scope.member.gender,
	                    address: $scope.member.address,
	                    photo: $scope.file,
	                },
	                transformRequest: function (data, headersGetter) {
	                    var formData = new FormData();
	                    angular.forEach(data, function (value, key) {
	                        formData.append(key, value);
	                    });
	                    return formData;
	                }
	            }).then(function successCallback(response) {
	            	$scope.members = response.data;
					$('#myModal').modal('hide');
					sweetAlert("Success", "New member was added!", "success");
	            },function errorCallback(response) {
	            	console.log(response);
	            	sweetAlert("Error", "Something went wrong! (Status : " + response.status + ")", "error");
	            });
			}
		} else if (state == 'edit') {
			if ($scope.modalForm.$invalid == false) {
				$http({
					method : 'POST',
					url : url + '/member/update',
					headers : { 'Content-Type' : undefined },
					data : {
						id : id,
						name : $scope.member.name,
						age : $scope.member.age,
						gender : $scope.member.gender,
						address : $scope.member.address,
						photo : $scope.file,
					},
					transformRequest: function (data, headersGetter) {
						var formData = new FormData();
						angular.forEach(data, function (value, key) {
							formData.append(key, value);
						});
						return formData;
					}
				}).then(function successCallback(response) {
					$scope.members = response.data;
					$('#myModal').modal('hide');
					sweetAlert("Success", "Member was edited", "success");
				}, function errorCallback(response) {
					sweetAlert("Error", "Something went wrong!", "error");
				});
			}
		}
	}

	$scope.delete = function (index) {
		swal({
			title: "Are you fucking sure ?",
			text: "You will not able to recover this member!",
			type: "error",
			showCancelButton: true,
  			confirmButtonColor: "#DD6B55",
  			confirmButtonText: "Yes, delete it!",
  			closeOnConfirm: false
		},
		function () {
			$http({
				method : 'POST',
				url : url + '/member/destroy',
				data : {
					id : index,
				}
			}).then(function successCallback (response) {
				$scope.members = response.data;
				sweetAlert("Congratulation", "You just kicked some asshole out of the squad", "success");
			}, function errorCallback (response) {
				sweetAlert("Error", "Something went wrong!", "error");
			});
		});
	}
});