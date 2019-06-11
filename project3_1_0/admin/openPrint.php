<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
	{
		$servername = "sun";
		$username = "arjjsngo_root";
		$password = "rootPWD@#";
		$dbname = "arjjsngo_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 


$iddd=$_GET['id'];
$g;
$d;
$m;
$fh;

	
	$sql = "SELECT * from `form` where `id`=".$iddd;
	$result = $conn->query($sql);

						if($result->num_rows>0){
							while($row = $result->fetch_assoc()){
						
						if($row["hgender"]==1)
							$g="male";
						else
							$g="female";
						if($row["fathorhusb"]==1)
							$fh="Father's name";
						else
							$fh="Husband's name";
						if($row["hdisability"]==1)
							$d="yes";
						else
							$d="no";
						if($row["hmarried"]==1)
							$m="married";
						else
							$m="unmarried";
									echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>Aadarsh Rekha Jeevan Jyoti Society (N.G.O)</title>
  
</head>
<body><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center' style='text-align:center;'>
                        <h2 class='tm-gold-text tm-title'>आदर्श रेखा जीवन ज्योति सोसाइटी</h2>
						<h3>Housing For All (urban)</h3>
                    </div><br><br>
        <div class='page-wrapper'>
        
            <!-- MAIN CONTENT-->
            <!--<div class='main-content'>-->
                <div class='section__content section__content--p75'>
                    <div class='container-fluid'>
                        <div class='row'>
                            
                            <div class='col-lg-12'>
                                <div class='card'>
                                    <div class='card-header'>
                                        <strong>Registration Form</strong>
                                    </div><br><br>
                                    <div class='card-body card-block'>
                                        <form id='uploadForm' action='' method='post' enctype='multipart/form-data' class='form-horizontal'>
                                            <span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Applicant name</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly  type='text' id='hname' style='position: absolute; right:60%' name='hname' placeholder='' class='form-control' required value=".$row["hname"].">
                                                    
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label class=' form-control-label'>Gender?</label>
                                                </span>
                                                <span class='col col-md-9'>
                                                    <span class='form-check-inline form-check'>
                                                        <input readonly value=".$g."   type='text' style='position: absolute; right:60%' id='text-input' name='hrent' placeholder='' class='form-control'>
                                                        
                                                    </span>
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Date of Birth</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hage' placeholder='' class='form-control' required value=".$row["hage"].">
                                                    
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>".$fh."</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hfather' placeholder='' class='form-control' required value=".$row["hfather"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Present Address and Contact Details</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly    type='text' style='position: absolute; right:60%' id='text-input readonly ' name='haddress' placeholder='' class='form-control' required value=".$row["haddress"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>House/ Flat / Door no.</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly    type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hdoor' placeholder='' class='form-control' value=".$row["hdoor"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Name of Street</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hstreet' placeholder='' class='form-control' value=".$row["hstreet"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>City (name)</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hcity' placeholder='' class='form-control' value=".$row["hcity"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>State (name)</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hstate' placeholder='' class='form-control' required value=".$row["hstate"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Since How Long Living in Delhi (years)</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hstate' placeholder='' class='form-control' required value=".$row["yearsinD"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Bank Account</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hstate' placeholder='' class='form-control' required value=".$row["bankAcc"].">
                                                    
                                                </span>
                                            </span><br><br>
											
																						
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Mobile number</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='number' style='position: absolute; right:60%' id='hmobile' name='hmobile' placeholder='' class='form-control' required value=".$row["hmobile"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Other ID type</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly  type='text' style='position: absolute; right:60%' id='text-input readonly ' name='hotherid' placeholder='' class='form-control'  value=".$row["hotherid"]." >
                                                    
                                                </span>
                                            </span><br><br>
											
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Aadhar Number</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='text' style='position: absolute; right:60%' id='text-input readonly ' name='haadhar' placeholder='' class='form-control' required  value=".$row["haadhar"].">
                                                    
                                                </span>
                                            </span><br><br>
											
											<table>
													<tr>
														<td>S.no.</td><td>Name</td><td>Relation</td><td>Gender</td><td>age</td><td>Aadhar Number</td><td>Other ID type</td><td>Other ID number</td>
													</tr>
											
												<tr>
													<td><input readonly  type='text' id='text-input readonly ' value='1' name='' class='form-control' style='width: 45px;'  ></td><td><input readonly  type='text' id='text-input readonly ' name='name1' class='form-control' value=".$row["name1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='relation1' class='form-control' value=".$row["relation1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='gender1' class='form-control' value=".$row["gender1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='age1' class='form-control' value=".$row["age1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='aadhar1' class='form-control' value=".$row["aadhar1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otherid1' class='form-control' value=".$row["otherid1"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otheridno1' class='form-control' value=".$row["otheridno1"]."></td>
												</tr>
												<tr>
													<td><input readonly  type='text' id='text-input readonly ' value='2' name='' class='form-control' style='width: 45px;'  ></td><td><input readonly  type='text' id='text-input readonly ' name='name2' class='form-control' value=".$row["name2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='relation2' class='form-control' value=".$row["relation2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='gender2' class='form-control' value=".$row["gender2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='age2' class='form-control' value=".$row["age2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='aadhar2' class='form-control' value=".$row["aadhar2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otherid2' class='form-control' value=".$row["otherid2"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otheridno2' class='form-control' value=".$row["otheridno2"]."></td>
												</tr>
												<tr>
													<td><input readonly  type='text' id='text-input readonly ' value='3' name='' class='form-control' style='width: 45px;'  ></td><td><input readonly  type='text' id='text-input readonly ' name='name3' class='form-control' value=".$row["name3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='relation3' class='form-control' value=".$row["relation3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='gender3' class='form-control' value=".$row["gender3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='age3' class='form-control' value=".$row["age3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='aadhar3' class='form-control' value=".$row["aadhar3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otherid3' class='form-control' value=".$row["otherid3"]."></td><td><input readonly  type='text' id='text-input readonly ' name='otheridno3' class='form-control' value=".$row["otheridno3"]."></td>
												</tr>
												<tr>
													<td><input readonly  type='text' id='text-input readonly ' value='4' name='' class='form-control' style='width: 45px;'  ></td><td><input readonly  type='text' id='text-input readonly ' name='name4' class='form-control' value=".$row["name4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='relation4' class='form-control' value=".$row["relation4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='gender4' class='form-control' value=".$row["gender4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='age4' class='form-control' value=".$row["age4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='aadhar4' class='form-control' value=".$row["aadhar4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='otherid4' class='form-control' value=".$row["otherid4"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='otheridno4' class='form-control' value=".$row["otheridno4"]." ></td>
												</tr>
												<tr>
													<td><input readonly  type='text' id='text-input readonly ' value='5' name='' class='form-control' style='width: 45px;'  ></td><td><input readonly  type='text' id='text-input readonly ' name='name5' class='form-control' value=".$row["name5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='relation5' class='form-control' value=".$row["relation5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='gender5' class='form-control' value=".$row["gender5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='age5' class='form-control' value=".$row["age5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='aadhar5' class='form-control' value=".$row["aadhar5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='otherid5' class='form-control' value=".$row["otherid5"]." ></td><td><input readonly  type='text' id='text-input readonly ' name='otheridno5' class='form-control' value=".$row["otheridno5"]." ></td>
												</tr>
											</table>	<br><br>
											<!--<button type='button' class='btn btn-primary btn-sm' onclick='addRow();'>+ Add row</button>-->
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label class=' form-control-label'>Whether Person with Disability?</label>
                                                </span>
                                                <span class='col col-md-9'>
                                                    <span class='form-check-inline form-check'>
                                                        <input readonly  value=".$d."  type='text' style='position: absolute; right:60%' id='text-input' name='hrent' placeholder='' class='form-control'>
                                                        
                                                    </span>
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label class=' form-control-label'>Married?</label>
                                                </span>
                                                <span class='col col-md-9'>
                                                    <span class='form-check-inline form-check'>
                                                        <input readonly  value=".$m."  type='text' style='position: absolute; right:60%' id='text-input' name='hrent' placeholder='' class='form-control'>
                                                        
                                                    </span>
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Present Rent(INR)</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='number' style='position: absolute; right:60%' id='text-input readonly ' name='hrent' placeholder='' class='form-control'  value=".$row["hrent"].">
                                                    
                                                </span>
                                            </span><br><br>
											<span class='row form-group'>
                                                <span class='col col-md-3'>
                                                    <label for='text-input readonly ' class=' form-control-label'>Monthly Income(INR)</label>
                                                </span>
                                                <span class='col-12 col-md-9'>
                                                    <input readonly   type='number' style='position: absolute; right:60%' id='text-input readonly ' name='hincome' placeholder='' class='form-control' required  value=".$row["hincome"].">
                                                    
                                                </span>
                                            </span><br><br>
																					
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>";
									
							}
							
						} else {
							echo "0 results";
						}
						 						
						$conn->close();
?>
</body>
</html>