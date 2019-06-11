<?php include("config.php");?>
<?php include("user-session.php");?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creative CV</title>
    <meta name="description" content="Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your portfolio, skils and experience."/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
  </head>
  <!-- <body id="top"> -->
  <body>
    

<div class="section" id="contact">
  <div class="cc-contact-information">
    <div class="container">
      <div class="cc-contact">
        <div class="row">
          <div class="col-md-9">
            <div class="card mb-0" data-aos="zoom-in">
              <div class="h4 text-center title" >
                <h2>Create Vcard</h2>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                      <div class="p pb-3"><strong>Contact Infomation </strong></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="file" name="photo" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                            <input class="form-control" type="text" name="address" placeholder="Address" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input class="form-control" type="text" name="cnumber" placeholder="Calling Number" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                            <input class="form-control col-md-11" type="number" name="whatsaap" placeholder="Whatsaap Number" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                            <input class="form-control" type="text" name="facebook" placeholder="Facebok" required="required"/>
                          </div>
                        </div>
                      </div>
                       <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-skype"></i></span>
                            <input class="form-control" type="email" name="skype" placeholder="Skype" required="required"/>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="col">
                          <button class="btn btn-warning" type="submit">Update</button>
                        </div>
                      </div> -->
                      <div class="p pb-3"><strong>Professional Information</strong></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                            <input class="form-control" type="text" name="company" placeholder="Company" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <input class="form-control" type="text" name="des" placeholder="Designation" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-web"></i></span>
                            <input class="form-control" type="text" name="web" placeholder="Website" required="required"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-web"></i></span>
                            <input class="form-control" type="file" name="logo" placeholder="Website" required="required"/>
                          </div>
                        </div>
                      </div>
                       
                      </div>
                      <div class="row">
                        <div class="col">
                          <button class="btn btn-warning" type="submit">Update</button>
                        </div>
                      </div>

                    </form>
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