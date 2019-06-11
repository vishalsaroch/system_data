<?php
  $conn=mysqli_connect("localhost", "root", "", "dbase2");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Qualifaction</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="col-sm-4">
<?php
    if(isset($_POST['submit'])){
       $name = $_POST['name'];
        
 
        $query = "INSERT INTO `spacilization` (name) VALUES ('$name')";
        $run = mysqli_query($conn, $query);
        if($run){
           echo "data insurted sucessfully";
        }else{
            echo "Error".mysqli-error(conn);
        }
    }
 ?>
<form method="post" action="">
	qualifaction<input type="text" name="name">
	<input type="submit" name="submit" value="submit">
</form>
</div>


</div>
</div>
</body>
</html>