(function(){
	
	var app=angular.module("myApp");

	var addCtrl=function($scope, $http, $route){
		$scope.insert=function(){
			$http.post("models/add.php",{
				'id':$scope.id
				,'name':$scope.name
			}).then(function(response){
				if(response.data!=$scope.id+', '+$scope.name){
					alert(response.data);
				}else{
					console.log("Data inserted correctly. "+response.data);
					$route.reload();
				}
			}, function(error){
				alert("Insert failed");
			});
		};
	};

	app.controller('addCtrl', addCtrl);
}());