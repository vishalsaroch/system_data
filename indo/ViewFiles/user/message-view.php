<?php
require_once 'cimages/page_include_100lution.php';
require_once 'cimages/functions_100lution.php';
$page = 'employee-all';
$centerId = (int) $_SESSION['s_center_id'];
if ($function->check_login()) {
    if (isset($_GET['changeStatus'])) {
      $id = (int) $_GET['changeStatus'];
      $function->change_user_status($id);
      echo '<script>window.location = "/users-view.html";</script>';
      exit;
    }elseif (isset($_GET['deleteUser'])) {
      $id = (int) $_GET['deleteUser'];
      $function->delete_data($id);
      echo '<script>window.location = "/users-view.html";</script>';
      exit;
    }
    pageHeader('Message Box | '.CLIENT_TITLE, $page);
    if (isset($_POST['sentToDelete'])) {
      $messageIdss = array();
      foreach ($_POST['sentToDelete'] as $value) {
        $x = preg_replace('|[^A-Za-z0-9=]|', '', $value);
        $messageIdss[] = $function->one_encode_decode($x, 'decode')[1];
      }
      $_SESSION['MSG'] = $function->change_message_status($messageIdss, 'sender_status', 1) ? array('success', 'Message(s) Successfully Deleted') : array('danger', 'Message(s) cannot be Deleted, Try later');
    }
    if (isset($_POST['receivedToDelete'])) {
      $messageIds = array();
      foreach ($_POST['receivedToDelete'] as $value) {
        $x = preg_replace('|[^A-Za-z0-9=]|', '', $value);
        $messageIds[] = $function->one_encode_decode($x, 'decode')[1];
      }
      $_SESSION['MSG'] = $function->change_message_status($messageIds, 'receiver_status', 1) ? array('success', 'Message(s) Successfully Deleted') : array('danger', 'Message(s) cannot be Deleted, Try later');
    }
    $start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
    $end = $start+9;
    ?>
    <style type="text/css">
      input[type=checkbox], input[type=radio] {
        position: static;
      }
      #briefdata{cursor: pointer;}
      .mailbox-subject, .mailbox-date{font-size: 13px;}
    </style>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar('message-all');?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header no-print">
          <h1>
            Message-box
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Message</a></li>
            <li class="active">View Message</li>
          </ol>
        </section>
        <section class="content-header row no-print">
          <div class="col-md-offset-3 col-md-6">
            <center><?php echo print_MSG();?></center>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4 no-print">
              <a href="/message-new.html" class="btn btn-primary btn-block margin-bottom">Compose Message</a>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><a class="btn btn-xs disabled btn-default">Inbox</a> <a class="btn btn-xs disabled btn-success">Unread</a> <a class="btn btn-xs disabled btn-info">Sent</a></h3>
                  <div class="box-tools">
                    <div class="has-feedback">
                      <button class='btn btn-box-tool pull-right' data-toggle="tooltip" title="Minimize" data-widget='collapse'><i class='glyphicon glyphicon-minus'></i></button>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                 <form action="index.php?page=admin_message_view_single" method="post" onsubmit="if(confirm('Are you sure to delete these message(s) ?')){return true;}else{return false;}">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <label class="btn btn-default btn-sm checkbox-toggle"  data-toggle="tooltip" title="Select All"><i class="glyphicon glyphicon-unchecked"></i><input type="checkbox" id="checkAll" style="display:none;"></label>
                    <button class="btn btn-default btn-sm" type="submit" data-toggle="tooltip" title="Delete Selected"><i class="glyphicon glyphicon-trash"></i></button>
                    <a class="btn btn-default btn-sm" onclick="location.reload(true);" data-toggle="tooltip" title="Refresh Message Box"><i class="glyphicon glyphicon-refresh"></i></a>
                    <div class="pull-right">
                       <?php echo ($start+1).'-'.$end; ?>
                      <div class="btn-group">
                        <a href="/message-view.html?start=<?php echo ($start-8)?>" <?php if($start<8) echo 'disabled' ?> class="btn btn-default btn-sm"  data-toggle="tooltip" title="Next"><i class="glyphicon glyphicon-arrow-left"></i></a>
                        <a href="/message-view.html?start=<?php echo $start+8; ?>" class="btn btn-default btn-sm"  data-toggle="tooltip" title="Previous"><i class="glyphicon glyphicon-arrow-right"></i></a>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages"  style="height:500px;overflow-y:auto;overflow-x:hidden">
                    <table class="table table-hover">
                      <tbody>
                        <?php
                            $user = $_SESSION['s_user_id'];
                            if (count($msgs)  == 0) {
                              echo '<tr>
                                      <td colspan="2">There are no messages in Your Message Box</td>
                                    </tr>';
                              goto end;
                            }
                            foreach ($msgs as $row) {
                              if ($row['receiver'] == $user) {
                                  $class = '';
                                  if ($row['receiver_status'] < 0) $class = 'class="success"';
                                  $type = 'received';
                              }else{
                                  $class = 'class="info"';
                                  $type = 'sent';
                              }
                              $messageID = $function->one_encode_decode($row['message_id'], 'encode', 'pm');
                             echo '<tr '.$class.'>
                                    <td><input type="checkbox" name="'.$type.'ToDelete[]" value="'.$messageID.'"/></td>
                                    <td onclick="viewMessage('."'$messageID'".');" id="briefdata">
                                      <div class="row">
                                        <div class="col-xs-7 mailbox-name"><a href="#">'.( ( $row['receiver'] == $user ) ? $row['sender_name'] : $row['receiver_name']).'</a></div>
                                        <div class="col-xs-5 mailbox-read-time">'.$function->show_elapsed_time($row['time']).'</div>
                                      </div>
                                      <div  class="mailbox-subject row">'.$row['subject'].'</div>
                                    </td>
                                   </tr>';
                            }
                            end:
                        ?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                 <form>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-8">
              <div class="box box-primary message-read-box">
                <div class="box-header with-border">
                  <h4 class="box-title">Click message to read</h4>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <button class='btn btn-box-tool pull-right' data-toggle="tooltip" title="Minimize" data-widget='collapse'><i class='glyphicon glyphicon-minus'></i></button>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding" id="msg-box" style="height:595px;">
                  <?php
                    if (isset($_GET['viewMessage'])) {
                        $param = preg_replace('|[^A-Za-z0-9 =]|i', '', $_GET['viewMessage']);
                        $function->read_message($param);
                    }else{
                      echo '<div class="mailbox-read-info row">
                              </div>
                              <div class="mailbox-read-message col-xs-12">
                                <center><h2>Select Message to view ...</h2></center>
                              </div><!-- /.mailbox-read-message -->
                            </div><!-- /.box-body -->';
                    }
                  ?>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
  </body>
</html>