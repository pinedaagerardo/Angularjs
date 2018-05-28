<?php
class dbConn{

	const host="localhost";

	function connect(){
		$conn=pg_connect("host=" . self::host . " port=5432 dbname=db_test user=user_test password=1234567 connect_timeout=5")
		or die("Error in connection: ".pg_last_error());

		return $conn;
	}

	function disconnect($conn){
		pg_close($conn);
	}

	function freeConnection($res){
		pg_free_result($res);
	}

	function get_all($conn){
		$cursor="myCursor";
		pg_query($conn,"BEGIN;");
		$res=pg_query_params($conn, "SELECT get_all($1);", array(&$cursor));
		$res=pg_query($conn, "FETCH ALL IN \"$cursor\";");
		pg_query($conn,"COMMIT;");

		return $res;
	}

	function insert($conn, $id, $name){
		pg_prepare($conn, "insert", "select add_item($1,$2);");
		return pg_execute($conn, "insert", array($id, $name));

	}

	function delete($conn, $id){
		pg_prepare($conn, "delete", "select delete_item($1);");
		pg_execute($conn, "delete", array($id));
	}
}
?>