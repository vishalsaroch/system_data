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
	<title>Employer</title>
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
  <!-- <script type="text/javascript">
     function seeMoreData(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showEmployer.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
  </script>

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
   // console.log(empId1);
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
                    //alert(data12);
                    
                   
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
                    
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(".btn").click(function(){
        $("#card333").hide();
    });
  });
</script> -->

<!-- show cloase and delete Employer -->
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
   // console.log(empId1);
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
            echo "<div class='col-sm-12'><h3 class='text-center'>Recently Added Employer</h3><table class='table'><tr style='background-color:black; color:white;'> <th>Employer ID</th> <th>Company Name</th> <th>Company Email ID</th> <th>Contact No</th> <th><form action='../search/searchEmployer.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search'></form> </th> </tr>";
            while($row = $result1->fetch_assoc()) {
              if($row["sno"]<10)
                echo "<tr> <td>0000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td>
             
                      <td align = 'center' onclick='seeMoreData1(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
              else if($row["sno"]<100)
                  echo "<tr> <td>000" . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["contactNo"]. "</td>
                <td align = 'center' onclick='seeMoreData1(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
              else
                  echo "<tr><td> " . $row["sno"]. "</td> <td> " . $row["compName"]. "</td> <td> " . $row["emaillid"]. "</td> <td> " . $row["contactNo"]. "</td>
               <td align = 'center' onclick='seeMoreData1(this.parentNode);'>
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
      </div>   
    </div>
</div>
<div class="model" id="card333" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 1px solid black; display:none; background-color: white;">
  <div class="model-body" align="center" style="margin-top: 20px;">
    <b style="margin-top: 50px;">Do you want to Delete this Data?</b><br> <br>
    <button type="button" onclick="deleteIt1();" class="btn btn-primary">Yes</button>
    <button type="button" onclick="dontDeleteIt1();"  class="btn btn-success">No</button>
  </div>
</body>
</html>
