<?php
    if($_SERVER['SERVER_NAME']=='localhost')
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dbase3";
        }
        else if($_SERVER['SERVER_NAME']=='rkce.in')
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
?>
<?php
    $img = $_POST['image'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mobileno = $_POST['mobileno'];
    $dob = $_POST['dob'];
    $qua = $_POST['qua'];
    $Cource = $_POST['Cource'];
    $address = $_POST['address'];
    $admissiondate = date("Y/m/d");
    $image = addslashes(file_get_contents($img));
    $sql = "INSERT INTO `admission_student` (`name`, `fname`, `DOB`, `mobileno`, `qualification`, `course`, `admission_date`, `address`, `image`) VALUES ('$name', '$fname', '$dob', '$mobileno', '$qua', '$Cource', '$admissiondate', '$address', '$image')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
             echo "<div class='bg-success text-center text-light text-bold'>Student admission Successfully</div><br>";
             session_start();
                // $_SESSION['mobleno'] = $mobileno;
                $_SESSION['first_name'] = $name;
                $_SESSION['last_name'] = " ";
                
                
                $_SESSION['active'] = 1;    
                
                // This is how we'll know the user is logged in
                $_SESSION['student'] = true;

                echo "<script>location='studentprofile.php'</script>";
                exit();
             echo "<script>location='studentprofile.php'</script>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }

?>
<?php
// $sql = "SELECT * FROM `admission_student` where `DOB`=".$dob;
//     $result = $conn->query($sql);
//       if ($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//          echo '<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

//           <div class="mb-4 mb-md-0 mr-5">
//             <div class="job-post-item-header d-flex align-items-center">
//               <h2 class="mr-3 text-black h3">' . $row["sno"]. '</h2>
//               <div class="badge-wrap">
//                <span class="bg-primary text-white badge py-2 px-3">' . $row["name"]. '</span>
//               </div>
//             </div>
//             <div class="job-post-item-body d-block d-md-flex">
//               <div class="mr-3"><span class="icon-layers"></span> <a href="#">' . $row["fname"]. '</a></div>
//               <div><span class="icon-my_location"></span> <span>' . $row["location"]. '</span></div>
//             </div>
//           </div>';}
//   }
?>