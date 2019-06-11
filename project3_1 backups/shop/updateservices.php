<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";

  header("location:login2/index.php");  
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
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
?>
<?php
    // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location:login2/index.php");
   exit();
     }
     
?>
<?php
      if($_SERVER['SERVER_NAME']=='localhost'){
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "shop";
            }
            else if($_SERVER['SERVER_NAME']=='truelook.in')
      {
        $servername = "sun";
        $username = "truelook_root";
        $password = "truelook@12#123";
        $dbname = "truelook_truedb";
      }
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 


      ?>
      <?php
           // if(isset($_POST['submit'])){
           $haircutting = 0;
           $shving = 0;
           $coloring = 0;
           $facial = 0;
           $drying = 0;
           $Bleaching =0; 
           $waxing = 0;
           $Bridal = 0;
           $Treatment =0; 
           $Threading = 0;
           $wColouring = 0;
           $Massage = 0;
           $Makeup = 0;
           $NailArt = 0;
           $Pedicure = 0;
           $HairCut = 0;
           $spa = 0;

           try{
           $haircutting = $_POST['haircutting'];
           $shving = $_POST['shaving'];
           $coloring = $_POST['coloring'];
           $facial = $_POST['facial'];
           $drying = $_POST['drying'];
           $Bleaching = $_POST['Bleaching'];
           $waxing = $_POST['waxing'];
           $Bridal = $_POST['Bridal'];
           $Treatment = $_POST['Treatment'];
           $Threading = $_POST['Threading'];
           $wColouring = $_POST['wColouring'];
           $Massage = $_POST['Massage'];
           $Makeup = $_POST['Makeup'];
           $NailArt = $_POST['NailArt'];
           $Pedicure = $_POST['Pedicure'];
           $HairCut = $_POST['HairCut'];
           $spa = $_POST['spa'];
         }catch(Exception $e){
          
         // }
           $sql = "UPDATE `shop` SET `HairCutting`='".$haircutting."',`BarberShave`='".$shving."', `HairColoring`='".$coloring."' , `HairDryer`='".$drying."', `Facial`='".$facial."', `BleachingService`='".$Bleaching."', `Bodywaxing`='".$waxing."', `Bridal`='".$Bridal."', `SkinCareTreatment`='".$Treatment."', `FaceThreading`='".$Threading."', `HairColouring`='".$wColouring."',`HeadMassage`='".$Massage."', `Makeup`='".$Makeup."', `NailArt`='".$NailArt."', `Pedicure`='".$Pedicure."', `HairCut`='".$HairCut."', `spa`='".$spa."'WHERE `userid`='".$_SESSION['email']."';";
             $run = mysqli_query($conn, $sql);
              if ($run) {
                echo "<p>Service Activate Sucessfully</p>";
                } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }
         
          ?>