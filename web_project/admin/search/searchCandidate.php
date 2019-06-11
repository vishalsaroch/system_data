
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

    if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
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
    form{
      color:black;
    }
    .common{
      width:50px;
    }
    td{
      text-align: center;
    }

    th{
      text-align: center;
    }

    .glyphicon {
      font-size: 20px;
    }

    #view{
      color: blue;
    }

    #delete{
      color: red;
    }
    .col-sm-12{margin-top: 50px;}

    #no_result{
      background-color: #ffcccc;
      
      font-size: 36px;
      height: 300px;
      width: 400px;
      margin-top: 100px;
      margin-left: 400px; 
    }
   a{
    margin-left: 120px;
   }
   h1{
    color: #334d4d;
    margin-left: 70px;
    margin-top: -10px;
    font-family: "Times New Roman", Times, serif;
   }

   img{
    margin-left: 40px;
   }

  </style>
  <script>
  var canid1;
  function seeMoreData2(element){
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

  function deleteData1(element)
    {
      document.getElementById("card444").style.display="inline";
      canid1=element.childNodes[1].innerHTML;
     // console.log(canid1);
    }
    function deleteIt1(){
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
                      // alert(data123);
                      
                     
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
</head>
<body>


<div class="container-fluid">
 <!--  <img src="images/management-banner.jpg" style="height:300px; width: 100%; margin-top: 50px; margin-bottom:50px;"> -->
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
     $total_pages_sql = "SELECT COUNT(*) FROM candidate";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
    if($data1==0)
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."'";
    else
      $sql = "SELECT * FROM candidate where fname='".$data."' or lname='".$data."' or emailid='".$data."' or mobileno='".$data."' or qualification='".$data."' or jobtitle='".$data."' or years='".$data."' or months='".$data."' or sno='".$data."'";
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Search Candidate</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Candidate ID</th> <th>Name</th> <th>EmailId</th> <th>Mobile No</th> <th>Required Experince</th><th><form action='../search/searchCandidate.php' method='POST' style='margin-top: 13px;''>
              <input type='text' name='data'>
              <input type='submit' name='submit' value='Search'>
          </form></tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["fname"]. " " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td>
             <td align = 'center' onclick='seeMoreData2(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";

              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["fname"]. " " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td>

               <td align = 'center' onclick='seeMoreData2(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
            
              else
                  echo "<tr><td> " . $row["fname"]. "</td> <td> " . $row["lname"]. " " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td>

              <td align = 'center' onclick='seeMoreData2(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
              }
        echo "</table></div>";
          } else {
               echo "<div id='no_result'>
                <img src='no-resultfound copy.png' align='center'>
               <h1>No Result Found</h1>
               <a href='../list/candidate.php' class='btn btn-info centered'>BACK TO SEARCH </a>
               </div>";
          
          }
           // $conn->close();
          ?>
    
  </div>    
  </div>

  <div class="model" id="card444" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 1px solid black; display:none; background-color: white;">
  <!-- <div class="model-header">
  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
    <!--<button type="button" class="btn btn-danger" onclick="closeit333();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
 </div> -->
 <div class="model-body" align="center" style="margin-top: 20px;">
   <!--<button type="button" onclick="sendMAIL333();" class="btn btn-secondary">Send Email</button>-->
   <b style="margin-top: 50px;">Do you want to Delete this Data?</b><br> <br>
    <button type="button" onclick="deleteIt1();" class="btn btn-primary">Yes</button>
    <button type="button" onclick="dontDeleteIt1();"  class="btn btn-success">No</button>
  </div>
</body>
</html>
