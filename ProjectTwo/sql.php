<?php
	require 'sql_helper.php';
	
	 if (!mysqli_select_db($conn, $dbname)) {
		$sql = "CREATE DATABASE $dbname";
		if (mysqli_query($conn, $sql)) {
			mysqli_select_db($conn, $dbname);
		} else {
			echo "Error creating database: " . mysqli_error($conn);
		}
	}
	
	$table = "RAs";
	$table2 = "Reservations"; 
	
	if(!tableExists($table)) {
		createTable($table, [
			"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
			"name TINYTEXT NOT NULL",
			"year TINYINT(1) NOT NULL",
			"laundry TINYINT(1) NOT NULL",
			"kitchen TINYINT(1) NOT NULL",
			"vacancy SMALLINT UNSIGNED NOT NULL"
			]);
			
		createRA($table, ["'Leo Hall'", "1", "1", "1"]);
		createRA($table, ["'Champagnat Hall'", "1", "1", "1"]);
		createRA($table, ["'Marian Hall'", "1", "1", "0"]);
		createRA($table, ["'Sheahan Hall'", "1", "1", "1"]);
		createRA($table, ["'Midrise Hall'", "2", "1", "0"]);
		createRA($table, ["'Foy Townhouses'", "2", "1", "1"]);
		createRA($table, ["'Gartland Commons'", "2", "1", "1"]);
		createRA($table, ["'New Townhouses'", "2", "1", "1"]);
		createRA($table, ["'Lower West Cedar St Townhouses'", "3", "1", "1"]);
		createRA($table, ["'Upper West Cedar St Townhouses'", "3", "1", "1"]);
		createRA($table, ["'Fulton Street Townhouses'", "3", "1", "1"]);
		createRA($table, ["'Talmadge Court'", "3", "1", "1"]);
		createRA($table, ["'New Fulton Townhouses'", "3", "1", "1"]);
	}
	
	if(!tableExists($table2))
	{
		createTable($table, [
			"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
			"name TINYTEXT NOT NULL",
			"year TINYINT(1) NOT NULL",
			"cwid NUMERIC NOT NULL",
			"dorm TINYTEXT NOT NULL",
			"kitchen TINYTEXT(1) NOT NULL"
			]);
			
		
		insertInto($table2, [$name, $year, $cwid, $dorm, $kitchen], $vals);  	
	
	
	}
	
	
?>