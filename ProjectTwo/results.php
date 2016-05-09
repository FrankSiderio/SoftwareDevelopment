<?php
	require_once 'sql.php';
	$dorm = $_POST['dorm'];
	
	if (!tableExists('Reservations')) {
		if (!createTable('Reservations', [
			"id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
			"name TINYTEXT NOT NULL",
			"housing TINYTEXT NOT NULL"
			])) {
			echo "ERROR: Could not create Reservations Table";
		}
	}
	
	insertInto("Reservations", ["name", "housing"], ["'" . $_POST["name"] . "'", "'" . $_POST["dorm"] . "'"]);
	
	$results = query("SELECT vacancy FROM $table WHERE name = '$dorm'");
	$vacancy = mysqli_fetch_assoc($results)['vacancy'];
	mysqli_free_result($results);
	
	$vacancy--;
	if (!query("UPDATE $table SET vacancy = $vacancy WHERE name = '$dorm'")) {
		echo "ERROR: " . mysqli_error($conn);
	}
?>
<html>
	<head>
	<style>
		body{
		background-color: #6495ed;
	}
		h1{
			text-align: center;
		}
		 #joe{
			width: 500px;
		    padding: 25px;
		    border: 25px solid navy;
		    margin: auto;

		}
	</style>
	</head>
	<body>
	<div id="joe">
		<h1>Results</h1>
		Name: <?php echo $_POST["name"]; ?> <br>
		CWID: <?php echo $_POST["cwid"]; ?> <br>
		Gender: <?php echo $_POST["sex"]; ?> <br>
		Class: <?php echo $_POST["class"]; ?> <br>
		
		Residence: <?php 
			if (isset($_POST["dorm"])) {
				echo $_POST["dorm"];
			}
		?> <br>
		
		Preferred Laundry on Premise: <?php
			if (isset($_POST["laundry"])){
				echo "Yes";
			} else {
				echo "No";
			}
		?> <br>
		Preferred Fully Equipped Kitchen: <?php
			if (isset($_POST["kitchen"])){
				echo "Yes";
			} else {
				echo "No";
			}		
		?> <br>
		Special Needs: <?php echo $_POST["specialNeeds"]; ?>
		<br>
		<br>
		Confirmation Number: <?php
			$results = query("SELECT id FROM reservations WHERE name = '" . $_POST["name"] . "'");
			echo mysqli_fetch_assoc($results)['id'];
			mysqli_free_result($results);
		?>
			<script>
	
			function printPage(){
				window.print();
			}
	</script>
	</body></div>
</html>