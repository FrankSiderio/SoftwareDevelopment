<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";
	
	$conn = mysqli_connect($servername, $username, $password);
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	function query($sql) {
		global $conn;
		return mysqli_query($conn, $sql);
	}
	
	function query_error($sql) {
		global $conn;
		if (!mysqli_query($conn, $sql)) {
			return mysqli_error($conn);
		}
		return "No Error";
	}

	function createTable ($table, $cols) {
		$sql = "CREATE TABLE $table (" . implode(", ", $cols) . ")";
		
		return query($sql);
	}
	
	function insertInto ($table, $cols, $vals) {
		$sql = "INSERT INTO $table (". implode(", ", $cols). ")
		VALUES (" . implode(", ", $vals) . ")";
		
		return query($sql);
	}
	
	function createRA($table, $vals) {
		$vals[] = 5;
		return insertInto($table, ["name", "year", "laundry", "kitchen", "vacancy"], $vals);
	}
	
	function tableExists ($table) {
		$sql = "SELECT * FROM $table";
		
		if (query($sql) !== FALSE) {
			return true;
		} else {
			return false;
		}
	}
?>