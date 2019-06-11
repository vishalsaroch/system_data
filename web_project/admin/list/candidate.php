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
<html>
<head>
	<title>candidate</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
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
                      alert(data12);
                      
                     
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
<?php include("nav.php"); ?>
<div class="container">    
  <div class="row">
 
 <!--  <a href="index.php?delete= <?php echo id;?>" onclick=" return confirm('are you soure?')">Delete</a>   --> 
    <?php
    $total_pages_sql = "SELECT COUNT(*) FROM candidate";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM candidate ORDER BY sno DESC LIMIT $offset, $no_of_records_per_page";
      
        $result1 = $conn->query($sql);
          if ($result1->num_rows > 1) {
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently  Added Candidate</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Candidate ID</th> <th>Name</th> <th>EmailId</th> <th>Mobile No</th> <th>Required Experince</th><th><form action='../search/searchCandidate.php' method='POST' style='margin-top: 13px;''>
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
               echo "<div>No result found</div>";
          }
           // $conn->close();
          ?>
    <div class="col-md-12" align="center" style="height: 70px; background-color: gray">
      <ul class="pagination" id="page">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
    </div>
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
