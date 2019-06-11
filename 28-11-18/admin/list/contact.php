<!DOCTYPE html>
<html>
<head>
	<title>contact</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">    
  <div class="row" style="background-color: #f2f2f2">
    <?php
    // echo "Recently  updated job";
      $sql = "SELECT * FROM contact order by srno desc";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            echo " <div class='col-sm-12'>
            <h3 class='text-center'>Recently  Added Inquery</h3>
            <table class='table' ><tr style='background-color:black; color:white;'> <th>Inquery Id</th><th>Name</th><th>Emailid</th><th>Contact No</th><th><form action='searchpage.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </th></tr>";
            while($row = $result->fetch_assoc()) {
              if($row["srno"]<10)
                echo "<tr> <td>0000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> <td onclick='seeMoreData(this.parentNode);'><a> View</span></a></td> <td><button class='btn btn-danger'>Delete</button></td></tr>";
              else if($row["srno"]<100)
                  echo "<tr> <td>000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]."</td> <td onclick='seeMoreData(this.parentNode);'><a>View</a></td><td><button class='btn btn-danger'>Delete</button></td></tr>";
              else
                  echo "<tr> <td>00" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> <td onclick='seeMoreData(this.parentNode);'><a>View</a></td> <td><button class='btn btn-danger'>Delete</button></td></tr>";
              }
        echo "</table></div>";
          } else {
              echo "<div>No Result found</div>";
          }
           $conn->close();
      ?> 
  </div>
</div>
</body>
</html>
