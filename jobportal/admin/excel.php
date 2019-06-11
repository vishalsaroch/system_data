<?php
  include("db.php");
 ?>
<?php
	// $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$exerience."' or months='".$exerience."' or sno='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
$sql = "SELECT * FROM ((candidate INNER JOIN educational ON educational.userid = candidate.userid) INNER JOIN employmenthistory ON educational.userid = employmenthistory.userid) ";
	//$sql = "SELECT * FROM candidate LEFT JOIN comments ON comments.city=citys.city WHERE citys.id=$id";

// $sql = "SELECT candidate.fname, candidate.lname, candidate.jobtitle, candidate.years, candidate.months, candidate.emailid, candidate.mobileno, candidate.CurrentLocation, employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role, educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM ((candidate INNER JOIN educational ON educational.userid = candidate.userid) INNER JOIN employmenthistory ON educational.userid = employmenthistory.userid) ";

		// if($data1==0)
  //     $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
  //   else
  //     $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$data."' or months='".$data."' or sno='".$data."' or ExpectedSalary='".$data."' or PreferredLocation='".$data."'";
		$result=mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$output = "";
			$output .='<table class="table" border="1">
						<tr>
							<th>Candidate ID</th><th>Name</th><th>JOB Title</th><th>Qualifaction</th><th>Experience</th><th>Emailid</th><th>Phone No</th><th>DOB</th><th>Gender</th><th>MaritalStatus</th><th>CurrentDesignation</th><th>Nationality</th><th>Language</th><th>Preferred Location</th><th>Notice Period</th><th>Expected Salary</th><th>Company Name</th><th>Industry</th><th> 	Function</th><th>Position</th><th>EmployementPeriod</th><th>Location</th><th>Reason</th><th>role</th>
						</tr>';
		while ($row=mysqli_fetch_array($result)) {
			$output .="
						<tr>
							<td>".$row["fname"]." ".$row["lname"]."</td><td>".$row["jobtitle"]."</td> <td>".$row["qualification"]."</td><td>".$row["years"]." ".$row["months"]."</td><td>".$row["emailid"]."</td><td>".$row["mobileno"]."</td><td>".$row["DOB"]."</td><td>".$row["Gender"]."</td><td>".$row["MaritalStatus"]."</td><td>".$row["CurrentDesignation"]."</td><td>".$row["Nationality"]."</td><td>".$row["LanguageKnown"]."</td><td>".$row["PreferredLocation"]."</td><td>".$row["NoticePeriod"]."</td><td>".$row["ExpectedSalary"]."</td><td>".$row["CompanyName"]."</td><td>".$row["Industry"]."</td><td>".$row["Function"]."</td><td>".$row["Position"]."</td><td>".$row["EmployementPeriod"]."</td><td>".$row["Location"]."</td><td>".$row["Reason"]."</td><td>".$row["role"]."</td>
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