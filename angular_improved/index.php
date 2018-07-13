<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.angularjs.org/1.7.0/angular.js"></script>
	<script src="https://code.angularjs.org/1.7.0/angular-route.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
	
	<script src="routing/routes.js"></script>
	<script src="controllers/menuCtrl.js"></script>
	<script src="controllers/reviseCtrl.js"></script>
	<script src="controllers/addCtrl.js"></script>
</head>
<body class="container">
	<h1>My Application</h1>
	<div ng-view></div>
</body>
</html>