<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";

  header("location:login2/index.php");  
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
         header("location:login2/index.php");
   exit();
     }
?>
<?php
      if($_SERVER['SERVER_NAME']=='localhost'){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
      }
      else if($_SERVER['SERVER_NAME']=='truelook.in')
      {
        $servername = "sun";
        $username = "truelook_root";
        $password = "truelook@12#123";
        $dbname = "truelook_truedb";
      }
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
  ?>
  <?php
    $product= $_POST['pname'];
    $price = $_POST['price'];
    $dis = $_POST['dis'];
    $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
    // $sql = "INSERT INTO `userserviseupdate` (`pname`, `price`, `dis` , `image`, `userid`) VALUES ('$product', '$price', '$dis', '$images','$email')";
    $sql = "SELECT * from `userserviseupdate` WHERE pname = '".$product."' ";   
     $result1 = $conn->query($sql);
      if ($result1->num_rows > 0) {
        echo "Services is alredy Activated.";
      } else {
      $sql = "INSERT INTO `userserviseupdate` (`pname`, `price`, `dis`, `userid`) VALUES ('$product', '$price', '$dis','$email') ";
         // $sql = "INSERT INTO `userserviseupdate` (`pname`, `price`, `dis` , `image`, `userid`) VALUES ('$product', '$price', '$dis', '$images','$email')";
      $run = mysqli_query($conn, $sql);
      if($run){
           echo "Service Activate Successfully";
        }else{
            echo "Error: " . $query. "<br>" . $conn->error;
        }
    $conn->close(); 
  }
  ?>
      