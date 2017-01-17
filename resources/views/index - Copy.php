 <!DOCTYPE html>
<html lang="en-US">
<head>
	<title>The Amazing PHP - AngularJS Single-page Application with Lumen CRUD Services</title>
	
	<!-- Load Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<div ng-app="myApp" ng-controller="usersCtrl">

		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th><a href="#" class="btn btn-primary btn-sm">Add User</a></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="user in users" ng-hide="isHidden{{user.id}}">
					<td>{{ user.id }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.phone }}</td>
					<td>
						<md-button ng-href="#" class="md-raised md-primary md-sm">Detail</md-button>
						<md-button ng-href="#" class="md-raised md-primary">Edit</md-button>
						<md-button ng-href="#" class="md-raised md-warn btn-delete" ng-click="confirmDelete(user.id)">Delete</a>
					</td>
				</tr>
			</tbody>
		</table>

	</div>

	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<script>
	var app = angular.module('myApp', ['ngMaterial']);
	app.controller('usersCtrl', function($scope, $http) {
	$http.get("http://localhost:8000/read-users")
	.success(function(response) {
			$scope.users = response;
			$scope.confirmDelete = function(id){
				var isOkDelete = confirm('Is it ok to delete this?');
				if(isOkDelete){
					$http.post('http://localhost:8000/delete-user', {id:id}).success(function(data){
						//eval("$scope.isHidden"+id+" = true;");
						console.log(data);
					}).
					error(function(data) {
						console.log(data);
						alert(data.id);
					});
				} else {
					return false;
				}
			}
			//console.log(response[0].id);
		});

	});
	</script> 

</body>
</html> 