
<!DOCTYPE html>
<html>
<head>
	<title>Add Qualifaction</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    p{
      background-color: green;
    }
  </style>
</head>
<body>


<div class="container">
<!-- Add Qualifaction -->

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
          $name = $_POST['name'];
          $query = "INSERT INTO `qualifaction` (name) VALUES ('$name')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Qualifaction insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }

      if(isset($_POST['csubmit'])){
         $cname = $_POST['cname'];
          $query = "INSERT INTO `cource` (name) VALUES ('$cname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Cources/Program insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }

      if(isset($_POST['ssubmit'])){
         $sname = $_POST['sname'];
          $query = "INSERT INTO `specialization` (name) VALUES ('$sname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Spacilization insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }

      if(isset($_POST['isubmit'])){
          $iname = $_POST['iname'];
          $query = "INSERT INTO `industry` (name) VALUES ('$iname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Industry insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }
      if(isset($_POST['dsubmit'])){
          $dname = $_POST['dname'];
          $query = "INSERT INTO `department` (name) VALUES ('$dname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Department insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }
      if(isset($_POST['stsubmit'])){
          $stname = $_POST['stname'];
          $query = "INSERT INTO `state` (name) VALUES ('$stname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>State insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }
      if(isset($_POST['lsubmit'])){
          $lname = $_POST['lname'];
          $query = "INSERT INTO `location` (name) VALUES ('$lname')";
          $run = mysqli_query($conn, $query);
          if($run){
             echo "<p>Loction insurted sucessfully</p>";
          }else{
              echo "Error".mysqli-error(conn);
          }
      }     
   ?>
   <table class="table table-bordered" >
   <tr><h1 align="center">Add Data</h1> </tr>
   <tr>
        <form method="post" action="">
        	<td><b>Qualifaction</b></td>
          <td><input type="text" name="name"></td>
        	<td><input type="submit" name="submit" value="submit"></td>
        </form>
    </tr>
    <tr>
      <form method="post" action="">
        <td><b>Cources/Program</b></td>
        <td><input type="text" name="cname"></td>
        <td><input type="submit" name="csubmit" value="submit"></td>    
      </form>
      </tr>
      <tr>
      <form method="post" action="">
        <td><b>Specilization</b></td>
        <td><input type="text" name="sname"></td>
        <td><input type="submit" name="ssubmit" value="submit"></td>    
      </form>
    </tr>
    <tr>
      <form method="post" action="">
        <td><b>Industry</b></td>
        <td><input type="text" name="iname"></td>
        <td><input type="submit" name="isubmit" value="submit"></td>    
      </form>
      </tr>
      <tr>
      <form method="post" action="">
        <td><b>Department</b></td>
        <td><input type="text" name="dname"></td>
        <td><input type="submit" name="dsubmit" value="submit"></td>    
      </form>
      </tr>
      <tr>
      <form method="post" action="">
        <td><b>State</b></td>
        <td><input type="text" name="stname"></td>
        <td><input type="submit" name="stsubmit" value="submit"></td>    
      </form>
      <tr>
      <form method="post" action="">
        <td><b>location</b></td>
        <td><input type="text" name="lname"></td>
        <td><input type="submit" name="lsubmit" value="submit"></td>    
      </form>

    </tr>
    </table>
</div>

<!-- Add cources -->


</div>
</body>
</html>