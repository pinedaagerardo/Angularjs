<?php
	include 'conn.php';

	$data = json_decode(file_get_contents("php://input"));
	$id=test_input($data->id);
	$name=test_input($data->name);

	$c=new dbConn();
	$conn=$c->connect();
	$res = $c->insert($conn, $id, $name);
	$c->disconnect($conn);
	$c=null;
	echo "$id, $name";

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>