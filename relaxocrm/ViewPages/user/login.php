<?php
require_once 'admin_include_dj.php';
PageHead($page);
PageJsInclude();
//echo $function->getMessage();
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="col-sm-offset-8 col-sm-4 login-block">
    <div class="text-center">
        <img src="./assets/images/logo.png" id="logoimg" alt=" Logo" />
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="" method="post" enctype="multipart/form-data" name="login" onsubmit="this.password.value = login_hash(this.password.value);">
                <div class="form-group col-xs-12">
                  <label for="emailInputLogin">Username <sup>*</sup></label>
                  <input type="text" class="form-control" id="emailInputLogin" name="username" placeholder="Email or Phone" maxlength="100" minlength="10" required="">
                </div>
                <div class="form-group col-xs-12">
                  <label for="passwordInputLogin">Password <sup>*</sup></label>
                  <input type="password" class="form-control" id="passwordInputLogin" name="password" placeholder="Password" maxlength="128" minlength="6" required="">
                </div>
                <div class="form-group col-xs-12">
                    <div class="g-recaptcha" data-sitekey="6LdEVD8UAAAAALHPidZTjWPb_ZYkqEpjwe_fOjF7" data-callback="validateCaptcha"></div>
                </div>
                <div class="form-group col-xs-12">
                    <input type="hidden" name="process" value="login">
                    <input type="hidden" name="referer" value="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                    <button type="submit" class="btn btn-primary"><i class="icon-long-arrow-right"></i> Login</button>
                    <a class="text-muted pull-right" href="#forgot" data-toggle="tab">Forgot Password ?</a>
                </div>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="" method="post" enctype="multipart/form-data" name="login" onsubmit="this.password.value = login_hash(this.password.value);">
                <div class="form-group col-xs-12">
                  <label for="emailInputForgot">Username <sup>*</sup></label>
                  <input type="text" class="form-control" id="emailInputForgot" name="username" placeholder="Email or Phone" maxlength="100" minlength="10" required="">
                </div>
                <div class="form-group col-xs-12">
                    <div class="g-recaptcha" data-sitekey="6LdEVD8UAAAAALHPidZTjWPb_ZYkqEpjwe_fOjF7"></div>
                </div>
                <div class="form-group col-xs-12">
                    <input type="hidden" name="process" value="login">
                    <input type="hidden" name="referer" value="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                    <button type="submit" class="btn btn-warning"><i class="icon-long-arrow-right"></i> Request Reset</button>
                    <a class="text-muted pull-right" href="#login" data-toggle="tab">Login ?</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END PAGE CONTENT -->
<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?php echo CDN_ADMIN; ?>/js/login.js"></script>
<!--END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    function validateCaptcha(){

    }
    $(function(){
        $('body').css({
            'background-image':'url(/assets/images/background.jpg)',
            'background-repeat':'no-repeat',
            'background-size':'contain'
        });
        $('#wrap').css('background', 'transparent');
    })
</script>
<?php pageFooter(); ?>