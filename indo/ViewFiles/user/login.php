<?php
PageHeader('Login to your profile | '.CLIENT_TITLE, $page);
?>
<style type="text/css">
  @media (min-width: 768px){
    .modal-dialog {
        width: 450px;
        margin: 60px auto;
    }
  }
</style>
</head>
<body class="login-page" style="background: transparent url(/assets/images/bg2.jpg) top center no-repeat;background-size:contain;overflow-y:hidden;">
    <div class="login-box" style="float: right;">
      <div class="login-box-body">
        <div class="alert alert-dismissable row" style="margin:-20px -20px 0 -20px;">
            <center><a href="/"><img src="/assets/images/logo.png" alt="<?php echo CLIENT_TITLE; ?>"></a></center>
        </div>
        <p class="login-box-msg"></p>
        <p align="center">Enter your Identity to go on your way ...  </p><br>
        <form action="" method="post" enctype="form-data/multipart" onsubmit="this.password.value = login_hash(this.password.value);">
          <?php echo $error = $function->getMessage(); ?>
          <div class="form-group has-feedback">
            <input type="text" title="Username" pattern=".{4,50}" maxlength="50" name="username" placeholder="Username" style="color:#0ca2c0" class="form-control" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" title="Password" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? \'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter\' : \'\');"  name="password" placeholder="Password" style="color:#ce0806" class="form-control" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <p class="pull-right"><a href="#" data-toggle="modal" data-target="#forgotModal">Forgot ?</a></p>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
              <p align="center" class="login-box-msg"><small>By Signing in, you agree to our <a href="/tnc" target="_blank"><code>Terms & Conditions</code></a></small></p>
          </div>
          <div id="logging" class="form-group">
            <input type="hidden" name="process" value="login"/>
            <button type="submit" class="btn btn-solution btn-flat btn-block pull-right" >Proceed</button>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
    <!-- forgot modal -->
    <div class="modal" id="forgotModal">
      <div class="modal-dialog">
        <div class="modal-content" id="blockDetails">
          <form action="/process.iifct" method="post" role="form" style="border:1px solid orange; padding:5% 5% 0 5%; margin-top:10px;" enctype="multipart/form-data">
            <!-- text input -->
            <div class="row">
              <div class="col-xs-12 form-group">
                <label>Email <span>*</span></label>
                <input type="email" class="form-control" placeholder="Registered Email" name="email" maxlength="100" required="" />
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 form-group">
                <label>Mobile <span>*</span> :</label>
                <input type="mobile" class="form-control" placeholder="Registered Mobile" name="mobile" maxlength="10" pattern="[0-9]{10}" required="" />
              </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <input type="hidden" name="process" value="forgotPassword">
                <button type="submit" class="btn btn-solution btn-flat btn-block pull-right" >Reset Password</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- end forgot modal -->
    <script src="<?php echo CDN_JS; ?>/bestWeb_hash.js"></script>
    <?php
      PageJsInclude($page);
    ?>
</body>
</html>