<?php
  include("db.php");
 ?>
<?php
	$sql = "SELECT * FROM Job";
	$result=mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$output = "";
			$output .='<table class="table" border="1">
						<tr>
							<th>Job Id</th><th>Job Title</th><th>Job Type</th> <th>Company Name</th> <th>HR ID</th><th>Location</th><th>Experience</th><th>Job Discription</th><th>Job Posted Date</th>
						</tr>';
		while ($row=mysqli_fetch_array($result)) {
			$output .="
						<tr>
							<td>".$row["sno"]."</td><td>".$row["jobTitle"]."</td><td>".$row["jobType"]."</td><td>".$row["compName"]."</td><td>".$row["userid"]."</td><td>".$row["location"]."</td><td>".$row["experince"]."</td><td>".$row["description"]."</td><td>".$row["date"]."</td>
						</tr>";
						
		}
					$output .='</table>';
					// header("connect-Type: application/xls");
					// header("connect-Disposition: attachment; filename=download.xls");
					header("Content-type: application/octet-stream");
					header("Content-Disposition: attachment; filename=Candidate_Detail.xls");
					header("Pragma: no-cache");
					header("Expires: 0");
					echo $output;
					// echo ucwords($putput)."\n".$setData."\n";	

		}
	
?>