<!DOCTYPE html>
<html>
<head>
	<title>qualification</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      input{
        margin-left: 80px;
        margin-top: 10px;

      }
    </style>
</head>
<body>
<div class="container">
  <div class="row">
     <h3 align ='center' style='background-color: #d1e2ff;'>Educational & Professional Qualification</h3>
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
          if(isset($_POST['submitEdu'])){
            $qualifaction = $_POST["qualifaction"];
            $cource=$_POST['cource'];
            $specialization=$_POST['specialization'];
            $board=$_POST['board'];
            $year=$_POST['year'];
            // $location=$_POST['location'];
            // $marks=$_POST['marks'];
            // $clocation=$_POST['clocation'];
            // $address=$_POST['address'];
            // $relign=$_POST['relign'];
            // $nationality = $_POST["nationality"];
            // // $language=$_POST['language'];
            // $plocation=$_POST['plocation'];
            // $notice=$_POST['notice'];
            // $salary=$_POST['salary'];
            // $query = "INSERT INTO `basicinformation` (FatherName) VALUES ('$fname')", ;
            $sql = "INSERT INTO `educational` (`Qualification`, `Course`, `Specialization`, `BoardUniversity`, `Year`) VALUES ('$qualifaction', '$cource', '$specialization','$board','$year')";

            $run = mysqli_query($conn, $sql);
            // if($run){
            //    echo "<p>fathername updated sucessfully</p>";
            // }else{
            //     echo "Error".mysqli-error(conn);
            // }

            if ($conn->query($sql) === TRUE) {
              echo "value added to database";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }          
        ?>
        <table class="table table-hover">
          <tr>
            <th>Qualification Level</th>
            <th>Course/Program</th>
            <th>Specialization</th>
            <th>Name of Board/University</th>
            <th>Year of Passing</th>
            <th>Location</th>
            <th>% of Marks Obtained</th>
          </tr>
          
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
        // $sql = "SELECT * FROM employmenthistory ";

        // $result = $conn->query($sql);
        
        // if ($result->num_rows > 1) {
        //     // output data of each row
        //     echo "<table class='table table-bordered'>";
        //     while($row = $result->fetch_assoc()) {
        //         echo "<td>" . $row["CompanyName"]. "</td>";
                
        //     }
        //      echo "</tr></table>";
        // }
      // $sql = "SELECT * FROM educational";
        $sql = "SELECT * FROM educational WHERE sno='1'";
              $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='col-lg-12'>
                              <table class='table'>
                                <tr>
                                  <td> " . $row["Qualification"]. "</td>
                                  <td> " . $row["Course"]. "</td>
                                  <td> " . $row["BoardUniversity"]. "</td>
                                  <td> " . $row["Year"]. "</td>
                                  <td> " . $row["Location"]. "</td>
                                  <td> " . $row["marks"]. "</td>
                                </tr>
                          </div>" ;
                  }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>

        </table>
      </div>

          <div class="row">
            
            <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myEducation">Add</button>

          <!-- Modal -->
          <div class="modal fade" id="myEducation" role="dialog">
            <div class="modal-dialog">
        
          <!-- Modal content-->
              <div class="modal-content" >
                <div class="modal-header" style="color: white; background-color: black; text-align: center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Qualification</h4>
                </div>
                <div class="modal-body">
                  <form action="" method ="post">
                    
                        <input list="qualifactions" name="qualifaction" placeholder="Qualifactions">
                          <datalist id="qualifactions">
                            <option value="Schooling">
                            <option value="Graduation">
                            <option value="Diploma">
                            <option value="Post Graduate or Equivalent">
                            <option value="PhD/MPhil or Equivalent">
                            <option value="Other">
                          </datalist>
                        
                          <input list="cources" name="cource" placeholder="Course/Program">
                            <datalist id="cources">
                              <option value="Below 10th">
                              <option value="10th">
                              <option value="12th">
                              <option value="B.A">
                              <option value="B.Arch">
                              <option value="B.B.A/B.M.S">
                              <option value="B.Com">
                              <option value="B.Des">
                              <option value="B.Ed">
                              <option value="B.EI.Ed">
                              <option value="B.P.Ed">
                              <option value="B.Pharma">
                              <option value="B.Sc">
                              <option value="B.Tech/B.E.">
                              <option value="B.U.M.S">
                            </datalist>
                         
                            <input list="specializations" name="specialization" placeholder="Specialization">
                              <datalist id="specializations">
                                <option v alue="Advertising/Mass Communication">
                                <option value="Aerospace Engineering">
                                <option value="Agriculture">
                                <option value="Animation Film Design">
                                <option value="Anthropology">
                                <option value="Apparel Design">
                                <option value="Architecture">
                                <option value="Art History">
                                <option value="Arts & Humanities">
                                <option value="Arts&Humanities">
                                <option value="Astronautical Engineering">
                                <option value="Automobile">
                                <option value="Aviation">
                                <option value="Aviation Medicine/Aerospace Medicine">
                                <option value="Ayurveda">
                              </datalist>
                              
                            <input list="specializations" name="board" placeholder="Name of Board/University">
                            <datalist id="specializations">
                              <option value="Advertising/Mass Communication">
                              <option value="Aerospace Engineering">
                              <option value="Agriculture">
                              <option value="Animation Film Design">
                              <option value="Anthropology">
                              <option value="Apparel Design">
                              <option value="Architecture">
                              <option value="Art History">
                              <option value="Arts & Humanities">
                              <option value="Arts&Humanities">
                              <option value="Astronautical Engineering">
                              <option value="Automobile">
                              <option value="Aviation">
                              <option value="Aviation Medicine/Aerospace Medicine">
                              <option value="Ayurveda">
                            </datalist>
                        
                        <input type="text" name="year" placeholder="Year of Passing">
                        <input type="text" name="location" placeholder="Location">
                        <input type="text" name="marks" placeholder="% of Marks Obtained">
                        <input type="submit" name="submitEdu" value="Update" class="btn btn-info">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
</body>
</html>