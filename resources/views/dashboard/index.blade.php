@extends('layouts.admin-layout')

@section('contents')
<div class="row" ng-app="my-app">
	<div class="col-md-12" ng-controller="MemberController">
		<button class="btn btn-primary pull-right" ng-click="modal()">Add new member</button>
		<table class="table table-striped">
			<thead>
				<th><strong>ID</strong></th>
				<th><strong>Photo</strong></th>
				<th><strong>Name</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>Age</strong></th>
				<th><strong>Gender</strong></th>
				<th><strong>Action</strong></th>
			</thead>
			<tbody>
				<tr ng-repeat="member in members">
					<td>@{{ member.id }}</td>
					<td><img class="img-circle" height="80" ng-src="{{ url('upload/avatar') }}/@{{ member.photo }}"></td>
					<td>@{{ member.name }}</td>
					<td>@{{ member.address }}</td>
					<td>@{{ member.age }}</td>
					<td ng-if="member.gender == 0">Male</td>
					<td ng-if="member.gender == 1">Female</td>
					<td>
						<button class="btn btn-warning" ng-click="modal()"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
						<button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
					</td>
				</tr>
				<div id="myModal" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
		    <!-- Modal content-->
			    <div class="modal-content">
			      	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title">Modal Header</h4>
			      	</div>
			      	<div class="modal-body">
			        	<p>Some text in the modal.</p>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      	</div>
			    </div>
	  		</div>
		</div>
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ url('js/lib/controller/MemberController.js') }}"></script>
@endsection
