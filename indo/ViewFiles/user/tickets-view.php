<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$varVal  = isset($_GET['var']) ? $_GET['var'] : '';
$varName  = isset($_GET['var2']) ? $_GET['var2'] : '';

if (($varName == 'resendSMSCus') && ($level > 5)) {
  $id = (int) filter_data($varVal);
  $complaint = $function->getComplainSMS($id, 'Customer');
  if ($complaint) {
    require_once MODEL_DIRECTORY.'/sms.php';
    $complaint['id'] = str_pad($complaint['id'], 6, 0, STR_PAD_LEFT);
    $responce1 = sendRegSMS($complaint['mobile'], $complaint['id'], $complaint['otp']);
    $responce1 = $responce1 ? array('success', 'Message sent again to Customer '.$complaint['mobile'].' for complain #'.$complaint['id']) : array('danger', 'Message could not be send again to Customer '.$complaint['mobile'].' for complain #'.$complaint['id'].'. <a href="/tickets-view/'.$complaint['id'].'/resendSMSCus" title="Resend Customer SMS">Resend</a>');
    $_SESSION['MSG'] = $responce1;
  }else{
    $_SESSION['MSG'] = array('danger', 'Customer Message not sent for complain #'.$id);
  }
  echo '<script>window.location = "/tickets-view";</script>';
  header('Location: /tickets-view');
  exit;
}elseif (($varName == 'resendSMSCen') && ($level > 5)) {
  $id = (int) filter_data($varVal);
  $complaint = $function->getComplainSMS($id, 'Center');
  if ($complaint) {
    require_once MODEL_DIRECTORY.'/sms.php';
    $complaint['id'] = str_pad($complaint['id'], 6, 0, STR_PAD_LEFT);
    $responce1 = sendPartnerSMS($complaint['mobile'], $complaint['id'], $complaint['name'], $complaint['custMobile'], $complaint['address'], $complaint['issue'], $complaint['product'].' '.complaint['model']);
    $responce1 = $responce1 ? array('success', 'Message sent again to Center '.$complaint['mobile'].' for complain #'.$complaint['id']) : array('danger', 'Message could not be send again to Center '.$complaint['mobile'].' for complain #'.$complaint['id'].'. <a href="/tickets-view/'.$complaint['id'].'/resendSMSCen" title="Resend Center SMS">Resend</a>');
    $_SESSION['MSG'] = $responce1;
  }else{
    $_SESSION['MSG'] = array('danger', 'Center Message not sent for complain #'.$id);
  }
  echo '<script>window.location = "/tickets-view";</script>';
  header('Location: /tickets-view');
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

      if ($varVal == 'closed') {
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              All Closed Tickets
            </h1>
            <ol class="breadcrumb">
                <li><i class="glyphicon glyphicon-compressed"></i> Tickets</li>
                <li class="active">Closed Tickets </li>
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
                          <th>#Code</th>
                          <th>Customer</th>
                          <th>Product</th>
                          <th>Center</th>
                          <th>City</th>
                          <th>In</th>
                          <th>Closed</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $tickets = $function->get_tickets_array(1);
                            foreach ($tickets as $ticket) {
                              // if ($level > 5) {
                              //   $action = '
                              //     <a href="#" class="performAction" id="/tickets-view/deleteticket/'.$ticket['id'].'.html" title="Delete Ticket"><i class="glyphicon glyphicon-trash"></i></a>
                              //     &nbsp; <a href="/tickets-view/changeStatus/'.$ticket['id'].'.html" title="Re-open Ticket"><i class="glyphicon glyphicon-edit"></i></a>';
                              // }else{
                              //   $action = '';
                              // }
                              echo '<tr>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['id'].'">'.$ticket['code'].'</a></td>
                                      <td>'.$ticket['customer'].' <br> ('.$ticket['mobile'].')</td>
                                      <td>'.$ticket['product'].' <br> ('.$ticket['model'].') ('.$ticket['company'].')</td>
                                      <td>'.$ticket['centerName'].'<br> ('.$ticket['center'].')</td>
                                      <td>'.$ticket['city'].' <br> ('.$ticket['pin'].')</td>
                                      <td>'.$ticket['open_time'].'</td>
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['id'].'">'.$ticket['close_time'].'</a></td>
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
        <?php
      }elseif ($varVal == 'canceled') {
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              All Canceled Tickets
            </h1>
            <ol class="breadcrumb">
                <li><i class="glyphicon glyphicon-compressed"></i> Tickets</li>
                <li class="active">Canceled Tickets </li>
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
                          <th>#Code</th>
                          <th>Customer</th>
                          <th>Product</th>
                          <th>Center</th>
                          <th>City</th>
                          <th>In</th>
                          <th>Canceled</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $tickets = $function->get_tickets_array(2);
                            foreach ($tickets as $ticket) {
                              // if ($level > 5) {
                              //   $action = '
                              //     <a href="#" class="performAction" id="/tickets-view/deleteticket/'.$ticket['id'].'.html" title="Delete Ticket"><i class="glyphicon glyphicon-trash"></i></a>
                              //     &nbsp; <a href="/tickets-view/changeStatus/'.$ticket['id'].'.html" title="Re-open Ticket"><i class="glyphicon glyphicon-edit"></i></a>';
                              // }else{
                              //   $action = '';
                              // }
                              echo '<tr>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['id'].'">'.$ticket['code'].'</a></td>
                                      <td>'.$ticket['customer'].' <br> ('.$ticket['mobile'].')</td>
                                      <td>'.$ticket['product'].' <br> ('.$ticket['model'].') ('.$ticket['company'].')</td>
                                      <td>'.$ticket['centerName'].'<br> ('.$ticket['center'].')</td>
                                      <td>'.$ticket['city'].' <br> ('.$ticket['pin'].')</td>
                                      <td>'.$ticket['open_time'].'</td>
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['id'].'">'.$ticket['close_time'].'</a></td>
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
        <?php
      }else{
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              All Current Tickets
            </h1>
            <ol class="breadcrumb">
                <li><i class="glyphicon glyphicon-compressed"></i> Tickets</li>
                <li class="active">Open Tickets </li>
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
                          <th>#Code</th>
                          <th>Customer</th>
                          <th>Product</th>
                          <th>Center</th>
                          <th>City</th>
                          <th>In</th>
                          <th>Est Close</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $tickets = $function->get_tickets_array(-1);
                            foreach ($tickets as $ticket) {
                              if ($level > 5) {
                                $action = '
                                  <a href="/tickets-view/'.$ticket['id'].'/resendSMSCen" title="Resend Center SMS"><i class="glyphicon glyphicon-phone"></i></a> &nbsp; &nbsp;
                                  <a href="/tickets-view/'.$ticket['id'].'/resendSMSCus" title="Resend Customer SMS"><i class="glyphicon glyphicon-envelope"></i></a> &nbsp; &nbsp;
                                  <a href="/tickets-new/'.$ticket['id'].'/edit" title="Edit Ticket"><i class="glyphicon glyphicon-edit"></i></a> &nbsp; &nbsp;
                                  <a href="/jobs-new/'.$ticket['id'].'/edit" title="Add New Job"><i class="glyphicon glyphicon-plus-sign"></i></a>';
                              }else{
                                $action = '';
                              }
                              echo '<tr>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['id'].'">'.$ticket['code'].'</a></td>
                                      <td>'.$ticket['customer'].' <br> ('.$ticket['mobile'].')</td>
                                      <td>'.$ticket['product'].' <br> ('.$ticket['model'].') ('.$ticket['company'].')</td>
                                      <td>'.$ticket['centerName'].'<br> ('.$ticket['center'].')</td>
                                      <td>'.$ticket['city'].' <br> ('.$ticket['pin'].')</td>
                                      <td>'.$ticket['open_time'].'</td>
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['id'].'">'.$ticket['close_time'].'</a></td>
                                      <td>'.$action.'</td>
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
      $(document).on('click', '.performAction', function() {
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
        if (isset($_GET['code'])) {
          $id = (int) $_GET['code'];
          echo 'var id = '.$id .';
              $.ajax({
                url: "/process.html",
                type: "post",
                data: {
                  "tid": id,
                  "ajax":true,
                  "process": "ticketDetails"
                },
                success: function(data, status) {
                  $("#ticketDetails").html(data);
                },
                error: function(xhr, desc, err) {
                  $("#ticketDetails").html("<center><b>Unable to fetch details</b></center>");
                }
              });
              $("#ticketDetailModal").modal("show");
          ';
        }
      ?>
    </script>
  </body>
</html>