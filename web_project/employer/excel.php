<?php
	$data = $_POST["data"];
	// $exerience = $_POST["exerience"];
 //    $salary = $_POST["salary"];
	$data1=(int)$data;
	// $exerience1=(int)$exerience;
 //    $salary1=(int)$salary;
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
	$output ="";
	if($data1==0 || $exerience1==0 || $salary1==0)
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
    else
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$exerience."' or months='".$exerience."' or sno='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
		// if($data1==0)
  //     $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
  //   else
  //     $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$data."' or months='".$data."' or sno='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
		$result=mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$output .='<table class="table" border="1">
						<tr>
							<th>Name</th><th>JOB Title</th><th>Qualifaction</th><th>Experience</th><th>Emailid</th><th>Phone No</th>
						</tr>';
		while ($row=mysqli_fetch_array($result)) {
			$output .="
						<tr>
							<td>".$row["fname"]." ".$row["lname"]."</td><td>".$row["jobtitle"]."</td><td>".$row["qualification"]."</td><td>".$row["years"]." ".$row["months"]."</td><td>".$row["emailid"]."</td><td>".$row["mobileno"]."</td>
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