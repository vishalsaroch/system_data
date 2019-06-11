<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$pageType = isset($_GET['var']) ? $_GET['var'] : 'closed';


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
pageHeader('View & Modify Employees/Users | '.CLIENT_TITLE, $page);
?>
    <link href="/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .glyphicon-lock{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-edit{color: green;}
      .glyphicon-phone{color: #0febb5;}
      .printHeader{
        display: none;
      }
      .modal-footer{text-align: left;}
      /*td,th{text-align: center;}*/
      .modal-content{min-height: 200px;}
      @media print{
        .noprint { display: none;}
        .print {display: absolute; position: relative;max-width: 100%;}
        .print tr th:first-child{width: 20%;}
        .printHeader{display: block;}
        .modal-dialog{width: 1200px;}
        .modal-dialog th, .modal-dialog td{font-size: 16px;}
      }
    </style>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper noprint">
      <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar($page);

      if ($pageType == 'closed') {
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              All Closed Ticket Jobs
            </h1>
            <ol class="breadcrumb">
                <li><i class="glyphicon glyphicon-compressed"></i> Jobs</li>
                <li class="active">Closed Ticket Jobs </li>
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
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#Job ID</th>
                          <th># Complaint Code</th>
                          <th>Center</th>
                          <th>Attender</th>
                          <th>Time</th>
                          <th>Work</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $jobs = $function->get_jobs_array(1);
                            foreach ($jobs as $job) {
                              echo '<tr title="">
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$job['complaint'].'">'.$job['jobId'].'</a></td>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$job['complaint'].'">'.$job['complaint'].'</a></td>
                                      <td>'.$job['center'].'</td>
                                      <td>'.$job['attender'].'</td>
                                      <td>'.$job['time'].'</td>
                                      <td>'.$job['work'].'</td>
                                    </tr>';
                            }

                        ?>
                      </tbody>

                    </table>
                    <div class="modal" id="jobDetailModal">
                      <div class="modal-dialog">
                        <div class="modal-content" id="jobDetails">
                          <center><b>Unable to fetch details</b></center>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <div class="modal" id="jobJobDetailModal">
                      <div class="modal-dialog">
                        <div class="modal-content" id="jobJobDetails">
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
        <?php
      }else{
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              All Current Ticket Jobs
            </h1>
            <ol class="breadcrumb">
                <li><i class="glyphicon glyphicon-compressed"></i> Jobs</li>
                <li class="active">Current Ticket Jobs </li>
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
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#Job ID</th>
                          <th># Complaint Code</th>
                          <th>Center</th>
                          <th>Attender</th>
                          <th>Time</th>
                          <th>Work</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $jobs = $function->get_jobs_array(-1);
                            foreach ($jobs as $job) {
                              echo '<tr title="">
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$job['complaint'].'">'.$job['jobId'].'</a></td>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$job['complaint'].'">'.$job['complaint'].'</a></td>
                                      <td>'.$job['center'].'</td>
                                      <td>'.$job['attender'].'</td>
                                      <td>'.$job['time'].'</td>
                                      <td>'.$job['work'].'</td>
                                    </tr>';
                            }

                        ?>
                      </tbody>

                    </table>
                    <div class="modal" id="jobDetailModal">
                      <div class="modal-dialog">
                        <div class="modal-content" id="jobDetails">
                          <center><b>Unable to fetch details</b></center>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <div class="modal" id="jobJobDetailModal">
                      <div class="modal-dialog">
                        <div class="modal-content" id="jobJobDetails">
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
        <?php
      }
      pageFooter();
        ?>
    </div><!-- ./wrapper -->
    <div class="modal print" id="ticketDetailModal">
      <div class="modal-dialog">
        <div class="modal-content" id="ticketDetails">
          <center class="noprint"><b>Unable to fetch details</b></center>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="modal print" id="ticketJobDetailModal">
      <div class="modal-dialog">
        <div class="modal-content" id="ticketJobDetails">
          <center class="noprint"><b>Unable to fetch details</b></center>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <?php pageJsInclude($page);?>
    <script type="text/javascript">
      $(function(){
        $('.table').dataTable();
      });
      $('.performAction').click(function() {
        if (confirm('Are you sure to perform this Action ?')) {
          window.location = $(this).attr('id');
        }
      });
      $(document).on('click', '.ticketsId' ,function() {
        var id = $(this).attr('id');
        $.ajax({
          type: 'post',
          data: {
            'tid': id,
            'ajax':'ticketDetails'
          },
          beforeSend : function(){
            $('#ticketDetails').html('<center><span style ="margin-top:100px;"><img style="margin-top:200px;" src="/assets/images/loader.svg" alt="Validating ..."></span></center>');
          },
          success: function(data, status) {
            $('#ticketDetails').html(data);
            $('#ticketDetailModal').modal('show');
          },
          error: function(xhr, desc, err) {
            $('#ticketDetails').html('<center><span style ="margin-top:100px;">Unable to fetch Details, Please try later</span></center>');
          }
        });
      });
      $(document).on('click', '.jobTocketsId', function() {
        var id = $(this).attr('id');
        $.ajax({
          type: 'post',
          data: {
            'tid': id,
            'ajax': 'ticketJobDetails'
          },
          beforeSend : function(){
            $('#ticketDetails').html('<center><span style ="margin-top:100px;"><img style="margin-top:200px;" src="/assets/images/loader.svg" alt="Validating ..."></span></center>');
          },
          success: function(data, status) {
            $('#ticketJobDetails').html(data);
            $('#ticketJobDetailModal').modal('show');
          },
          error: function(xhr, desc, err) {
            $('#ticketJobDetails').html('<center><span style ="margin-top:100px;">Unable to fetch Details, Please try later</span></center>');
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
                  "jid": id,
                  "ajax":true,
                  "process": "jobDetails"
                },
                success: function(data, status) {
                  $("#jobDetails").html(data);
                },
                error: function(xhr, desc, err) {
                  $("#jobDetails").html("<center><b>Unable to fetch details</b></center>");
                }
              });
              $("#jobDetailModal").modal("show");
          ';
        }
      ?>
    </script>
  </body>
</html>