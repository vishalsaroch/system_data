<!DOCTYPE html>
<html>
<head>
  <title>Detail</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  function seeMoreData(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/employer/post.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
</script>
</head>
<body>
<?php include("nav.php"); ?>
<div class="container">
      <div class="col-sm-12"  > 
        <h3 align ="center" style="margin-top: 10px; margin-bottom: 50px;">List of my jobs </h3>
        <div class="col-lg-12">
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

              $sql = "SELECT * FROM job";

              $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              echo "<table class='table ' ><tr style='background-color:black; color:white;'> <th>JobID</th> <th>job Title</th> <th>Job Type</th> </tr>";
              while($row = $result->fetch_assoc()) {
                if($row["sno"]<10)
                  echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              else
                  echo "<tr> <td>00" . $row["sno"]. "</td> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td>" . $row["mobileno"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>See More...</a></td></tr>";
              }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>
      </div>  
    </div>
  </div>

</body>
</html>