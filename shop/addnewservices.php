
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Truelook Add new Service</title>
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

  <?php
    if(isset($_POST['add'])){
      $name= $_POST['name'];
      $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
      $for=$_POST['for'];
      $sql = "SELECT * from `services` WHERE name = '".$name."' ";   
       $result1 = $conn->query($sql);
        if ($result1->num_rows > 0) {
          echo "Services is lredy Activated.";
        } else {
        $sql = "INSERT INTO `services` (`name`, `image`, `for`) VALUES ('$name', '$images', '$for')";
        $run = mysqli_query($conn, $sql);
        if($run){
             echo "Service Activate Successfully";
          }else{
              echo "Error: " . $query. "<br>" . $conn->error;
          }
      }
    }
  ?>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">
            <form action="" method="post" id="Register" enctype="multipart/form-data" class="p-5 bg-white">
              <h2 class="mb-4 site-section-heading">Add New services</h2>
              <div class="col-md-12" style="margin-top: 20px;">
                  <label>Service Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Service Name *" required />
              </div>
              <div class="col-md-12" style="margin-top: 20px;">
                  <label>Service For</label>
                  <br>
                  <label class="radio-inline" style="text-indent: 25px;"><input type="radio" name="for"value="Man" class="radio">Man</label>
                      
                  <label class="radio-inline" style="text-indent: 40px;"><input type="radio" name="for"value="woman" class="radio">woman</label>
              </div>
              <br><br>
              <div class="col-md-6" > <output id="list"></output></div> <br> <br>
               <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose" style="color:#fff">

              <div class="col-md-6"style="margin-top: 20px;">
                <input type="submit" name="add" class="btn btn-success" value="Add" > 
              </div>
            </form>     
          </div>
          <script>
          function handleFileSelect(evt) {
            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

              // Only process image files.
              if (!f.type.match('image.*')) {
                continue;
              }

              var reader = new FileReader();
              // Closure to capture the file information.
              reader.onload = (function(theFile) {
                return function(e) {
                  // Render thumbnail.
                  var span = document.createElement('span');
                  span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                    '" title="', escape(theFile.name), '" height="150px" width="150px"/>'].join('');
                  document.getElementById('list').insertBefore(span, null);
                };
              })(f);
            reader.readAsDataURL(f);
            }
          }
        document.getElementById('fileToUpload').addEventListener('change', handleFileSelect, false);
        </script>
          <div class="col-md-5">
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">Delhi</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">9718264050</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@truelook.in</a></p>
            </div>
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p>Truelook is the Best Mens Haircut in Delhi. Your Truelook experience starts from the moment you walk in the door.</p>
              <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include("footer.php");?>

  </div>

<script src="js/aos.js"></script>

  <script src="js/main.js"></script> 
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
  </body>
</html>
