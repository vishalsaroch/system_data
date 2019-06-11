<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

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

pageHeader('View All CRM User | '.CLIENT_TITLE, $page);
?>
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .glyphicon-ban-circle{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-ok{color: green;}
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
            All Employee Details
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Employee</li>
              <li class="active">All Employees </li>
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
                  <?php echo $error = $function->getMessage(); ?>
                  <table id="employees" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Center</th>
                        <th>Phone</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $users = $function->get_users_array($centerId);
                          foreach ($users as $user) {
                            if ($user['status'] > 0) {
                              $status = 'class="success"';
                              $action = '<a href="#" class="performAction" id="/users-view/changeStatus/'.$user['id'].'.html" title="Block User"><i class="glyphicon glyphicon-ban-circle"></i></a>';
                            }else{
                              if ($user['status'] == 'NA') {
                                $status = '';
                                $action = '';
                              }else{
                                $status = 'class="danger"';
                                $action = '<a href="#" class="performAction" id="/users-view/changeStatus/'.$user['id'].'.html" title="Unblock User"><i class="glyphicon glyphicon-ok"></i></a>';
                              }
                            }
                            echo '<tr '.$status.'>
                                    <td><a href="#userDetailModal" data-toggle="modal" class="usersId">'.$user['id'].'</a></td>
                                    <td>'.$user['name'].'</td>
                                    <td>'.$user['designation'].'</td>
                                    <td>'.$user['center'].'</td>
                                    <td><a href="tel:'.$user['phone'].'">'.$user['phone'].'</a></td>
                                    <td>
                                       '.$action.' &nbsp; &nbsp;
                                       <a href="#" class="performAction" id="/users-view/deleteUser/'.$user['id'].'.html" title="Delete User"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                  </tr>';
                          }

                      ?>
                    </tbody>

                  </table>
                  <div class="modal" id="userDetailModal">
                    <div class="modal-dialog">
                      <div class="modal-content" id="userDetails">
                        <center><b>Unable to fetch details</b></center>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
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
      $('.performAction').click(function() {
        if (confirm('Are you sure to perform this Action ?')) {
          window.location = $(this).attr('id');
        }
      });
      $('.usersId').click(function() {
        var id = $(this).html();
        $.ajax({
          url: '/process.html',
          type: 'post',
          data: {
            'uid': id,
            'ajax':true,
            'process': 'userDetails'
          },
          success: function(data, status) {
            $('#userDetails').html(data);
          },
          error: function(xhr, desc, err) {
            $('#userDetails').html('<center><b>Unable to fetch details</b></center>');
          }
        });
      });
      <?php
        if (isset($_GET['id'])) {
          $id = (int) $_GET['id'];
          echo 'var id = '.$id .';
              $.ajax({
                url: "/process.html",
                type: "post",
                data: {
                  "uid": id,
                  "ajax":true,
                  "process": "userDetails"
                },
                success: function(data, status) {
                  $("#userDetails").html(data);
                },
                error: function(xhr, desc, err) {
                  $("#userDetails").html("<center><b>Unable to fetch details</b></center>");
                }
              });
              $("#userDetailModal").modal("show");
          ';
        }
      ?>
    </script>
  </body>
</html>