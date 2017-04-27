@extends('layouts.dashboard-layout')

@section('contents')
<div ng-controller="MemberController">
	<button class="btn btn-primary pull-right" ng-click="modal('add')">Add new Member</button>
	<table class="table">
		<thead>
			<th>ID</th>
			<th>Photo</th>
			<th>Name</th>
			<th>Age</th>
			<th>Gender</th>
			<th>Adress</th>
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
		      		<form enctype="multipart/form-data" name="modalForm" role="form">
						<div class="form-group">
						    <label for="name">Name :</label>
						    <input type="text" class="form-control" name="name" placeholder="Enter member's name" ng-model="member.name">
						</div>
						<div class="form-group">
						    <label for="age">Age :</label>
						    <input type="text" class="form-control" name="age" placeholder="Enter member's age" ng-model="member.age">
						</div>
						<div class="form-group">
						    <label for="address">Adress :</label>
						    <input type="text" class="form-control" name="address" placeholder="Enter member's address" ng-model="member.address">
						</div>
						<div class="form-group">
						    <label for="age">Gender :</label>
						    <select class="form-control" ng-model="member.gender">
						    	<option value="0" ng-selected="member.gender == 0">Male</option>
						    	<option value="1" ng-selected="member.gender == 1">Female</option>
						    </select>
						</div>
						<div class="form-group">
							<label for="photo">Photo :</label>
							<input type="file" file="file" class="form-control">
							<p style="color:red;">@{{ errorMessage }}</p>
						</div>
					</form>
		      	</div>
		      	<div class="modal-footer">
		      		<button class="btn btn-success" ng-click="save(state,member.id)">@{{ modalBtn }}</button>
		        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ url('js/lib/controller/MemberController.js') }}"></script>
@endsection
