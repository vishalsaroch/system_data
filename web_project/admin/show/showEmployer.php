<!DOCTYPE html> 
<html>
<head>
  <title>Job Detail</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    .row{
      margin-top: 100px;
    }
    label{
      margin-left:50px;
      text-transform: capitalize; 
    }
  </style>
</head>
<body>
  <?php include("../list/nav.php"); ?>
  <!-- <div class="container-fluid text-center">  -->
  <div class="container">
    <div class="row">
      <?php
      $iddd=$_GET["id"];
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
    ?>
    <?php
      if(isset($_POST['submit'])){
         $Search = 0;
         $Search = $_POST['Search'];
         $job = 0;
         $job = $_POST['job'];
          $showjob = 0;
         $showjob = $_POST['showjob'];
         $exporttoexcel = 0;
         $exporttoexcel = $_POST['exporttoexcel'];
         $candidate = 0;
         $candidate = $_POST['candiadate'];
         
         // $activedate = date("Y/m/d"); 
   
          $sql = "UPDATE `employersusers` SET `search`='".$Search."',`addjob`='".$job."', `showjob`='".$showjob."' , `excel`='".$exporttoexcel."', `candidate`='".$candidate."'where `sno`=".$iddd;
         $run = mysqli_query($conn, $sql);
          if ($run) {
            echo "<p>Service Activate Sucessfully</p>";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }
      ?>
    <?php
      $sql = "SELECT * FROM `employersusers` where `sno`=".$iddd;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {                                  
      while($row = $result->fetch_assoc()) {                                      
        echo "<div class='col-lg-6 '>
         <img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='30%' data-toggle='modal' data-target='#myModal'> <br>
          <h3><b>Company Name : </b> " . $row["compName"]. "</h3>
          <p><b>Company Email ID : </b>" . $row["emailid"]. "</p>
          <p><b>HR Cntact No : </b>  " . $row["contactNo"]. "</p>
          <p> <b>address : </b>" . $row["address"]. "</p>
          <p><b>State : </b>" . $row["state"]. "</p>
          <p><b>Industory : </b>  " . $row["industory"]. "</p>
          <p><b>Product : </b>  " . $row["product"]. "</p>
          <p><b>Statutory : </b>  " . $row["Statutory"]. "</p>
          <a href='../index.php' class='btn btn-info'>Back</a>
        </div> 
        <div class='col-lg-6 '>
         
          <h3><b>Services</b></h3>
          <form action='' method='get'>
            <input type='checkbox' name='Search' value='1' class='check'>
            <label>Advanced Search</label>
            <br>
            <input type='checkbox' name='job' value='1' class='check'>
            <label>Add new job</label>
            <br>
            <input type='checkbox' name='showjob' value='1' class='check'>
            <label>show new job</label>
            <br>
            
            <input type='checkbox' name='exporttoexcel' value='1' class='check'>
            <label> export to excel</label>
            <br>
            
            <input type='checkbox' name='candiadate' value='1' class='check'>
            <label>show candiadate</label>
            <br>
            <input type='submit'  name='submit' value='Activate' class='btn btn-danger' algin='center'>
          </form>
        </div>";
         }
        } 
     $conn->close();

      ?>
  </div>
</div>
</body>
</html>