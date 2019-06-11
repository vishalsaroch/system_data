
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    h3{
      background-color: black;
      color: white;
    }
    .col-sm-12{
    /*background: #4CAF50;*/
    /*color: white;*/
    padding: 15px;
    width: 100%;
    height: 400px;
    overflow: scroll;
    border: 1px solid #ccc;
    }
    input{
      color:black;
    }
  </style> -->
  <style type="text/css"> 
  h1{
      color: white;
      background-color: black;
      width:300px;
      opacity: 0.5;
      margin-left: 300px;
    }
    
    button{
      color: white;
      background-color: orange;
      width:170px;
      opacity: 0.5;
      margin-left: 385px;
    }
    tr:hover{
      background-color: #CFF3FB;
    }
   
    body{
      background-color: #ffff99
    }
    th{background-color: black; color: white;}
</style>
<script>
  function seeMoreData(element){
    var candidateId=element.childNodes[1].innerHTML;
    alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/employer/showCandidate.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("showCandidate.php?id="+candidateId.toString());
      }
  }
</script>
</head>
<body>

<?php include("nav.php"); ?>
<div class="container-fluid">
  <img src="images/header.jpg"  class="img-responsive" style="height: 30vw; margin-top: 50px; margin-bottom:50px;">
</div>
<!-- <div class="container-fluid" style="background-image: url(images/header.jpg); background-repeat: no-repeat;  width: 100%"> -->



<div class="container">    
  <div class="row">
    <?php
    $data = $_POST["data"];
    $exerience = $_POST["exerience"];
    $salary = $_POST["salary"];
     //*****************TO MAKE A GLOAB SEARCH. DEPENDING UPON STRING OR INTEGER CREATE TWO DIFFERENT SQL QUERIES*****************
    
    $data1=(int)$data;
    $exerience1=(int)$exerience;
    $salary1=(int)$salary;
    if($data1==0 || $exerience1 || $exerience1)
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or ExpectedSalary='".$salary."' or PreferredLocation='".$data."'";
    else
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$exerience."' or months='".$exerience."' or sno='".$data."' or ExpectedSalary='".$salary."' or PreferredLocation='".$data."'";
    $result1=mysqli_query($conn, $sql);
        //$result1 = $conn->query($sql);
          if (mysqli_num_rows($result1) > 1) {
            echo "<table class='table'><tr> <th>Photo</th> <th>Name</th><th>Qualification</th><th>Job Title</th> <th>Experience</th><th><form action='excel.php' method='POST'><input type='text' name='data' value='".$data."' style='display:none;'><input type='submit' name='submit' class='btn btn-success' value='Export TO Excel'></form> </th></tr>";
            while($row = $result1->fetch_assoc()) {
              echo "<tr style='text-transform: capitalize;'><td> <img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100'/></td> <td style='display:none'>" . $row["userid"]. "</td><td>" . $row["fname"]." " . $row["lname"]. "</td><td> " . $row["qualification"]. "</td> <td> " . $row["jobtitle"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td><a  href='showCandidate.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip' target='blank'><span class='glyphicon glyphicon-eye-open' style='color:blue; font-size:30px; margin-left:50px;'></span></td></tr>";
                  }
        echo "</table></div>";
          } else {
               echo "<div>No result found</div>";
          }
           $conn->close();
          ?>
    </div>    
  </div>
</body>
</html>
