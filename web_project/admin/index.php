<?php
/* Displays user information and some useful messages */
session_start();
// the session variable
if ( $_SESSION['logged_in'] != 1) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../adminlogin/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
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

    if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

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
    /*background: #4CAF50;
    color: white;*/
    padding: 15px;
    width: 100%;
    height: 400px;
    overflow: scroll;
    border: 1px solid #ccc;
  }
  .container{
    margin-bottom: 20px;
  }    
  input{
      color: #ff0000;
    }
    #view{
      color: blue;
     font-size: 25px;
    }

    #delete{
      color: red;
     font-size: 25px;
    }
  </style>
</head>
<body>
 <?php 
     
     // // Display message about account verification link only once
       if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
     //     // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
     
     ?>
     
     
     <?php
     
   //   // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location:../adminlogin/index.php");
   exit();
     }
     
     ?> 
  
  <?php include("nav.php"); ?>

 <!--  start employer -->

  <div class="container-fluid">
    <img src="images/management-banner.jpg" style="height:300px; width: 100%; margin-top: 50px; margin-bottom:50px;">
    </div>
  <div class="container">    
  <div class="row">
 <!-- show cloase and delete candidate -->
  <script>
  var empId1;
  function seeMoreData1(element){
    var empId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showEmployer.php?id="+empId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
  function deleteData1(element)
  {
    document.getElementById("card333").style.display="inline";
    empId1=element.childNodes[1].innerHTML;
   console.log(empId1);
  }
  function deleteIt1(){
    document.getElementById("card333").style.display="none";
                          var urlkey;

                    if(location.hostname=='localhost')
                    {
                        urlkey = "/web_project/admin/deleteEmployer.php";
                    }
                    else if(location.hostname=='cogentsol.in')
                    {
                        urlkey = "deleteEmployer.php";
                    }
                    var data12 = "userid="+empId1;
                    alert(data12);
                    
                   
                                $.ajax({
                                url: urlkey,
                                method: "POST",
                                data: data12,
                                success: function(result){alert(result);
                                          location.reload(); 
                                },
                                failure: function(err){alert(err);}
                             });
                          
                            }

$(document).ready(function(){
  $(".btn").click(function(){
    $("#card333").hide();
  });
});
</script>


<div class="model" id="card333" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 1px solid black; display:none; background-color: white;">
 <div class="model-body" align="center" style="margin-top: 20px;">
   <b style="margin-top: 50px;">Do you want to Delete this Data?</b><br> <br>
    <button type="button" onclick="deleteIt1();" class="btn btn-primary">Yes</button>
    <button type="button" onclick="dontDeleteIt1();"  class="btn btn-success">No</button>
  </div>
</div>
  
    <?php
       $total_pages_sql = "SELECT COUNT(*) FROM employersusers";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM employersusers ORDER BY sno DESC LIMIT $offset, $no_of_records_per_page";
    
      // $sql = "SELECT * FROM employersusers order by sno desc";
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently Added Employer</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Employer ID</th> <th>Company</th> <th>HR ID</th> <th>Contact No</th> <th><form action='search/searchEmployer.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search'></form> </th><th></th> </tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td>
              <td align = 'center' onclick='seeMoreData1(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData1(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td><td align = 'center' onclick='seeMoreData1(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData1(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else
                  echo "<tr><td> " . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emaillid"]. "</td> <td> " . $row["contactNo"]. "</td><td align = 'center' onclick='seeMoreData1(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData1(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
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
  
    <!-- candidate start -->

  <div class="container">    
  <div class="row">
  <script>
  var canid1;
  function seeMoreData2(element){
    var candidateId=element.childNodes[1].innerHTML;
    alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showCandidate.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("showCandidate.php?id="+candidateId.toString());
      }
  }

  function deleteData2(element)
    {
      document.getElementById("card444").style.display="inline";
      canid1=element.childNodes[1].innerHTML;
     // console.log(canid1);
    }
    function deleteIt2(){
      document.getElementById("card444").style.display="none";
                            var urlkey;

                      if(location.hostname=='localhost')
                      {
                          urlkey = "/web_project/admin/delete/Candidate.php";
                      }
                      else if(location.hostname=='cogentsol.in')
                      {
                          urlkey = "delete/Candidate.php";
                      }
                      var data123 = "userid="+canid1;
                      alert(data123);
                      $.ajax({
                                  url: urlkey,
                                  method: "POST",
                                  data: data123,
                                  success: function(result){alert(result);
                                            location.reload(); 
                                  },
                                  failure: function(err){alert(err);}
                     });
                            
                  }
                      
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#btn").click(function(){
          $("#card444").hide();
      });
  });
</script>
 
<div class="model" id="card444" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 1px solid black; display:none; background-color: white;">
    <div class="model-header">
    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      <button type="button" class="btn btn-danger" onclick="closeit444();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
    </div>
    <div class="model-body" align="center" style="margin-top: 20px;">
      <!--<button type="button" onclick="sendMAIL333();" class="btn btn-secondary">Send Email</button>-->
      <b style="margin-top: 50px;">Do you want to Delete this Data?</b><br> <br> 
      <button type="button" onclick="deleteIt2();" class="btn btn-primary">Yes</button>
      <button type="button" id="btn" onclick="dontDeleteIt2();"  class="btn btn-success">No</button>
    </div>
  </div>

 <!--  employer end -->


