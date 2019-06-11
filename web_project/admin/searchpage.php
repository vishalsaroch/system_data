
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
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
  </style>
</head>
<body>

<?php include("nav.php"); ?>
<div class="container-fluid">
  <img src="images/management-banner.jpg" style="height:300px; width: 100%; margin-top: 50px; margin-bottom:50px;">
</div>

<!-- <div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h3 class="text-center">Result</h3>
      <?php
          //  if(isset($_POST['search'])){
          // // $name = $_POST['data'];
          // $query = "SELECT * FROM `job` WHERE jobTitle LIKE '%$_GET[data]%'";
          // while ($row = mysql_fetch_array($query)) {
          //   echo  $row['mobileno']."";
          // }
      ?>
    </div>
  </div>
</div> -->

<div class="container">    
  <div class="row">
    <?php
    $data = $_POST["data"]; //*****************TO MAKE A GLOAB SEARCH. DEPENDING UPON STRING OR INTEGER CREATE TWO DIFFERENT SQL QUERIES*****************
    
    $data1=(int)$data;
    //echo gettype($data);
    //echo gettype($data1);
    //echo $data1;
    // echo "Resently updated job";
    if($data1==0)
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."'";
    else
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$data."' or months='".$data."' or sno='".$data."'";
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Result Candidate</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Candidate ID</th> <th>First Name</th> <th>Last Name</th> <th>EmailId</th> <th>Mobile No</th><th>Required Experince</th><th><input type='text' name='search' placeholder='Search..' align='right'  ></th> </tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              else
                  echo "<tr><td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              }
        echo "</table></div>";
          } else {
               echo "<div>No result found</div>";
          }
           // $conn->close();
          ?>
    </div>    
  </div>

 <!--  <div class="container">    
  <div class="row" style="background-color: #f2f2f2">
    <?php
    // echo "Resently updated job";
      // $sql = "SELECT * FROM job";
      //   $result = $conn->query($sql);
      //     if ($result->num_rows > 0) {
      //       echo " <div class='col-sm-12'>
      //       <h3 class='text-center'>Resently Added Job</h3>
      //       <table class='table' ><tr style='background-color:black; color:white;'><th>JobID</th><th>job Title</th><th>Job Type</th><th>Emailid</th><th>Contact No</th> <th>Required Experince</th><th><input type='text' name='search' placeholder='Search..' align='right'></th></tr>";
      //       while($row = $result->fetch_assoc()) {
      //         if($row["sno"]<10)
      //           echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["year"]. "." . $row["month"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>Show</a></td></tr>";
      //         else if($row["sno"]<100)
      //             echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td> " . $row["email"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["year"]. "." . $row["month"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>Show</a></td></tr>";
      //         else
      //             echo "<tr> <td>00" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td>" . $row["mobileno"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>Show</a></td></tr>";
      //         }
      //   echo "</table></div>";
      //     } else {
      //         echo "<div>No Result found</div>";
      //     }
      //      $conn->close();
      ?> 
  </div>
</div> -->








</body>
</html>
