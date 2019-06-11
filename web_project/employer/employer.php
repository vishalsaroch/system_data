<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../login/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create job</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  // function seeMoreData(element){
  //   var candidateId=element.childNodes[1].innerHTML;
  //   //alert(candidateId);
  //   if(location.hostname=='localhost')
  //     {
  //       window.open("/web_project/employer/post.php?id="+jobid.toString());
  //     }
  //     else if(location.hostname=='cogentsol.in')
  //     {
  //       window.open("post.php?id="+candidateId.toString());
  //     }
  //   }

  //   function myfunction123(element){
  //   // alert(element.innerHTML);
  //   document.getElementById("address").value=element.childNodes[3].innerHTML;
  //   document.getElementById("State").value=element.childNodes[5].innerHTML;
  //   document.getElementById("Industry").value=element.childNodes[7].innerHTML;
  //   document.getElementById("product").value=element.childNodes[9].innerHTML;
  //   document.getElementById("Statutory").value=element.childNodes[11].innerHTML;
  //   document.getElementById("popupLocation").value=element.childNodes[13].innerHTML;
  //   document.getElementById("popupMarks").value=element.childNodes[15].innerHTML;
  // }
  </script>
</head>
<body style="background-color: #ffff99">

<?php 
     
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
     
     ?>
    
     <?php
     
     // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location: ../login/index.php");
   exit();
     }
     
     ?>
     <?php include("nav.php"); ?>
  
    <div class="container">
        <div class="row">
        	<div class="col-md-12 centered ">
            	<h3 align= "center">Company Detail</h3>
            </div>
        </div>
    </div>
    <div class="container">
         <div class="row">
            <div class="col-md-4 register-left">
                <img src="images/building.png" height="400px" width="350px" style=" position: static;" />
                   <!--  <h3>Welcome</h3>
                        <p>I am Frisher</p> -->
                </div>
                <div class="col-md-8 ">
                	<h3 align="center" style="color: white; background-color: black">Office Detail</h3>
                    <div class="row register-form">
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
                           
                                if(isset($_POST['submit'])){
                                   $address = $_POST['address'];
                                   $state = $_POST['State'];
                                   $industry = $_POST['industry'];
                                   $product = $_POST['product'];
                                   $Statutory = $_POST['Statutory'];
                                   $userid = $_POST['userid'];
                                   $date = date("Y/m/d"); 
                             
                                    $sql = "UPDATE `employersusers` SET `address`='".$address."',`state`='".$state."', `industory`='".$industry."' , `product`='".$product."', `Statutory`='".$Statutory."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
                                   $run = mysqli_query($conn, $sql);
                                    if ($run) {
                                      echo "<p>Company detail Updated Successfully</p>";
                                      } else {
                                      echo "Error: " . $sql . "<br>" . $conn->error;
                                      }
                                    }
                                


                            ?>
                            <?php
              //                $sql = "SELECT * from employer where employer.userid = '".$_SESSION['email']."';";
              // $result = $conn->query($sql);

              // if ($result->num_rows > 0) {
              //     output data of each row
              //     while($row = $result->fetch_assoc()) {
              //         echo "<strong style='text-transform: uppercase;'> " . $row["address"]. " " . $row["state"]. "</strong><br>
                     
              //         <p> " . $row["industory"]. "</p>
              //         <p> " . $row["product"]. "</p>";

              //     }
              // } else {
              //     echo "0 results";
              // }
            ?> 
                            
                        <form  method="post" action="" id="job">
                            <div class="form-froup">
                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Address</label>
                                    <input type="hidden" name="userid" value="<?php echo "$email"?>">
                                    <input type="text" name="address"  class="form-control" placeholder="Address*"  required />
                                </div>
								
								<div class="col-md-6" style="margin-top: 10px;">
                                    <label>State</label>
                                    
                                    <?php
                                      $sql="select * from state";
                                      $result = $conn->query($sql);
                                    ?>
                                       
                                    <input list="State" name="State"  class="form-control" placeholder="State *"  required/>
                                      <datalist id="State" name="State">
                                        <option value="" style="width:100%">Select State</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                    </datalist>
                                </div>

                              
                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Industry</label>
                                    <!-- <input type="text" name="industry" class="form-control" placeholder="Industry *"  required/> -->
                                    <?php
                                      $sql="select * from industry";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="industry" name="industry"  class="form-control" placeholder="Industry *"  required/>
                                      <datalist id="industry" name="industry" >
                                        <option value="" style="width:100%">Select Industry</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                      </datalist>
                                </div>

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Product</label>
                                    <input type="text" name="product"   class="form-control" placeholder="Product *"  required/>
                                </div>

                                

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Statutory</label>
                                    <input type="text" name="Statutory"  class="form-control" placeholder="Statutory*"  required/>
                                </div>
                            
                                <div class="col-md-12" style="margin-top: 10px;">
                                	<h3 align="center" style="color: white; background-color: black">Owner Detail</h3>	
                                	<div class="col-md-6"style="margin-top: 10px;">
                                	 	
        	                                <label>Email</label>
        	                                <input type="text" name="email" class="form-control" placeholder="Email *"  />
        	                            </div>
                                   
                                    <div class="col-md-6"style="margin-top: 10px;">
                                    	<label>Mobile No</label>
        	                                <input type="number" name="mobileno" class="form-control" placeholder="Mobile No *"  />
        	                        </div>

        	                           <!--  <div class="col-md-12" style="margin-top: 20px; margin-left: 650px;">
        	                                	<a href="dashbord.html"  ><button type="button" class="btn btn-info">Signup</button></a>
        	                             </div> -->
                                         <input type="submit" name="submit" value="update" align="right" style=" margin: 20px" class="btn btn-info" onclick="myfunction123(this.parentNode.parentNode)">
    	                           </div>
                                </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </span>
                        <footer style="background-color:black; height: 100px; margin-top: 20px;" ></footer>
                       
</body>
</html>