@extends('layouts.dashboard-layout')

@section('contents')
<div ng-controller="MemberController">
	<button class="btn btn-primary pull-right" ng-click="modal('add')">Add new Member</button>
	<table class="table">
		<thead>
			<th>ID</th>
			<th>Photo</th>
			<th>Name <a href=""><i class="fa fa-sort" aria-hidden="true"></i></a></th>
			<th>Age <a href=""><i class="fa fa-sort" aria-hidden="true"></i></a></th>
			<th>Gender</th>
			<th>Adress <a href=""><i class="fa fa-sort" aria-hidden="true"></i></a></th>
			<th>Action</th>
		</thead>
		<tbody>
			<tr ng-repeat="member in members">
				<td>@{{ member.id }}</td>
				<td><img ng-src="{{ url('upload/avatar') }}/@{{ member.photo }}" class="img-circle" height="70" width="90"></td>
				<td>@{{ member.name }}</td>
				<td>@{{ member.age }}</td>
				<td>
					<span ng-if="member.gender == 0">Male</span>
					<span ng-if="member.gender == 1">Female</span>
				</td>
				<td>@{{ member.address }}</td>
				<td>
					<button class="btn btn-warning" ng-click="modal('edit',member.id)"> Edit</button>
					<button class="btn btn-danger" ng-click="delete(member.id)"> Delete</button>
				</td>
			</tr>
		</tbody>
	</table>
	<div id="myModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
	    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">@{{ modalTitle }}</h4>
		      	</div>
		      	<div class="modal-body">
		      		<form name="modalForm" role="form" novalidate>
						<div class="form-group">
						    <label for="name">Name :</label>
						    <input type="text" class="form-control" name="name" placeholder="Enter member's name" ng-model="member.name" required ng-maxlength="100">
						    <span style="color:red;" ng-show="modalForm.name.$error.required && modalForm.$submitted">Your name is required.</span>
						    <span style="color:red;" ng-show="modalForm.name.$error.maxlength && modalForm.$submitted">Your name can not be greater than 100 characters.</span>
						</div>
						<div class="form-group">
						    <label for="age">Age :</label>
						    <input type="text" class="form-control" name="age" placeholder="Enter member's age" ng-model="member.age" required numeric>
						    <span style="color:red;" ng-show="modalForm.age.$error.required && modalForm.$submitted">Your age is required.</span>
						    <span style="color:red;" ng-show="modalForm.age.$error.numeric && modalForm.$submitted">Your age can contain only number and not be greater than 2 digits.</span>						    
						</div>
						<div class="form-group">
						    <label for="address">Adress :</label>
						    <input type="text" class="form-control" name="address" placeholder="Enter member's address" ng-model="member.address" required ng-maxlength="300">
						    <span style="color:red;" ng-show="modalForm.address.$error.required && modalForm.$submitted">Your adress is required.</span>
						    <span style="color:red;" ng-show="modalForm.address.$error.maxlength && modalForm.$submitted">Your adress can not be greater than 300 characters.</span>
						</div>
						<div class="form-group">
						    <label for="age">Gender :</label>
						    <select class="form-control" name="gender" ng-model="member.gender" required>
						    	<option value="0" ng-selected="member.gender == 0">Male</option>
						    	<option value="1" ng-selected="member.gender == 1">Female</option>
						    </select>
						    <span style="color:red;" ng-show="modalForm.gender.$error.required && modalForm.$submitted">Your gender is required.</span>
						</div>
						<div class="form-group">
							<label for="photo">Photo :</label>
							<input type="file" ng-model="file" file name="file">
							<span style="color:red;" ng-show="modalForm.file.$error.size && modalForm.$submitted">Your image can not be greater than 10MB.</span>
							<span style="color:red;" ng-show="modalForm.file.$error.extension && modalForm.$submitted">Your image need to be an jpg, png or gif.</span>
						</div>
				      	<div class="modal-footer">
				      		<button type="submit" class="btn btn-success" ng-click="save(state,member.id)">@{{ modalBtn }}</button>
				        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				      	</div>
					</form>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ url('js/lib/controller/MemberController.js') }}"></script>
	<script src="{{ url('js/lib/directive/fileDirective.js') }}"></script>
	<script src="{{ url('js/lib/directive/numeric.js') }}"></script>
@endsection
