<?php
	include '../conn/conn.php';

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$id=test_input($_POST["txtId"]);
		$name=test_input($_POST["txtName"]);
	}else{
		header('Location: ../forms/add.php');
	}

	$c=new dbConn();
	$conn=$c->connect();
	$c->insert($conn, $id, $name);
	$c->disconnect($conn);
	$c=null;
	header('Location: ../forms/add.php');

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>