<!-- candidate data  -->

    <?php
    $total_pages_sql = "SELECT COUNT(*) FROM candidate";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM candidate ORDER BY sno DESC LIMIT $offset, $no_of_records_per_page";
      
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently  Added Candidate</h3><table class='table'><tr style='background-color:black; color:white;'><th>Name</th><th>EmailId</th> <th>Mobile No</th><th>Qualifaction</th><th>Job Title</th> <th>Experince</th><th><form action='searchjob.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form></th><th></th></tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<td> " . $row["fname"]. " " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td><td> " . $row["qualification"]. "</td><td> " . $row["jobtitle"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td align='center' onclick='seeMoreData2(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData2(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td> </tr>";
              else if($row["sno"]<100)
                  echo "<td> " . $row["fname"]. " " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td><td> " . $row["qualification"]. "</td><td> " . $row["jobtitle"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td align='center' onclick='seeMoreData2(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData2(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else
                  echo "<tr><td> " . $row["fname"]. "" . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td><td> " . $row["qualification"]. "</td><td> " . $row["jobtitle"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td align='center' onclick='seeMoreData2(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> </td> <td onclick='deleteData2(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              }
        echo "</table></div>";
          } else {
               echo "<div>No result found</div>";
          }
           // $conn->close();
          ?>
  </div>    
  </div>

  <?php
   // include("list/job.php");
   ?>
  <div class="container">  
  <div class="row" >
  <script>
  function seeMoreData3(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showjob.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
  function deleteIt2(){
      document.getElementById("card444").style.display="none";
                            var urlkey;

                      if(location.hostname=='localhost')
                      {
                          urlkey = "/web_project/admin/delete/Candidate.php";
                      }
                      else if(location.hostname=='cogentsol.in')
                      {
                          urlkey = "delete/Candidate.php";
                      }
                      var data123 = "userid="+canid1;
                      alert(data123);
                      
                     
                                  $.ajax({
                                  url: urlkey,
                                  method: "POST",
                                  data: data123,
                                  success: function(result){alert(result);
                                            location.reload(); 
                                  },
                                  failure: function(err){alert(err);}
                     });
                            
                  }
                      
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#btn").click(function(){
          $("#card444").hide();
      });
  });
  </script>
    <?php
      $total_pages_sql = "SELECT COUNT(*) FROM job";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM job ORDER BY sno DESC LIMIT $offset, $no_of_records_per_page";
      // $sql = "SELECT * FROM job order by sno desc";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            echo " <div class='col-sm-12'>
            <h3 class='text-center'>Recently  Added Job</h3>
            <table class='table' ><tr style='background-color:black; color:white;'><th>job Title</th><th>Department</th><th>Company</th><th><form action='search/searchjob.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </th></tr>";
            while($row = $result->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td> <td> " . $row["compName"]. "</td><td align='center' onclick='seeMoreData3(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></td><td onclick='deleteData3(this.parentNode);'><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else if($row["sno"]<100)
                  echo "<tr><td> " . $row["jobTitle"]. "</td> <td> " . $row["jobType"]. "</td><td> " . $row["compName"]. "</td><td align='center' onclick='seeMoreData3(this.parentNode);'> <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></td><td><span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else
                  echo "<tr><td> " . $row["jobTitle"]. "</td> <td> " . $row["compName"]. "</td><td align='center' onclick='seeMoreData3(this.parentNode);'> <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> &nbsp; &nbsp; &nbsp;<span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              }
        echo "</table></div>";
          } else {
              echo "<div>No Result found</div>";
          }
           // $conn->close();
      ?> 

  </div>
  </div>

  <div class="container">    
  <div class="row">
  <script>
  function seeMoreData4(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showInquery.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
</script>
    <?php
    // echo "Recently  updated job";

       $total_pages_sql = "SELECT COUNT(*) FROM contact";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM contact LIMIT $offset, $no_of_records_per_page";
      // $sql = "SELECT * FROM contact order by srno desc";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            echo " <div class='col-sm-12'>
            <h3 class='text-center'>Recently  Added Inquery</h3>
            <table class='table' ><tr style='background-color:black; color:white;'> <th>Inquery Id</th><th>Name</th><th>Emailid</th><th>Contact No</th><th><form action='searchpage.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </th></tr>";
            while($row = $result->fetch_assoc()) {
              if($row["srno"]<10)
                echo "<tr> <td>0000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> <td align = 'center' onclick='seeMoreData4(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> &nbsp; &nbsp; &nbsp; &nbsp; <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else if($row["srno"]<100)
                  echo "<tr> <td>000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]."</td> <td align = 'center' onclick='seeMoreData4(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> &nbsp; &nbsp; &nbsp; &nbsp; <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              else
                  echo "<tr> <td>00" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> <td align = 'center' onclick='seeMoreData4(this.parentNode);'><span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> &nbsp; &nbsp; &nbsp; &nbsp; <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
              }
        echo "</table></div>";
          } else {
              echo "<div>No Result found</div>";
          }
           $conn->close();
      ?> 
       
  </div>
</body>
</html>
