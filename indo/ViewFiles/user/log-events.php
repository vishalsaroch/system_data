<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

pageHeader('View Log Events | '.CLIENT_TITLE, $page);
$start = 0;
?>
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
            All Log Events
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Log Book</li>
              <li class="active">Events </li>
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
                        <th>Time</th>
                        <th>User ID</th>
                        <th>Event</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $events = $function->get_log_events_array($start);
                          foreach ($events as $event) {
                            if ($event['status'] < 1) {
                              $status = 'class="danger" title="Failed Event"';
                            }else{
                              $status = 'title="Successful Event"';
                            }
                            echo '<tr '.$status .'>
                                    <td>'.$event['time'].'</td>
                                    <td class="userId" title="Click User ID to get Name">'.$event['user'].'</td>
                                    <td>'.$event['event'].'</td>
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
    <script type="text/javascript">
      $('.table').dataTable();
      $('.userId').click(function() {
        var id = $(this).html();
        $.ajax({
          url: '/process.html',
          type: 'post',
          data: {
            'uid': id,
            'ajax':true,
            'process': 'getUserName'
          },
          success: function(data) {
            alert(data);
          },
          error: function(xhr, desc, err) {
            alert('Unable to fetch user name');
          }
        });
      });
    </script>
  </body>
</html>