<?php
if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shop";
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

		
?>
<!DOCTYPE html>
<html>
<head>
	<title> Show Shop</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		td{
  			width: 200px;
  			text-align: center;
  		}
  		input{
  			margin: 10px;
  		}
  		textarea{
  			margin:10px;
  		}
  	</style>
</head>
<body>
<?php
	if(isset($_POST['order'])){
		   $name = $_POST['name'];
		   $email = $_POST['email'];
		   $contact = $_POST['contact'];
		   $address = $_POST['address'];
		   // $services  = $_POST['services'];
		   // $gender = $_POST['gender'];
		   // $email = $_POST['email'];
		   // $mobileno = $_POST['mobileno'];
		   // $date = date("Y/m/d"); 
		$sql = "INSERT INTO `order` (`name`, `email`, `contact`, `address`) VALUES ('$name', '$email', '$conatct', '$address')";

    // $sql = "UPDATE `student` SET `address`='".$address."',`state`='".$state."', `industory`='".$industry."' , `product`='".$product."', `Statutory`='".$Statutory."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
   $run = mysqli_query($conn, $sql);
    if ($run) {
      echo "<p>Order Plased Successfully</p>";
      } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Show Services</h1>
			<?php
                $sql = "SELECT * FROM shop";
                // $sql = "SELECT * FROM shop WHERE candidate.emailid = '".$_SESSION['email']."';";
                  
              $result = $conn->query($sql);
              
            if ($result->num_rows > 0) {
              
              while($row = $result->fetch_assoc()) {
                  echo "<table class='table-bordered'>
                  	<tr>
                        <td>       ". $row["shopname"]."</td>
                        <td>       ". $row["ownername"]."</td>
                        <td>        " . $row["location"]."</td>
                        <td>        " . $row["services"]."</td>
                        <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Book a services</button></td>
                        </tr>
                        </table> " ;
					}
          } else {	
              echo "No services found";
          }
          // $conn->close();
          ?>
		</div>
	</div>
</div>
<div class="container">
  

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Book Order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form action="" method="post">
         	<input type="text" name="name" placeholder="Name" class="form-control">
         	<input type="email" name="email" placeholder="Email" class="form-control">
         	<input type="number" name="contact" placeholder="Mobile Number" class="form-control">
         	<?php
                $sql = "SELECT * FROM shop";
                // $sql = "SELECT * FROM shop WHERE candidate.emailid = '".$_SESSION['email']."';";
                  
              $result = $conn->query($sql);
              
            if ($result->num_rows > 0) {
              
              while($row = $result->fetch_assoc()) {
                  echo ". $row["shopname"]." ;
					}
          } else {	
              echo "No services found";
          }
          // $conn->close();
          ?>
         	<input type="text" name="ownername" placeholder="Mobile Number" class="form-control">
         	<textarea class="form-control" name="address"> Address</textarea>
         	<input type="submit" name="order" value="Book Your Order" class="btn-btn-info">
         </form>
        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
  
</div>
</body>
</html>