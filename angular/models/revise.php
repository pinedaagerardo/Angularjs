<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include 'conn.php';
	
	$c=new dbConn();
	$conn=$c->connect();
	$res=$c->get_all($conn);
	$out="";
	while($row=pg_fetch_row($res)){
		if ($out != "") {
			$out .= ",";
		}

		$out .= "{\"id\":\""  . trim($row[0]) . "\",";
		$out .= "\"name\":\""  . trim($row[1]) . "\"}";
	}
	
	$c->freeConnection($res);
	$c->disconnect($conn);
	$c=null;
	echo '{"records":['.$out.']}';
?>