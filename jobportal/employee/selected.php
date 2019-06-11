<?php include("../config.php")?>
<?php
                     
                      $inid=$_POST['inid'];
                      echo $inid;
                      $doj=$_POST['doj'];
                      echo $doj;
                      $salary=$_POST['salary'];
                      echo $salary;
                      $sql = "UPDATE `interview` SET `doj`='".$doj."', `offered_salary`='".$salary."' WHERE `inid`='".$inid."';";
                      $run = mysqli_query($conn, $sql);
                      if ($run) {
                         echo "ofered updated";
                          header("location:interviewstatus.php");
                        } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                    
                     ?>