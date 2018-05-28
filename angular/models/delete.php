<?php
	include 'conn.php';

	$data = json_decode(file_get_contents("php://input"));
	$id=$data->id;

	$c=new dbConn();
	$conn=$c->connect();
	$c->delete($conn, $id);
	$c->disconnect($conn);
	$c=null;
	
	echo $id;
?>