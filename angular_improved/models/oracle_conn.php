<?php
class dbConn{
//oracle
	const host="localhost";

	function connect(){
		$conn = odbc_connect("DRIVER={Microsoft ODBC for Oracle};SERVER=" . self::host . ";Uid=testuser;Pwd=1234567g;","testuser","1234567g") or die("Error in connection");
	    return $conn;
	}

	function disconnect($conn){
		odbc_close($conn);
	}

	function freeConnection($res){
		odbc_free_result($res);
	}

	function consult($conn,$sql){
	    $res=odbc_prepare($conn,$sql);
		odbc_execute($res);
		return $res;
	}

	function ejecutar($conn,$sql){
	    $res=odbc_prepare($conn,$sql);
		odbc_execute($res);
	}


	function get_all($conn){
		$sql = "BEGIN get_all_data(:cursor); END;";
		$stmt = oci_parse($conn, $sql);
		$cursor = oci_new_cursor($conn);
		oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);
		oci_execute($stmt);
		oci_execute($cursor);

		return $cursor;
	}

	function insert($conn, $id, $name){
		$sql = "BEGIN add_item(:id,:name); END;";
		$stmt = oci_parse($conn,$sql);
		oci_bind_by_name($stmt,':name',$name);
		oci_bind_by_name($stmt,':id',$id);
		return oci_execute($stmt);
	}

	function delete($conn, $id){
		$sql = "BEGIN delete_item(:id); END;";
		$stmt = oci_parse($conn,$sql);
		oci_bind_by_name($stmt,':id',$id);
		return oci_execute($stmt);
	}

	function edit($conn, $id, $newValue){
		$sql = "BEGIN edit_item(:id, :name); END;";
		$stmt = oci_parse($conn,$sql);
		oci_bind_by_name($stmt,':name',$newValue);
		oci_bind_by_name($stmt,':id',$id);
		return oci_execute($stmt);
	}
}
?>