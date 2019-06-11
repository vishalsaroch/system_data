<!DOCTYPE html>
<html>
<head>
	<title>candidate</title>
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
        window.open("/web_project/admin/show/showCandidate.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
</script>
</head>
<body>
<div class="container">    
  <div class="row">
 
  <a href="index.php?delete= <?php echo id;?>" onclick=" return confirm('are you soure?')">Delete</a>
    <?php
    // echo "Recently  updated job";
    // $id=$$row["sno"]
      $sql = "SELECT * FROM candidate order by sno desc";
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently  Added Candidate</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Candidate ID</th> <th>First Name</th> <th>Last Name</th> <th>EmailId</th> <th>Mobile No</th><th>Required Experince</th><th><form action='searchpage.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>View</a></td> <td><button class='btn btn-danger'>Delete</button></td><td></td</tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>View</a></td> <td><button class='btn btn-danger'>Delete</button></td></tr>";
              else
                  echo "<tr><td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td onclick='seeMoreData(this.parentNode);'><a>View</a></td><td><button class='btn btn-danger'>Delete</button></td></tr>";
              }
        echo "</table></div>";
          } else {
               echo "<div>No result found</div>";
          }
           // $conn->close();
          ?>
    </div>    
  </div>
</body>
</html>
