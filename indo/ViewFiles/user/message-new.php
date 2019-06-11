<?php
require_once 'cimages/page_include_100lution.php';
require_once 'cimages/functions_100lution.php';
$page = 'employee-all';
$centerId = (int) $_SESSION['s_center_id'];
if ($function->check_login()) {
    pageHeader('New Message | '.CLIENT_TITLE, $page);
      $selected = isset($_GET['recipient']) ? preg_replace('|[^a-zA-Z0-9]|i', '', $_GET['recipient']) : null;
    ?>
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      input[type=checkbox], input[type=radio] {
        position: static;
    }
    </style>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar('message-new');?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Message-box
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Message</a></li>
            <li class="active">Single Message</li>
          </ol>
        </section>
        <section class="content-header row">
          <div class="col-md-offset-3 col-md-6">
            <center><?php echo print_MSG();?></center>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <form action="/process.html" method="post" class="row" onsubmit="if(this.form.message.value.length > 0){alert('Please select atleast one Recipient'); return false;}">
            <input type="hidden" name="reciepients">
            <div class="col-md-3">
              <a href="/message-view.html" class="btn btn-primary btn-block margin-bottom">View Messages</a>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Select Recipients</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='glyphicon glyphicon-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding" style="height:430px;overflow:auto;">
                  <table class="table table-hover table-bordered">
                    <?php $details = $function->get_user_list();
                        foreach ($details as $row) {
                              echo '<tr title="'.$row['designation'].'">
                                        <td><input type="checkbox" '.(($selected ==  $row['id']) ? 'checked' : '' ).' name="reciepients[]" value="'.$row['id'].'"></td>
                                        <td>'.$row['name'].' ('.$row['center'].')</td>
                                      </tr>';
                          }
                    ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">New Message <small id="count"></small></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" pattern="[A-Za-z0-9 ,-_.]{20,50}" title="Enter Subject for message, minimum 20, maximm 50 characters only - _ , . allowed" maxlength="50" value="<?php if(isset($_SESSION['form'])) echo $_SESSION['form'][0];?>"/>
                  </div>
                  <div class="form-group">
                    <textarea id="message" name="message" style="height: 300px;width:100%" placeholder="Please enter your message here, Please don't write your name or ID" required>
                      <?php if(isset($_SESSION['form'])){echo $_SESSION['form'][1]; unset($_SESSION['form']);} ?>
                    </textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <input type="hidden" name="process" value="addMessage">
                  <button type="submit" id="submitButton" class="btn btn-success btn-flat pull-right"> Send</button>
                  <input type="reset" value="Clear" class="btn btn-danger btn-flat">
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </form><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php pageFooter();
        ?>
      </div><!-- ./wrapper -->
      <?php pageJsInclude('message');?>
  </body>
</html>
  <?php
}else{
  header('Location: login');
  exit;
}
?>