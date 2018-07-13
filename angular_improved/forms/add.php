<div>
	<form name="myForm">
		Id: <input ng-model="id" name="txtId" type="number" min="1" required>&nbsp;
		Name: <input ng-model="name" name="txtName" type="text" required ng-trim="true">&nbsp;
		<input type="submit" value="Enviar" ng-click="insert()" ng-show="id && name">
		<div role="alert">
			<div class="error" ng-show="myForm.txtName.$error.required || myForm.txtId.$error.required">
				Information is not complete<br/>
			</div>
			<div class="error" ng-show="myForm.txtId.$error.number || myForm.txtId.$error.min">
				Not valid number!<br/>
			</div>
		</div>
	</form>
	<div ng-controller="reviseCtrl" ng-include="'forms/revise.php'"></div>
</div>