
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HairSal &mdash; Colorlib Website Template</title>
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
  
    <script>
            $(function() {
                //#FresherRegister form id
                $("#Register").submit(function(e){       
                    e.preventDefault();    
                    var userid=document.getElementById("phoneno").value;
                    var pwd=document.getElementById("name123").value.slice(0,4)+document.getElementById("phoneno").value.slice(6);
                    document.getElementById("pwd123").value=pwd;
                    var formData = new FormData(this);
                                
                    var urlkey;
                    
                    if(location.hostname=='localhost')
                    {
                        urlkey = "/shop/saveshop.php";
                    }
                    else if(location.hostname=='truelook.in')
                    {
                        urlkey = "saveshop.php";
                    }
                    var urlkey2222="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+document.getElementById("phoneno").value+"&message=Hi, "+document.getElementById("name123").value+" your Userid is "+userid+" Password is "+pwd+".Please visit https/truelook.in/profile&priority=1&dnd=1&unicode=0";
                    // var urlkey2222="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+document.getElementById("phoneno").value+"&message=Hi, Your Userid - "+userid+" Password - "+pwd+" Please visit https://cogentsol.in/employer/dashbord2&priority=1&dnd=1&unicode=0";
                    $.ajax({
                                url: urlkey,
                                method: "POST",
                                data: formData,
                                success: function(result){alert(result);
                                
                                if(result!=="Email id already exist."){
                                window.location = "profile.php";
                                 $.ajax({
                        
                                            url: urlkey2222,
                                            method: "GET",
                                            
                                            success: function(result){alert("SMS Sent");                                
                                            },
                                            failure: function(err){alert(err);},
                                            
                                        });
                                    }
                                },
                                failure: function(err){alert(err);},
                                cache: false,
                                contentType: false,
                                processData: false
                    });
                    // return(false);
                    // alert("SMS Sent");
                });
            });

</script>
    
  </head>
  <body>
  
  <?php include("nav.php");?>
    <!-- <div class="slide-one-item home-slider owl-carousel">
      <div class="site-blocks-cover inner-page-cover" style="background-image: url(images/haircut-banner.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
              <h2 class="text-white font-weight-light mb-2 display-1">User Registeration</h2>
            </div>
          </div>
        </div>
      </div>  
    </div> -->

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">
         
            <form action="" method="post" id="Register" enctype="multipart/form-data" class="p-5 bg-white">
              <h2 class="mb-4 site-section-heading">User Registration </h2>
              <div class="col-md-12" style="margin-top: 20px;">
                  <label>Shop Name</label>
                  <input type="text" id ="name123" name="shopname" class="form-control" placeholder="Shop Name *" required />
              </div>
              <div class="col-md-12" style="margin-top: 20px;" style="margin-top: 20px;">
                  <label>Owner Name</label>
                  <input type="text" name="ownername" class="form-control" placeholder="Owner Name *"  required />
              </div>
              <div class="col-md-12" style="margin-top: 20px;">
                  <label>Mobile Number</label>
                  <input type="number" minlength="10" id="phoneno" maxlength="10" name="mobile" class="form-control" placeholder="Your Phone *"/>
              </div>

              <div class="col-md-12" style="margin-top: 20px;">
                  <label>Location</label>
                  <input type="text" name="location" class="form-control" placeholder="Location *" required/>
              </div>
              <input type="text" id="pwd123" style="display:none;" name="pwd">
              <div class="col-md-6" style="margin-top: 20px;">
                <p>ALREADY HAVE AN ACCOUNT  <a href="login2/index.php">LOGIN</a> HERE</p>
              </div>
                        
              <div class="col-md-6"style="margin-top: 20px;">
                <input type="submit" class="btn btn-success" value="Register" > 
              </div>
            </form>     
          </div>
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


   <!--  <div class="site-section">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 class="mb-4 text-black">We want your hair to look fabulous</h2>
            <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-5 text-white">Visit Our Salon Now</a></p>
          </div>
        </div>
      </div>
    </div> -->


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
