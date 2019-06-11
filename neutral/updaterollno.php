<?php include("db.php");?>
<?php
$sql = "SELECT * FROM `admission_student` where `DOB`=".$dob;
                $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                     echo '<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

                      <div class="mb-4 mb-md-0 mr-5">
                        <div class="job-post-item-header d-flex align-items-center">
                          <h2 class="mr-3 text-black h3">' . $row["sno"]. '</h2>
                          <div class="badge-wrap">
                           <span class="bg-primary text-white badge py-2 px-3">' . $row["name"]. '</span>
                          </div>
                        </div>
                        <div class="job-post-item-body d-block d-md-flex">
                          <div class="mr-3"><span class="icon-layers"></span> <a href="#">' . $row["fname"]. '</a></div>
                          <div><span class="icon-my_location"></span> <span>' . $row["location"]. '</span></div>
                        </div>
                      </div>';}
              }
?>