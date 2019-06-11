<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Truelook &mdash; search</title>
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
    <script>
  function seeMoreData(element){
    var bookingId=element.childNodes[1].innerHTML;
    alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/shop/booking.php?id="+booking.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("booking.php.php?id="+booking.toString());
      }
  }
</script>
  </head>
  <body>
  <?php include("nav.php");?>
  <?php
  // $name=$_GET["id"];
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
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
     <div class="col-md-12 bg-white">
        <!-- <div class="p-4 mb-3 "> -->
      <!-- <h3><b>Services</b></h3> -->
      
     <!--  $data = $_POST["data"]; -->
         <!-- $sql = "SELECT * from userserviseupdate";
        
         // $sql = "SELECT * FROM `userservices` where pname=".$name;
        $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            $service= $row["pname"]; -->
        <!-- $total_pages_sql = "SELECT COUNT(*) FROM userserviseupdate";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM userserviseupdate ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
    $result = $conn->query($sql); -->
    <?php
    $sql = "SELECT * FROM userserviseupdate where location='".$data."'";
          while($row = $result->fetch_assoc()) {
           <!--  $service= $row["pname"]; -->
      ?>
      <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5" style="float:left;" >
        <div class="h-100 p-4 p-lg-5 bg-light site-block-feature-7" >
          <a href='booking.php' .php? id=". $row['pname'] ."' title='View Record' data-toggle='tooltip' target='blank' target='blank'>
          <?php echo"<a href='booking.php?id=". $row['pname'] ."' title='View Record' data-toggle='tooltip' target='_blank'></a>"?>
          <?php 
            if($row["image"]===""){
              echo " <a href='booking.php?id=". $row['pname'] ."' title='View Record' data-toggle='tooltip' target='_blank'> <img src='images/module.png' height='150' width='150px' data-toggle='modal'></a>";}
              else{
              echo "<a href='booking.php?id=". $row['pname'] ."' title='View Record' data-toggle='tooltip' target='_blank'><img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' data-toggle='modal'></a>";
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