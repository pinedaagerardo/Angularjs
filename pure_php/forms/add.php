<!DOCTYPE html>
<html>
<head>
	<title>Agregar nuevo</title>
</head>
<body>
	<form action="../modules/add.php" method="post">
		Id: <input type="text" name="txtId"><br/>
		Nombre: <input type="text" name="txtName"><br/>
		<input type="submit" value="Enviar">
	</form>
	<?php
		include '../modules/revise.php';
	?>
	<br/>
	<a href="menu.php">Menu</a>
</body>
</html>