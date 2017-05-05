app.directive('numeric', function () {
	return {
		restrict : 'A',
		require : 'ngModel',
		link : function (scope, element, attrs, ngModel) {
			ngModel.$validators.numeric = function (modelValue, viewValue) {
				var pattern = /^[0-9]{1,2}$/;
				if (pattern.test(modelValue) == true) {
					return true;
				} else {
					return false;
				}
			}
		}
	}
});