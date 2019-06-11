<?php
if($_SERVER['SERVER_NAME']=='localhost'){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbase2";
      }
      else if($_SERVER['SERVER_NAME']=='cogentsol.in'){
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>History</title>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    input{
      margin:10px;
    }

  </style>
   <script>
  var eduid;
  function myfunction122(element){
    // alert(element.innerHTML);
    document.getElementById("popupQualification").value=element.childNodes[3].innerHTML;
    document.getElementById("popupCourse").value=element.childNodes[5].innerHTML;
    document.getElementById("popupSpec").value=element.childNodes[7].innerHTML;
    document.getElementById("popupBoard").value=element.childNodes[9].innerHTML;
    document.getElementById("popupYear").value=element.childNodes[11].innerHTML;
    document.getElementById("popupLocation").value=element.childNodes[13].innerHTML;
    document.getElementById("popupMarks").value=element.childNodes[15].innerHTML;
  }
  function seeMoreData1(element){
    var eduid=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/candidate/profile/deleteeducation.php?id="+eduid.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
  function deleteData1(element)
  {
    document.getElementById("card333").style.display="inline";
    eduid=element.childNodes[1].innerHTML;
   // console.log(eduid);
  }
  function deleteIt1(){
    document.getElementById("card333").style.display="none";
                          var urlkey;

                    if(location.hostname=='localhost')
                    {
                        urlkey = "/web_project/candidate/profile/deleteeducation.php";
                    }
                    else if(location.hostname=='cogentsol.in')
                    {
                        urlkey = "deleteeducation.php";
                    }
                    var data12 = "userid="+eduid;
                    // alert(data12);
                    
                   
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

<div class="container">
<div class="row"><h3 align ='center' style='background-color: #d1e2ff;'>Educacton and Qualifications </h3>
  <?php
          if(isset($_POST['Eduadd'])){
            $qualifaction = $_POST["qualifaction"];
            $cource=$_POST['cource'];
            $specialization=$_POST['specialization'];
            $board=$_POST['board'];
            $year=$_POST['year'];
            $Location=$_POST['location'];
            $marks=$_POST['marks'];
            $userid=$_POST['userid'];
            $date=date("Y/m/d");

            //$sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            // $sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."',`Specialization`='".$specialization."',`BoardUniversity`='".$board."',`Year`='".$year."',`Location`='".$Location."',`marks`='".$marks."',`date`='".$date."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            $sql = "INSERT INTO `educational` (`Qualification`, `Course`, `Specialization`, `BoardUniversity`, `Year`, `Location`, `marks`, `userid`, `date`) VALUES ('$qualifaction', '$cource', '$specialization','$board', '$year', ',$Location', '$marks', '$userid', '$date')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Qualifaction Added Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }          
    ?>

     <?php
          if(isset($_POST['Eduupdate'])){
            $qualifaction = $_POST["qualifaction"];
            $cource=$_POST['cource'];
            $specialization=$_POST['specialization'];
            $board=$_POST['board'];
            $year=$_POST['year'];
            $Location=$_POST['location'];
            $marks=$_POST['marks'];
            $userid=$_POST['userid'];
            $date=date("Y/m/d");

            //$sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            $sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."',`Specialization`='".$specialization."',`BoardUniversity`='".$board."',`Year`='".$year."',`Location`='".$Location."',`marks`='".$marks."',`date`='".$date."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            //$sql = "INSERT INTO `educational` (`Qualification`, `Course`, `Specialization`, `BoardUniversity`, `Year`, `Location`, `marks`, `userid`, `date`) VALUES ('$qualifaction', '$cource', '$specialization','$board', '$year', ',$Location', '$marks', '$userid', '$date')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Qualifaction Updated Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }          
    ?>
   
  <div class="container" id="show">
    
         <?php
      // $sql = "SELECT educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM educational INNER JOIN candidate ON educational.sno = candidate.sno where candidate.emailid = '".$_SESSION['email']."';";
      $sql = "SELECT educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM educational INNER JOIN candidate ON educational.userid = candidate.userid where candidate.emailid = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               echo "<table class='table table-hover'>
                       <tr align='center'>
                       <th>Qualification</th>
                        <th>Course/Program</th>
                        <th>Specialization</th>
                        <th>Board/University</th>
                        <th>Year of Passing</th>
                        <th>Location</th>
                        <th>% of Marks Obtained</th>
                        <th></th>
                        <th></th>
                      </tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td style='display:none'> " . $row["sno"]. "</td>
                          <td> " . $row["Qualification"]. "</td>
                          <td> " . $row["Course"]. "</td>
                          <td> " . $row["Specialization"]. "</td>
                          <td> " . $row["BoardUniversity"]. "</td>
                          <td> " . $row["Year"]. "</td>
                          <td> " . $row["Location"]. "</td>
                          <td> " . $row["marks"]. "</td>
                          <td> <button type='button' class='btn btn-info btn-lg'  data-toggle='modal' data-target='#myEducationedit' onclick='myfunction122(this.parentNode.parentNode)'><span class='glyphicon glyphicon-edit'></span></button></td>
                          <td onclick='deleteData1(this.parentNode);' >
                            <span id='delete' class='glyphicon glyphicon-trash alert alert-danger' aria-hidden='true'></span>
                          </td>
                      </tr>";
                  }
          } else {
              echo "</table>";
                }
        
          ?>
</table>
</div>
  <!-- Add popup -->
  <div class="row">
            
            <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myEducationadd" align="right" style="margin-left:50px; margin-top: 20px;">Add</button>

          <!-- Add Modal -->
          <div class="modal fade" id="myEducationadd" role="dialog">
            <div class="modal-dialog">
          <!-- Modal content-->

              <div class="modal-content" >
                <div class="modal-header" style="color: white; background-color: silver; text-align: center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Qualification</h4>
                </div>
                <div class="modal-body">
                    <form action="" method ="post">
                  
                  <?php
                    $sql="select * from qualifaction";
                    $result = $conn->query($sql);
                  ?>
              
                  <input list="qualifactions" name="qualifaction" placeholder="Qualifactions">
                  <datalist id="qualifactions" name="qualifaction">
                  <!-- <select name="qualification" id="qualification"> -->
                    <option value="">Select qualification</option>
                    <?php
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                      }
                    ?>
                  </datalist>

                  <?php
                    $sql="select * from cource";
                    $result = $conn->query($sql);
                  ?>
              
                  <input list="cource" name="cource" placeholder="Course">
                  <datalist id="cource">
                  <!-- <select name="qualification" id="qualification"> -->
                    <option value="">Course</option>
                    <?php
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                      }
                    ?>
                  </datalist>
                 
                         
                          <?php
                            $sql="select * from specialization";
                            $result = $conn->query($sql);
                          ?>
                            <input list="specializations" name="specialization" placeholder="Specialization">
                              <datalist id="specializations">
                                <option value="">Select Specializations</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist>
                              
                            <input list="board" name="board" placeholder="Name of Board/University">
                            <input type="text" name="year" placeholder="Year of Passing">
                             <input type="hidden" name="userid" value="<?php echo "$email"?>">
                        <?php
                            $sql="select * from location";
                            $result = $conn->query($sql);
                          ?>
                        <input type="text" name="location" placeholder="Location">
                         <datalist id="location">
                              <option value="">Select Location</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist>
                        <input type="text" name="marks" placeholder="% of Marks Obtained">
                        <input type="submit" name="Eduadd" value="Add" class="btn btn-info">
                      </form>    
                </div>
              </div>   
            </div>
          </div>
        </div>
      </div>
      <!-- popup edit -->
      <div class="row">
            
            <!-- Trigger the modal with a button -->
         <!--  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myEducationadd" align="right" style="margin-left:50px; margin-top: 20px;">Add</button> -->

          <!-- Add Modal -->
          <div class="modal fade" id="myEducationedit" role="dialog">
            <div class="modal-dialog">
          <!-- Modal content-->

              <div class="modal-content" >
                <div class="modal-header" style="color: white; background-color: silver; text-align: center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Qualification</h4>
                </div>
                <div class="modal-body">
                    <form action="" method ="post">
                  
                  <?php
                    $sql="select * from qualifaction";
                    $result = $conn->query($sql);
                  ?>
              
                  <input list="qualifactions" id="popupQualification" name="qualifaction" placeholder="Qualifactions">
                  <datalist id="qualifactions" name="qualifaction">
                  <!-- <select name="qualification" id="qualification"> -->
                    <option value="">Select qualification</option>
                    <?php
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                      }
                    ?>
                  </datalist>

                  <?php
                    $sql="select * from cource";
                    $result = $conn->query($sql);
                  ?>
              
                  <input list="cource" id="popupCourse" name="cource" placeholder="Course">
                  <datalist id="cource">
                  <!-- <select name="qualification" id="qualification"> -->
                    <option value="">Course</option>
                    <?php
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                        }
                      }
                    ?>
                  </datalist>
                 
                         
                          <?php
                            $sql="select * from specialization";
                            $result = $conn->query($sql);
                          ?>
                            <input list="specializations" id="popupSpec" name="specialization" placeholder="Specialization">
                              <datalist id="specializations">
                                <option value="">Select Specializations</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist>
                              
                            <input list="board" id="popupBoard" name="board" placeholder="Name of Board/University">
                            <input type="text" id="popupYear" name="year" placeholder="Year of Passing">
                             <input type="hidden" name="userid" value="<?php echo "$email"?>">
                        <?php
                            $sql="select * from location";
                            $result = $conn->query($sql);
                          ?>
                        <input type="text" id="popupLocation" name="location" placeholder="Location">
                         <datalist id="location">
                              <option value="">Select Location</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                  $conn->close(); 
                                ?>
                              </datalist>
                        <input type="text" id="popupMarks" name="marks" placeholder="% of Marks Obtained">
                        <input type="submit" name="Eduedit" value="Update" class="btn btn-info">
                      </form>    
                </div>
              </div>   
            </div>
          </div>
        </div>
      </div>
<div class="model" id="card333" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 1px solid black; display:none; background-color: white;">
        <div class="model-body" align="center" style="margin-top: 20px;">
        <b style="margin-top: 50px;">Do you want to Delete this Data?</b><br> <br>
        <button type="button" onclick="deleteIt1();" class="btn btn-primary">Yes</button>
        <button type="button" onclick="dontDeleteIt1();"  class="btn btn-success">No</button>
      </div>
    </div>
</body>
</html>
