var url = 'http://127.0.0.1:8000/dashboard/member/';

app.directive('file', function () {
    return {
        scope: {
            file: '='
        },
        link: function (scope, el, attrs) {
            el.bind('change', function (event) {
                var file = event.target.files[0];
                scope.file = file ? file : undefined;
                scope.$apply();
            });
        }
    };
});

app.controller('MemberController', function ($scope, $http) {
	$http.get(url + 'list').then(function successCallback (response) {
		console.log(response.data);
		$scope.members = response.data;
	}, function errorCallback (response) {
		sweetAlert("Error", "Something went wrong!", "error");
	});

	$scope.modal = function (state) {
		$('#myModal').modal('show');
		$scope.state = state;
		if (state == 'add') {
			$scope.modalTitle = 'Add new members';
			$scope.modalBtn = 'Add';
		}else if(state == 'edit') {
			$scope.modalTitle = 'Edit members';
			$scope.modalBtn = 'Edit';
		}
	}

	$scope.save = function (state) {
		if ( state == 'add' ) {
			$http({
                method: 'POST',
                url: url + 'insert',
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
            	sweetAlert("Error", "Something went wrong!", "error");
            });
		} else if (state == 'edit') {

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
				url : url + 'destroy',
				data : {
					id : index,
				}
			}).then(function successCallback (response) {
				$scope.members = response.data;
				sweetAlert("Congratulation", "You just kicked some asshole out of the squad", "success");
			}, function errorCallback (response) {

			});
		});
	}
});