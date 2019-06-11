<?php
  include("db.php");
 ?>
<?php
	$sql = "SELECT * FROM employersusers";
	$result=mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$output = "";
			$output .='<table class="table" border="1">
						<tr>
							<th>Company Id</th><th>Company Name</th><th>HR Name</th><th>HR Emailid</th><th>HR Contact No</th><th>Date of Registration</th><th>Address</th><th>State</th><th>Industory</th><th>product</th><th>Statutory</th><th>Role</th>
						</tr>';
		while ($row=mysqli_fetch_array($result)) {
			$output .="
						<tr>
							<td>".$row["sno"]."</td><td>".$row["compName"]."</td><td>".$row["username"]."</td><td>".$row["emailid"]."</td><td>".$row["contactNo"]."</td><td>".$row["date"]."</td><td>".$row["address"]."</td><td>".$row["state"]."</td><td>".$row["industory"]."</td><td>".$row["product"]."</td><td>".$row["Statutory"]."</td><td>".$row["role"]."</td>
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