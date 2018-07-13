<?php
	include 'conn.php';

	$data = json_decode(file_get_contents("php://input"));
	$id=$data->id;
	$newValue=$data->newValue;

	$c=new dbConn();
	$conn=$c->connect();
	$c->edit($conn, $id, $newValue);
	$c->disconnect($conn);
	$c=null;
	
	echo $id;
?>