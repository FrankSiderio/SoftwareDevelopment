<html>
<head>
	<style type="text/css">
		body{
			background-color: 17C8F0;
		}
		#top
		{
			text-align: center;
			font-family: "Times New Roman";
			width: 500px;
		    padding: 25px;
		    border: 25px solid navy;
		    margin: auto;
		}
	</style>
</head>
<?php
	require'sql.php';
	$cwid = $_POST['cwid'];
	$name = $_POST['name'];
	$dorm = $_POST['dorm'];
	$laundry = isset($_POST["laundry"]);
	$kitchen = isset($_POST["kitchen"]);
	if ($_POST['class'] == "freshman") {
		$year = 1;
	} elseif ($_POST['class'] == "sophomore") {
		$year = 2;
	} else {
		$year = 3;
	}
	
	if ($dorm != 'none') {
		$result = query("SELECT * FROM $table WHERE name = '$dorm'");
		$dormInfo = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		
		$err = false;
		if ($dormInfo['year'] != $year) {
			$err = true;
		} elseif ($laundry == true && $dormInfo['laundry'] == false) {
			$err = true;
		} elseif ($kitchen == true && $dormInfo['kitchen'] == false) {
			$err = true;
		}
		
		if ($err) {
			echo '<b>You\'re preferences don\'t meet the requirements of ', $dorm, '.</b> <br> <br> <a href="index.php">Return to form</a> <br>';
		} else {
			echo '<div id="top"><b>', $dorm, ' matches your preferences, click  confirm below to continue</b><br><br>';
			echo "Student's Name: $name";
			echo '<br>';
			echo "Student's perfered Dorm: $dorm";
			echo '<br>';
			echo "Student's cwid: $cwid";
			echo '<form action="results.php" method="post">';
			foreach($_POST as $key=>$value) {
				echo '<input type="hidden" name="', $key, '" value="', $value, '"> ';
			}
			echo '<input type="submit" value="Confirm">';
			echo '</form></div>';
			
		}
	} else {
		if ($kitchen) {
			$result = query("SELECT * FROM $table WHERE year = $year AND kitchen = 1");
		} else {
			$result = query("SELECT * FROM $table WHERE year = $year");
		}
		echo '<div id="top"><form action="results.php" method="post">';
		echo '<b>Please select one of the following Residence Halls:</b><br>';
		foreach($_POST as $key=>$value) {
			echo '<input type="hidden" name="', $key, '" value="', $value, '"> ';
		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<input type="radio" name="dorm" value="'. $row['name'] . '"> ' . $row['name'] . '<br>';
		}
		mysqli_free_result($result);
		echo '<input type="submit" value="Continue">';
		echo '</form></div>';
	}
?>
</html>
