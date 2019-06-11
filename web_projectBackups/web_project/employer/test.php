<!DOCTYPE html>
<html>
<head>
  <title>form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .error{
      color:red;
    }
  </style>
  <script type="text/javascript">
    function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
    </script>
</head>
<body>
<?php
  //Define variable and set empty value
  $nameErr = $errPwd = "";
  $name =  $pwd = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

 
 if (empty($_POST["pwd"])) {
    $errPwd = "Password is required";
  // }if ($pwd < 6){
  // $errpwd= "<br><redtext> Invalid username. Username must be at least 6 characters</redtext>";
  //  }

      }else {
    $pwd = test_input($_POST["pwd"]);
  }
} 

function test_input($data){
  $data=trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>
<div class="container" style="background-color:indigo; color:white;"> 
  <form method="post" action="" class="form-group">
      <span class="error"><?php echo $nameErr;?></span><br>
      <lable>Userid</lable> <input type="text" name="name" class="form control" ><br> 
      <span class=" error"><?php echo $errPwd;?></span><br>
      <lable>Password </lable> <input type="password" name="pwd" class="form control" id="myInput" >
      <br>
      <input type="checkbox" onclick="myFunction()"><br>
         
      <input type="submit" name="login" value="Login" class="btn btn-info">
  </form>


<?php
echo "Welcome nice ";
echo "$name ";
echo "nice to meet you.";
echo "<br> your password is : ";
echo "$pwd";
?> 
</div> 
</body>
</html>