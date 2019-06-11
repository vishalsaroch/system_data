<!DOCTYPE html>
<html>
<head>
	<title>show</title>
	<link rel="icon" href="images/ashwani.png" type="image/png">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>
	 <div class="container-fluid">
	 <img src="images/ashwani.png"> 
	 <h1 align="center" style="background-color: #e6ffff">Show all data</h1>
		<?php
			if($_SERVER['SERVER_NAME']=='localhost')
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dbase2";
		}
		else if($_SERVER['SERVER_NAME']=='cogentsol.in')
		{
			$servername = "sun";
			$username = "cogentso_root";
			$password = "rootPWD@#";
			$dbname = "cogentso_dbase2";
		}
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 


			

				$sql = "SELECT * FROM qualifaction";

				$result1 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<table class='table table-bordered'><tr><th>Qualification</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				        
				//     }
				//      echo "</tr>";
				// }

				$sql = "SELECT * FROM cource";

				$result2 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<tr><th>Cources/Program</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				//     }

				// }

				$sql = "SELECT * FROM specialization";

				$result3 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<tr><th>Specialization</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				//     }
				// }

				$sql = "SELECT * FROM industry";

				$result4 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<tr><th>Industery</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				//     }

				// }

				$sql = "SELECT * FROM department";

				$result5 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<tr><th>Department</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				//     }

				// }

				$sql = "SELECT * FROM state";

				$result6 = $conn->query($sql);
				
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     echo "<tr><th>state</th>";
				//     while($row = $result->fetch_assoc()) {
				//         echo "<td>" . $row["name"], "</td>";
				//     }

				// }

				$sql = "SELECT * FROM location";

				$result7 = $conn->query($sql);
				$row1 = $result1->fetch_assoc();
				$row2 = $result2->fetch_assoc();
				$row3 = $result3->fetch_assoc();
				$row4 = $result4->fetch_assoc();
				$row5 = $result5->fetch_assoc();
				$row6 = $result6->fetch_assoc();
				$row7 = $result7->fetch_assoc();

				
				if ($result1->num_rows > 0) {
				    // output data of each row
				    echo "<table class='table'><tr><th>Qualifaction</th><th>Courses/Programs</th><th>Specialization</th><th>Industry</th><th>Department</th><th>State</th><th>Location</th></tr>";
				    while($row1 = $result1->fetch_assoc()) {
				        echo "<tr><td>". $row1["name"]."</td><td>". $row2["name"]."</td><td>". $row3["name"]."</td><td>". $row4["name"]."</td><td>". $row5["name"]."</td><td>". $row6["name"]."</td><td>". $row7["name"]."</td></tr>";
				    }
				    echo "</table>";

				}
				
		$conn->close();
		?>
			<a href="adddata.php" class="btn btn-success" style="margin-bottom: 20px;">Add New Data</a>
		</div>
	</body>
</html>
