<?php
	include '../conn/conn.php';
	
	$c=new dbConn();
	$conn=$c->connect();
	$res=$c->get_all($conn);
	echo "<form action=\"../modules/delete.php\" method=\"post\">";
	while($row=pg_fetch_row($res)){
		echo "Id: " . $row[0] . " Name: " . $row[1];
		echo "<input type=\"text\" name=\"tmp\">";
		echo "<input type=\"submit\" value=\"procesar\">";
		echo "<br/>";
	}
	echo "<form/>";
	$c->freeConnection($res);
	$c->disconnect($conn);
	$c=null;
?>