<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Truelook &mdash; Man Services</title>
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
    alert(updateservicesId);
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
    // $name=$_GET["pname"];
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
      <div class="site-blocks-cover inner-page-cover" style="background-image: url(images/haircut-banner.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
              <h2 class="text-white font-weight-light mb-2 display-1">Men Services!</h2>
              <form action='search.php' method='POST' style='margin-top: 13px;''><input type='text' name='data'><input type='submit' name='submit' value='Search'></form>
            </div>
          </div>
        </div>
      </div>  
    </div>
    
    <div class="site-section bg-light">
  <div class="container">
    <div class="row">
     <div class="col-md-12 bg-white">
       
      
      <?php
        $sql = "SELECT * FROM userserviseupdate";
        // $sql = "SELECT shop.shopname, shop.location, shop.line1, shop.line2, userserviseupdate.pname, userserviseupdate.price, userserviseupdate.image, FROM shop INNER JOIN userserviseupdate ON shop.userid = userserviseupdate.userid";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<div class='row' >
                    <div class='col-md-12' >
                      <div class='col-md-6' style='margin-top:20px; margin-bottom: 20px'>
                        <strong>DOB:</strong><br>". $row["shopname"]."<br>
                        <strong>Father:</strong><br>". $row["location"]."<br>
                        <strong>Gender:</strong><br>" . $row["line1"]."<br>
                        <strong>MaritalStatus:</strong><br>" . $row["line2"]."<br>
                        <strong>Mobile No:</strong><br> " . $row["pname"]."<br>
                        <strong>Email:</strong> <br>" . $row["price"]."<br>
                      </div>
                    </div>
                  </div>";
                      }
          } else {
              echo "result not found";
          }
          $conn->close();
          ?>
      
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