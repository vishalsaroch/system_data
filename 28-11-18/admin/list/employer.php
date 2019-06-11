<!DOCTYPE html>
<html>
<head>
	<title>Employer</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>




<div class="container">    
  <div class="row">

    <?php
    
      $sql = "SELECT * FROM employersusers order by sno desc";
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently  Added Employer</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Employer ID</th> <th>Company Name</th> <th>Company Email ID</th> <th>Contact No</th><th></th> <th><form action='searchpage.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </th> </tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>View</a></td><td><button class='btn btn-danger'>Delete</button></td></tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td><td align='center' onclick='seeMoreData(this.parentNode);'><a>View</a></td><td><button class='btn btn-danger'>Delete</button></td></tr>";
              else
                  echo "<tr><td> " . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emaillid"]. "</td> <td> " . $row["contactNo"]. "</td><td align='center' onclick='seeMoreData(this.parentNode);'><a>View</a></td><td><button class='btn btn-danger'>Delete</button></td></tr>";
              }
        echo "</table></div>";
          } else {
               echo "<div>No result found</div>";
          }
           // $conn->close();
          ?>
    </div>    
  </div>
</div>
</body>
</html>
