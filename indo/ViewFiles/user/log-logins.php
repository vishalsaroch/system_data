<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

pageHeader('View Login Attempts | '.CLIENT_TITLE, $page);
$start = 0;
?>
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .glyphicon-ban-circle{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-ok{color: green;}
      .userId{cursor: pointer;}
    </style>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php pageSideBar($page);?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            All Login Attempt Details
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Log Book</li>
              <li class="active">Login Attempts </li>
          </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box"  style="overflow:auto;">
                <div class="box-body">
                  <table id="employees" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>User ID</th>
                        <th>Time</th>
                        <th>Logout</th>
                        <th>IP</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $logins = $function->get_logins_array($start);
                          foreach ($logins as $login) {
                            if ($login['status'] < 0) {
                              $status = 'class="danger" title="Login Failed"';
                            }elseif ($login['status'] === '1') {
                              $status = 'class="success" title="User Logged IN"';
                            }else{
                              $status = ' title="User Logged out"';
                            }
                            echo '<tr '.$status .'>
                                    <td>'.$login['user'].'</td>
                                    <td>'.$login['login'].'</td>
                                    <td>'.$login['logout'].'</td>
                                    <td><a href="http://ip-api.com/#'.$login['ip'].'" target="_blank">'.$login['ip'].'</a></td>
                                  </tr>';
                          }

                      ?>
                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php pageFooter();
        ?>
    </div><!-- ./wrapper -->
    <?php pageJsInclude($page);?>
  </body>
</html>