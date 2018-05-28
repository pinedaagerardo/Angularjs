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
	if($res!=""){
		echo substr($res,strpos($res,"DETAIL:")+8,strpos($res,"CONTEXT:")-1);
	}else{
		echo "$id, $name";
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>