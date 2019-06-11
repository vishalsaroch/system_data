
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./footer.css">
  <!-- <link rel="stylesheet" href="./main.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    /*/*.navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    /*footer {
      background-color: #f2f2f2;
      padding: 25px;
    }*/
   /* h3{
      background-color: black;
      color: white;
    }*/
   /* .col-sm-12{
    background: #4CAF50;
    color: white;
    padding: 15px;
    width: 100%;
    height: 400px;
    overflow: scroll;
    border: 1px solid #ccc;
    }*/
    input{
      color:black;
    }*/*/
  </style>
</head>
<body>

<?php include("industory/nav.php"); ?>
<div class="container-fluid">
  <img src="images/header.jpg" style="height:300px; width: 100%; margin-top: 50px; margin-bottom:50px;">
</div>
<!-- <div class="container-fluid" style="background-image: url(images/header.jpg); background-repeat: no-repeat;  width: 100%"> -->



<div class="container">    
  <div class="row">
    <?php
    $data = $_POST["Keyword"]; //*****************TO MAKE A GLOAB SEARCH. DEPENDING UPON STRING OR INTEGER CREATE TWO DIFFERENT SQL QUERIES*****************
    
    $data1=(int)$data;
    
    if($data1==0)
      $sql = "SELECT * FROM job where jobTitle='".$data."' or  jobType='".$data."' or city='".$data."' or year='".$data."' or Industry='".$data."' or Qualification='".$data."'";
    else
      $sql = "SELECT * FROM job where jobTitle='".$data."' or  jobType='".$data."' or city='".$data."' or year='".$data."' or Industry='".$data."' or Qualification='".$data."'";
        $result = $conn->query($sql);
          if ($result->num_rows) {
            echo " <div class='col-sm-12'>";
            while($row = $result->fetch_assoc()) {
              if($row["sno"])
                echo "<div class='row' >
                    <div class='col-md-12' style='background-color:#fff; margin:10px;'>
                      <a href='showjob.php?id=". $row['sno'] ."' title='View Record' data-toggle='tooltip' target='_blank'><h3>" . $row["jobTitle"]. "</h3></a>
                      <p>" . $row["compName"]. "</p>
                      <p><span><img src='images/bag.png' style='height=20px; width:20px; margin:10px;'>" . $row["year"]. " years</span><span><img src='images/location.png' style='height=20px; width:20px; margin:10px;'>" . $row["city"]. "</span></p>
                      <p style='padding=10px;'> Salary : " . $row["month"]. " L.P.A </p>
                      <br>
                      <br>
                      <p style='padding=10px;'>" . $row["Function/Dept"]. "</p> 
                    </div>
                </div>";
                }
        echo "</div>";
          } else {
              echo "<div>No Result found</div>";
          }
           $conn->close();
      ?> 
    </div>    
  </div>
  <footer>
    <?php include("footer.php"); ?>
  </footer>
</body>
</html>
