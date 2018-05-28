(function(){
	var routes=angular.module("myApp", ["ngRoute"]);

	routes.config(function($routeProvider){
		$routeProvider
		.when("/menu", {
			templateUrl: "forms/menu.php"
			,controller: "menuCtrl"
		})
		.when("/revise", {
			templateUrl: "forms/revise.php"
			,controller: "reviseCtrl"
		})
		.when("/add", {
			templateUrl: "forms/add.php"
			,controller: "addCtrl"
		})
		.otherwise({redirectTo: "/menu"});
	});
}());