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
	<title>contact</title>
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
    . col-sm-12{
      margin-top: 200px;
    }
    .col-sm-12{
      margin-top: 70px;
    }
  </style>

  <script>
  var empId1;
  function seeMoreData4(element){
    var empId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showInquery.php?id="+empId.toString());
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

$(document).ready(function(){
  $(".btn").click(function(){
    $("#card333").hide();
  });
});
</script>
</head>
<body>

<?php include("nav.php"); ?>
<div class="container">    
  <div class="row" >
    <?php
    // echo "Recently  updated job";

       $total_pages_sql = "SELECT COUNT(*) FROM contact";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        // $sql = "SELECT * FROM contact ORDER BY sno DESC LIMIT $offset, $no_of_records_per_page";
       $sql = "SELECT * FROM contact order by srno desc";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            echo " <div class='col-sm-12'>
            <h3 class='text-center'>Recently Added Inquery</h3>
            <table class='table' ><tr style='background-color:black; color:white;'> <th>Inquery Id</th><th>Name</th><th>Emailid</th><th>Contact No</th><th><form action='searchpage.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search' style='color:black'></form> </th></tr>";
            while($row = $result->fetch_assoc()) {
              if($row["srno"]<10)
                echo "<tr> <td>0000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> 
               <td align = 'center' onclick='seeMoreData4(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td> 
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
              else if($row["srno"]<100)
                  echo "<tr> <td>000" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]."</td> 
               <td align = 'center' onclick='seeMoreData4(this.parentNode);'>
                        <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                      </td>
                      <td onclick='deleteData1(this.parentNode);'>
                        <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                      </td>
                   </tr>";
              else
                  echo "<tr> <td>00" . $row["srno"]. "</td> <td> " . $row["name"]. "</td> <td> " . $row["email"]. "</td> <td> " . $row["phoneno"]. "</td> 
               <td>
                <table class='table'>
                  <tr>
                    <td onclick='seeMoreData4(this.parentNode);'>
                      <span  id='view' class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                    </td><td></td>
                    <td  onclick='deleteData1(this.parentNode);'>
                      <span id='delete' class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                    </td>
                  </tr>
                </table>
              </td> 
            </tr>";
              }
        echo "</table></div>";
          } else {
              echo "<div>No Result found</div>";
          }
           $conn->close();
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
</body>
</html>
