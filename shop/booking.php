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
  var otp123 = '';
  var data12;
  var phoneno2, address2, shopname2;
  

    $(function() {
                // #FresherRegister form id
                $("#order").submit(function(e){       
                    e.preventDefault();    
                    var digits = '0123456789';
                    otp123 = '';
                    data12 = '';
                    
                    for (let i = 0; i < 6; i++ ) {
                        otp123 += digits[Math.floor(Math.random() * 10)];
                    }
                    
                  window.alert(otp123);
                  
                  var urlkey2222="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+document.getElementById("mobile").value+"&message=Hi, "+document.getElementById("name12").value+" your OTP is "+otp123+"&priority=1&dnd=1&unicode=0";

                  data12 = "&name="+document.getElementById("name12").value+"&date="+document.getElementById("date12").value+"&time="+document.getElementById("time12").value+"&mobile="+document.getElementById("mobile").value+"&location="+document.getElementById("location").value+"&address="+document.getElementById("address").value+"&services="+document.getElementById("services").value+"&notes="+document.getElementById("note12").value;
                  
                  // window.alert(data12);
                  if(location.hostname=='localhost')
                    {
                       urlkey = "/shop/recivedorder.php";
                    }
                    else if(location.hostname=='truelook.in')
                    {
                        urlkey = "recivedorder.php";
                    }

                    $.ajax({
                        url: urlkey2222,
                        method: "GET",
                        success: function(result){
                                },
                        failure: function(result){}
                    });

                    return(false);
                    alert("OTP Sent");

                    $.ajax({
                      url: urlkey,
                      method: "POST",
                      data: data12,
                      success: function(result){alert(result);
                      },
                      failure: function(err){alert(err);}
                  });
                });


                $("#otpvarifie").submit(function(e){       
                    e.preventDefault();
                    var conform = document.getElementById("otp123").value;
                    if(otp123 == conform) {
                      window.alert("otp confirmed")
                      
                      if(location.hostname=='localhost')
                    {
                        urlkey1 = "/shop/searchuser.php";
                    }
                    else if(location.hostname=='truelook.in')
                    {
                        urlkey1 = "searchuser.php";
                    }

                    $.ajax({
                      url: urlkey2233,
                      method: "POST",
                      data: data12,
                      success: function(result){alert(result);
                      },
                      failure: function(err){alert(err);}
                      });
                    var data13="&location="+document.getElementById("location").value+"&address="+document.getElementById("address").value;
                    // var phoneno2, address2, shopname2;

                    $.ajax({
                      url: urlkey1,
                      method: "POST",
                      data: data13,
                      success: function(result){
                        alert(result);
                        var arr = result.split(";");
                        shopname2 = arr[0];
                        phoneno2 = arr[1];
                        address2 = arr[2];
                       
                      },
                      failure: function(err){alert(err);}
                  });
                    var urlkey2233="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+document.getElementById("mobile").value+"&message=Hi, "+document.getElementById("name12").value+" your booking is conformed on "+document.getElementById("date12").value+" "+document.getElementById("time12").value+" "+document.getElementById("services12").value+"and Shop Name "+shopname2+" address "+address2+" contact no "+phoneno2+" &priority=1&dnd=1&unicode=0";

                    $.ajax({
                      url: urlkey2233,
                      method: "POST",
                      data: data12,
                      success: function(result){alert(result);
                      },
                      failure: function(err){alert(err);}
                  });

                  var urlkey2244="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+phoneno2+"&message=Hi, "+document.getElementById("name12").value+" your booking is coformed on "+document.getElementById("date12").value+" "+document.getElementById("time12").value+" "+document.getElementById("services12").value+"and Shop Name "+shopname2+" address "+address2+" contact no "+phoneno2+" &priority=1&dnd=1&unicode=0";
                  // var urlkey2244="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+phoneno2+"&message=Hi, "+shopname2+" "+document.getElementById("name").value+" will come on"+document.getElementById("date12").value+" "+document.getElementById("time12").value+" for"&priority=1&dnd=1&unicode=0";

                    $.ajax({
                      url: urlkey2244,
                      method: "POST",
                      data: data12,
                      success: function(result){alert(result);
                      },
                      failure: function(err){alert(err);}
                  });
                } else {
                      window.alert("Wrong OTP Entered")
                    } 
              });
            });

</script>

    
  </head>
  <body>
  
  <?php include("nav.php");?>
  
    <div class="slide-one-i tem home-slider owl-carousel">
      <div class="site-blocks-cover inner-page-cover" style="background-image: url(images/haircut-banner.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
              <h2 class="text-white font-weight-light mb-2 display-1">Online Booking</h2>
            </div>
          </div>
        </div>
      </div>  
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">
            <form action="" id="order" method="post" class="p-5 bg-white">
              <h2 class="mb-4 site-section-heading">Book Now</h2>

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname"> Name</label>
                  <input type="text" name="name" id="name12" class="form-control" placeholder="First Name">
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <p id="otp"></p>
                  <label class="text-black" for="date">Date</label> 
                  <input type="text" name="date" id="date12" class="form-control datepicker px-2" placeholder="Date of visit">
                </div>
              </div>

               <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <p id="otp"></p>
                  <label class="text-black" for="Time">Time</label> 
                  <input type="time" name="time" id="time12" class="form-control timepicker px-2" placeholder="Time of visit">
                </div>
              </div>
               
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="mobile">Mobile Number</label>
                  <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number"> 
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="location">location</label>
                  <input type="text" name="location" id="location" class="form-control" placeholder="location"> 
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="address">Address</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="address"> 
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="treatment">Service You Want</label>
                  <!-- <input type="text" name="treat" id="treatment12" class="form-control" placeholder="Mobile Number">  -->
                  <select name="services" id="services12" class="form-control">
                    <option value="Hair Cutting">Hair Cut</option>
                    <option value="Hair Coloring">Hair Coloring</option>
                    <option value="Shave">Shave</option>
                    <option value="Hair Conditioning">Hair Conditioning</option>
                  </select>
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="note">Notes</label> 
                  <textarea name="notes" id="note12" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" id="send" value="Send" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>
            </form>

          
            <form action="#" id="otpvarifie" method="post" class="p-5 bg-white">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="otp">OTP</label>
                  <p id="otpget123"></p>
                  <!-- <p id="opt1">1234</p> -->
                  <input type="text" name="otp" id="otp123" class="form-control" placeholder="OTP">
                </div>
              </div>

               <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <input type="submit" name="varify" id="varify" value="Varify"  class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>
            </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">Delhi</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@truelook.in</a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ad iure porro mollitia architecto hic consequuntur. Distinctio nisi perferendis dolore, ipsa consectetur? Fugiat quaerat eos qui, libero neque sed nulla.</p>
              <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Get In Touch</a></p>
            </div>

          </div>
        </div>
      </div>
    </div> 


     <div class="site-section">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 class="mb-4 text-black">We want your hair to look fabulous</h2>
            <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-5 text-white">Visit Our Salon Now</a></p>
          </div>
        </div>
      </div>
    </div>


    <?php include("footer.php");?>
  </div>

  
  
   <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>