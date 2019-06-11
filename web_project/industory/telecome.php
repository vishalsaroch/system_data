<!DOCTYPE html> 
<html>
<head>
  <title>Job Detail</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="main.css">
  <style type="text/css">
    span{
      line-height: 1;
    }
  </style>
  
</head>
<body style="background-color:#e6fff2">
<?php 
// include("nav.php"); 
?>
<div class="container-fluid text-center">    
  <div class="row">
    <div class="col-md-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
<div class="col-md-8 text-left"> 
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
          $conn = new mysqli($servername, $username, $password, $dbname);
           
          
        ?>
       <script>
            var candidateId;                  
          function seeMoreData3(element){
            var candidateId=element.childNodes[1].innerHTML;
            // alert(candidateId);
            if(location.hostname=='localhost')
              {
                window.open("/web_project/showjob.php?id="+candidateId.toString());
              }
              else if(location.hostname=='cogentsol.in')
              {
                window.open("post.php?id="+candidateId.toString());
              }
          }
        </script>
    <?php
      

        $sql = "SELECT * FROM job WHERE `Industry`='IT Software, Software Services' order by sno desc";
      // $sql = "SELECT * FROM job order by sno desc";
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
    <div class="col-md-2 sidenav">
      </div>
    </div>
  </div>
</div>

</body>
</html>