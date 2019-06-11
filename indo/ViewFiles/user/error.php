<?php
$var = isset($_GET['var']) ? $_GET['var'] : '';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Error Occurred | <?php echo CLIENT_TITLE; ?></title>
  <link href="<?php echo CDN_CSS; ?>/bootstrap.min.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
  <link href="<?php echo CDN_CSS; ?>/main.min.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
  <link href="<?php echo CDN_CSS; ?>/jquery-ui.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

</body>
</html>
    <style type="text/css">
      label{
        font-size: 12px;
      }
      .skin-yellow .wrapper, .skin-yellow .main-sidebar, .skin-yellow .left-side{background-color: #fff; }
    </style>
    <body class="skin-yellow sidebar-mini" id="tooltip">
      <div class="wrapper">
          <!-- Main content -->
          <?php
            if ($var == 404) {
              ?>
                <section class="content">
                  <div class="error-page">
                    <h2 class="headline text-yellow"> 404</h2>

                    <div class="error-content">
                      <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                      <p>
                        We could not find the page you were looking for.<br>
                        Maybe we have missed something or You have typed wrong
                      </p>
                      <a href="/" class="btn btn-flat btn-warning">Go to Home</a>
                    </div>
                    <!-- /.error-content -->
                  </div>
                  <!-- /.error-page -->
                </section>
              <?php
            }elseif($var == 500){
              ?>
              <section class="content">
                <div class="error-page">
                  <h2 class="headline text-yellow"> 500</h2>

                  <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Server Down.</h3>

                    <p>
                      Server is down or malfunctioned, We are trying to resolve it.<br>
                      Till then have a snap and Please try later
                    </p>
                    <center><a href="#" class="btn btn-flat btn-default"><i class="glyphicon glyphicon-apple" style="font-size: 50px;"></i></a></center>
                  </div>
                  <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
              </section>
              <?php
            }else{
              ?>
              <section class="content">
                  <div class="error-page">
                    <h2 class="headline text-yellow"> Error</h2>

                    <div class="error-content">
                      <h3><i class="fa fa-warning text-yellow"></i> Oops! Something Wrong.</h3>

                      <p>
                        <?php echo isset($_GET['error']) ? $_GET['error'] : 'Please visit Later'; ?>
                      </p>
                      <a href="/" class="btn btn-flat btn-warning">Go to Home</a>
                    </div>
                    <!-- /.error-content -->
                  </div>
                  <!-- /.error-page -->
                </section>
              <?php
            }
          ?>
          <!-- /.content -->
      </div>