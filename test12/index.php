<?php include("config.php");?>
<?php include("user-session.php");?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creative CV</title>
    <link rel="manifest" href="../manifest.json">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="realkeeper">
<meta name="apple-mobile-web-app-title" content="realkeeper">
<meta name="msapplication-starturl" content="/index.php">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" href="images/logo">
<link rel="apple-touch-icon" href="images/logo">
    <meta name="description" content="Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your portfolio, skils and experience."/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">

  </head>
  <!-- <body id="top"> -->
  <body>
  <!-- <?php echo $_SESSION['email'];?> -->
    
  <?php
    $sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
  ?>
<div class="section" id="contact">
  <div class="cc-contact-information" style="background-image: url('images/cc-bg1.jpg');">
    <div class="container">
      <div class="cc-contact">
        <div class="row">
          <div class="col-md-9">
            <div class="card mb-0" data-aos="zoom-in" style="background-color: #8c5cdb">
              <div class="h4 text-center title" >
                <div class="cc-profile-image"><a href="#">
                <!-- <img src="images/anthony.jpg"> -->
                <?php echo "<img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($row["photo"])."'>";?></a></div>
                  <div class="h2 title text-light"><?php echo $row["name"] ?></div>
                  <p class="category text-light"><?php echo $row["designation"] ?></p>
                  <p class="category text-light"><?php echo $row["company"] ?></p>
                  <hr style="background-color:black">
                  <h5 class="text-light">Contact Me</h5>
                  <div class="button-container">
                      <a class="btn btn-default btn-round btn-lg btn-icon"  style="background-color: orange" href="tel:<?php echo $row['phone'] ?>" rel="tooltip" title="Call "><i class="fa fa-phone"></i></a>
                      <a class="btn btn-default btn-round btn-lg btn-icon"  style="background-color: orange" href="https://api.whatsapp.com/send?phone=<?php echo $row['phone'] ?>" rel="tooltip" title="Whatsaap" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                      <a class="btn btn-default btn-round btn-lg btn-icon"  style="background-color: orange" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['email'] ?>" rel="tooltip" title="Email" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                      <a class="btn btn-default btn-round btn-lg btn-icon"  style="background-color: orange" href="https://www.facebook.com/search/top/?q=<?php echo $row['facebook'] ?>" target="_blank" rel="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a>
                      
                      <hr style="background-color:black">
                      <h5 class="text-light">Share</h5>
                        <a class="btn btn-default btn-round btn-lg btn-icon" href="#"  data-toggle="dropdown" style="background-color: orange" rel="tooltip" title="Share"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                        <div class="dropdown-menu" style="background-color:transparent;">
                        <a class="btn btn-default btn-round btn-lg btn-icon dropdown-item"  style="background-color: green" href="https://api.whatsapp.com/send?phone=<?php echo $row['phone'] ?>" rel="tooltip" title="Whatsaap" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        <a class="btn btn-default btn-round btn-lg btn-icon dropdown-item"  style="background-color: red" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['email'] ?>" rel="tooltip" title="Email" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                        <a class="btn btn-default btn-round btn-lg btn-icon dropdown-item"  style="background-color: blue" href="https://www.facebook.com/search/top/?q=<?php echo $row['facebook'] ?>" target="_blank" rel="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a>
                      
                        </div>
                        <!-- href="vcard.php?id=1" -->
                        <a class="btn btn-default btn-round btn-lg btn-icon" href="vcard.php" style="background-color: orange" rel="tooltip" title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                      <hr style="background-color:black">
                      <h5 class="text-light">Company</h5>
                      <a class="btn btn-default btn-round btn-lg btn-icon" href="#" style="background-color: orange" rel="tooltip" title="Logo"><?php echo "<img  src='data:image/jpeg;base64,".base64_encode($row["logo"])."' style='height:100%; width:100%'>";?></a>
                      <a class="btn btn-default btn-round btn-lg btn-icon" href=https://<?php echo $row['website'] ?> target="_blank" style="background-color: orange" rel="tooltip" title="WebSite"><i class="fa fa-globe" aria-hidden="true"></i><p></p></a>
                      
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>
    </div>
    <?php
                      }
                     
                    } else {
                      echo "no result found";
                    }
                  ?>
    <!-- <footer class="footer">
      <div class="container text-center"><a class="cc-facebook btn btn-link" href="#"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></a><a class="cc-twitter btn btn-link " href="#"><i class="fa fa-twitter fa-2x " aria-hidden="true"></i></a><a class="cc-google-plus btn btn-link" href="#"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a><a class="cc-instagram btn btn-link" href="#"><i class="fa fa-instagram fa-2x " aria-hidden="true"></i></a></div>
      <div class="h4 title text-center">Anthony Barnett</div>
      <div class="text-center text-muted">
        <p>&copy; Creative CV. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
      </div>
    </footer> -->
    <script src="js/core/jquery.3.2.1.min.js"></script>
    <script src="js/core/popper.min.js"></script>
    <script src="js/core/bootstrap.min.js"></script>
    <script src="js/now-ui-kit.js?v=1.1.0"></script>
    <script src="js/aos.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>