<?php 
	require_once 'sql.php';
	
	$result = query("SELECT name, vacancy FROM $table");
?>
<html>
<head>
	<style type="text/css">
		body{
			background-color: 17C8F0;
		}
		h1{
			text-align: center;
			font-family: "Times New Roman";
		}
		h2
		{
			text-align: center;
			font-family: "Times New Roman";
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
	<body>
		<h1>Marist Room Reservation Recorder</h1>
		<div id="top">
		<form action="verify.php" method="post">
			<h2>Student Info</h2>
			Student's Name: <input type="text" name="name"> <br>
			Student's CWID: <input type="number" name="cwid"> <br>
			Gender : <input type="radio" name="sex" value="male" checked="true"> Male <input type="radio" name="sex" value="female"> Female <br>
			Class: <select name="class">
				<option value="freshman"> Freshman</option>
				<option value="sophomore"> Sophomore</option>
				<option value="junior"> Junior</option>
				<option value="senior"> Senior</option>
			</select>
			<br>
			
			<h2>Student Preferences</h2>
			<input type="checkbox" name="laundry"> Laundry on Premise 
			<input type="checkbox" name="kitchen"> Fully Equipped Kitchen <br>
			Special Needs: <input type="text" name="specialNeeds"> <br>
			Residence Hall:	<select name="dorm">
				<option value="none"> No Preference </option>
				<?php 
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<option value="' . $row['name'] . '" ';
						if ($row['vacancy'] <=0) {
							echo 'disabled="true"';
						}
						echo '> ' . $row['name'] . ' (' . $row['vacancy'] . ')</option>';
					}
				?>
			</select>
			<br>
			<br>
			<input type="submit">
			</div>
	</body>
</html>