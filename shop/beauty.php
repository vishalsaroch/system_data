<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Truelook &mdash; Beauty Parlor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <?php include("nav.php");?>
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
  <div class="slide-one-item home-slider owl-carousel">
   <div class="site-blocks-cover inner-page-cover" style="background-image: url(images/Banner-bridall21.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
              <h2 class="text-white font-weight-light mb-2 display-1">Beauty Parlour Services!</h2>

              
            </div>
          </div>
        </div>
      </div>  

    </div>



    <div class="site-section bg-light">
  <div class="container">
    <div class="row">
     <div class="col-md-12 bg-white">
        <!-- <div class="p-4 mb-3 "> -->
      
      <?php
          // $sql = "SELECT * from services where mobileno = '".$_SESSION['email']."';";
        $sql = "SELECT * from services WHERE `for`='woman'";
        $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            $service= $row["pname"];
      ?>
    <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5" style="float:left;" >
        <div class="h-100 p-4 p-lg-5 bg-light site-block-feature-7" >
      <a href='fileterservice.php?id=". $row['name'] ."' title='View Record' data-toggle='tooltip' target='blank'><?php 
        if($row["image"]===""){
          echo "<img src='images/module.png' height='150' width='150px' data-toggle='modal'>";}
          else{
          echo "<img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' data-toggle='modal'>";
        }
      ?>
        <br>
      <h3 class="text-black h4"><?php echo $service;?></h3></a>
      </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
</div>
        

    <?php include("footer.php");?>
  </div>
<script type="text/javascript">
function getQueryStrings() { 
  var assoc  = {};
  var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
  var queryString = location.search.substring(1); 
  var keyValues = queryString.split('&'); 

  for(var i in keyValues) { 
    var key = keyValues[i].split('=');
    if (key.length > 1) {
      assoc[decode(key[0])] = decode(key[1]);
    }
  } 

  return assoc; 
}
      var qs = getQueryStrings();
      var active = qs["active"];
      var att = document.createAttribute("class");
        att.value = "active";
      if(active=="home")
      {        
        document.getElementById("home").setAttributeNode(att);
      }
      if(active=="haircut")
      {        
        document.getElementById("haircut").setAttributeNode(att);
      }
      if(active=="services")
      {        
        document.getElementById("services").setAttributeNode(att);
      }
      if(active=="about")
      {        
        document.getElementById("about").setAttributeNode(att);
      }
      if(active=="contact")
      {        
        document.getElementById("contact").setAttributeNode(att);
      }
      if(active=="addshop")
      {        
        document.getElementById("addshop").setAttributeNode(att);
      }
      if(active=="Login")
      {        
        document.getElementById("Login").setAttributeNode(att);
      }
    </script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>