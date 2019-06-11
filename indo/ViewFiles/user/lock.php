<?php
require_once '../cimages/page_include_crm.php';
require_once '../cimages/config_100_crm.php';
SessionO::session_start_100lution();

if (isset($_SESSION['s_user_id'])) {
    pageHeader('Locked Profile - '.$_SESSION['s_user_name'].' | '.$_SESSION['s_institute'].' | '.CLIENT_TITLE, 'login');
    ?>
    <body class="lockscreen" onload="getTime()">
      <!-- Automatic element centering -->
      <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
          <a href="<?php echo CLIENT_URL; ?>" target="_blank"><img src="images/logoL.png"></a>
        </div>
        <?php print_MSG(); ?>
        <!-- User name -->
        <div class="lockscreen-name"><?php echo $_SESSION['s_user_name'];?></div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
          <!-- lockscreen image -->
          <div class="lockscreen-image">
            <img src="images/users/<?php echo $_SESSION['s_user_id'];?>.jpg" alt="user image"/>
          </div>
          <!-- /.lockscreen-image -->

          <!-- lockscreen credentials (contains the form) -->
          <form class="lockscreen-credentials" action="process" method="post" onsubmit="logging2();">
            <div class="input-group">
              <input type="password" pattern="^\S{6,}$" title="Use correct passord" name="password" placeholder="Enter password" style="color:#E9662C" class="form-control" onchange="if(this.value.length >= 6){this.value = hash_100lution(this.value);}" maxlength="128" required/>
              <div class="input-group-btn">
                <input type="hidden" name="process" value="login">
                <button class="btn" id="unlock"><i class="glyphicon glyphicon-arrow-right text-muted"></i></button>
              </div>
            </div>
          </form><!-- /.lockscreen credentials -->

        </div><!-- /.lockscreen-item -->
        <div class="help-block text-center">
          Enter your password to unlock CRM
        </div>
        <div class='text-center'>
          <a href="logout">Or Logout &nbsp; <i class="glyphicon glyphicon-log-out text-muted"></i></a>
        </div>
        <div id="showtime"></div>
        <div class='lockscreen-footer text-center'>
          <?php echo '<strong><a href="'.$_SESSION['s_institute_url'].'"> '.$_SESSION['s_institute'].' </a> | &copy; '.date('Y').' <a href="'.CLIENT_URL.'"><i>'.CLIENT.'</i></a> | </strong> All rights reserved.'; ?>
        </div>
      </div><!-- /.center -->

      <!-- jQuery 2.1.4 -->
      <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>

    <script src="includes/js/sha512.js"></script>
    <script>
    function getTime()
    {
        var today=new Date();
        var h=today.getHours();
        var m=today.getMinutes();
        var s=today.getSeconds();
        // add a zero in front of numbers<10
        m=checkTime(m);
        s=checkTime(s);
        document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
        t=setTimeout(function(){getTime()},500);
    }

    function checkTime(i)
    {
        if (i<10)
        {
            i="0" + i;
        }
        return i;
    }
</script>
  </html>
    <?php
}else{
    $_SESSION[' MSG'] = array('danger', 'Request Denied');
    header('Location: '.CLIENT_LOGIN_URL);
    exit;
}
?>