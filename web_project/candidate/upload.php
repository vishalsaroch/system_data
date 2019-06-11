<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../../login2/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
     echo $email;
}
?>
<?php
if($_SERVER['SERVER_NAME']=='localhost')
        {
            $target_dir = "profile/candidateImage/";
        }
        else if($_SERVER['SERVER_NAME']=='cogentsol.in')
        {
            $target_dir = "/home/cogentsol/public_html/profile/candidateImage/";
        }

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$photoName = basename($_FILES["fileToUpload"]["name"]);
echo $photoName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "File had already been uploaded previously once.";
    $uploadOk = 0;
}
// Check file size
//if ($_FILES["fileToUpload"]["size"] > 500000) {
//    echo "Sorry, your file is too large.";
//    $uploadOk = 0;
//}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Your current file is not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.".$_FILES["fileToUpload"]["error"];
    }
}


    if($_SERVER['SERVER_NAME']=='localhost'){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbase2";
      }
      else if($_SERVER['SERVER_NAME']=='cogentsol.in'){
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

            
// $sql = "INSERT INTO `candidate` (`image`) VALUES ('$photoName')";
      $sql = "UPDATE `candidate` SET `image`='".$photoName."'WHERE `userid`='".$_SESSION['email']."';";

 $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Profile Picture Updated Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            

$conn->close();        
?>