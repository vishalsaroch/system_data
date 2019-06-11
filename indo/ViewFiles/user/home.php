<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$date = date_create(date('Y-m-d'));
pageHeader('Welcome to Dashboard | '.CLIENT_TITLE, $page);
?>
    <style type="text/css">
      .product-img h3{margin: 7px 10px;color: grey;}
      .box-body{min-height:277px;}
      .clearfix p{margin: 0;}
      .info-box-icon .glyphicon{margin-top: 20px;}
    </style>
    <style type="text/css">
      .glyphicon-lock{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-edit{color: green;}
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
    <body class="skin-yellow sidebar-mini" >
      <div class="wrapper">
        <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php pageSideBar($page);?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Welcome <?php echo $_SESSION['SESS__name'].' <small>'.CLIENT_TITLE.' Management</small>'; ?>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <!-- Info boxes -->
            <?php $dataCount = $function->count_dashboard_tickets_data(-1); ?>
            <div class="row">
              <div class="col-md-3 col-xs-6 col-xxs-12">
                <div class="info-box" data-toggle="tooltip" title="Total pending tickets till today">
                  <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-dashboard"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> Pending Tickets</span>
                    <span class="info-box-number"><a href="/tickets-view/open"><?php echo $dataCount['count1']; ?></a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
              <div class="col-md-3 col-xs-6 col-xxs-12">
                <div class="info-box" data-toggle="tooltip" title="Number of tickets scheduled to be closed today">
                  <span class="info-box-icon bg-light-blue"><i class="glyphicon glyphicon-star"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> Today Completions</span>
                    <span class="info-box-number"> <a href="/tickets-view/open"><?php echo $dataCount['count2'];; ?></a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>
              <div class="col-md-3 col-xs-6 col-xxs-12">
                <div class="info-box" data-toggle="tooltip" title="Number of tickets which details updated today">
                  <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-refresh"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> Todays Updated</span>
                    <span class="info-box-number"> <a href="/tickets-view/open"><?php echo $dataCount['count4'];; ?></a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
              <div class="col-md-3 col-xs-6 col-xxs-12">
                <div class="info-box" data-toggle="tooltip" title="Total number of new ticket raised today">
                  <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-time"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text"> Todays New</span>
                    <span class="info-box-number"> <a href="/tickets-view/open"><?php echo $dataCount['count3'];; ?></a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <div class="col-md-12">
                <!-- TABLE: LATEST Tickets -->
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recent Tickets</h3>
                    <div class="box-tools pull-right">
                      <a class="btn btn-box-tool" href="/tickets-new" data-toggle="tooltip" title="New Ticket"><i class="glyphicon glyphicon-edit"></i></a>
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>#Code</th>
                            <th>Center Code</th>
                            <th>City</th>
                            <th>Product ID</th>
                            <th title="Estimated Turn Around (Resolution) Time">TAT</th>
                            <th>Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $tickets = $function->get_recent_tickets_data($centerId);
                            if (!empty($tickets)) {
                              foreach ($tickets as $ticket) {
                                if ($ticket['status'] > 0) {
                                  $status = 'class="success" title="Closed Ticket"';
                                  $link = '/tickets-view/closed/code/';
                                }else{
                                  $status = '';
                                  $link = '/tickets-view/open/code/';
                                }
                                echo '
                                  <tr '.$status.'>
                                    <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['complaint'].'"><b>'.$ticket['code'].'</b></a></td>
                                    <td>'.$ticket['centerName'].' ('.$ticket['center'].')</td>
                                    <td>'.$ticket['city'].'</td>
                                    <td>'.$ticket['product'].' - '.$ticket['model'].'</td>
                                    <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['complaint'].'">'.$ticket['tat'].'</a></td>
                                    <td>'.$ticket['time'].'</td>
                                  </tr>
                                ';
                              }
                            }else{
                              echo '
                                  <tr>
                                    <td colspan="6">There Are no Tickets in you records</td>
                                  </tr>
                                ';
                            }
                          ?>
                        </tbody>
                      </table>
                    </div><!-- /.table-responsive -->
                  </div><!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="/tickets-view/open" class="uppercase">View All Tickets</a>
                  </div><!-- /.box-footer -->
                </div><!-- /.box -->
              </div><!-- /.col -->
              <div class="col-md-12">
                <!-- TABLE: LATEST Tickets -->
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recent Closed Tickets</h3>
                    <div class="box-tools pull-right">
                      <a class="btn btn-box-tool" href="/tickets-view/open" data-toggle="tooltip" title="Close a Ticket"><i class="glyphicon glyphicon-edit"></i></a>
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>#Code</th>
                            <th>Center Code</th>
                            <th>City</th>
                            <th>Product ID</th>
                            <th>Raise Time</th>
                            <th title="Final Closing time" data-toggle="tooltip">Close Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $tickets = $function->get_recent_closed_tickets($centerId);
                            if (!empty($tickets)) {
                              foreach ($tickets as $ticket) {
                                echo '
                                  <tr '.$status.'>
                                    <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['complaint'].'"><b>'.$ticket['code'].'</b></a></td>
                                    <td>'.$ticket['centerName'].' ('.$ticket['center'].')</td>
                                    <td>'.$ticket['city'].'</td>
                                    <td>'.$ticket['product'].' - '.$ticket['model'].'</td>
                                    <td>'.$ticket['time'].'</td>
                                    <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['complaint'].'">'.$ticket['tat'].'</a></td>
                                  </tr>
                                ';
                              }
                            }else{
                              echo '
                                  <tr>
                                    <td colspan="6">There Are no Closed Tickets in you records</td>
                                  </tr>
                                ';
                            }
                          ?>
                        </tbody>
                      </table>
                    </div><!-- /.table-responsive -->
                  </div><!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="/tickets-view/closed" class="uppercase">View All closed Tickets</a>
                  </div><!-- /.box-footer -->
                </div><!-- /.box -->
              </div><!-- /.col -->
              <?php
                if ($_SESSION['SESS__azz_level'] > 5) {
                  ?>
                    <div class="col-md-6">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Latest Jobs</h3>
                          <div class="box-tools pull-right">
                            <a class="btn btn-box-tool" href="/jobs-new" data-toggle="tooltip" title="New Job for a ticket"><i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="glyphicon glyphicon-remove"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <ul class="products-list product-list-in-box">
                            <?php
                              $jobs = $function->get_recent_job_works($centerId);
                              if (!empty($jobs)) {
                                foreach ($jobs as $job){
                                  if ($job['status'] != -1) {
                                    $status = 'class="label label-success pull-right" title="Ticket Closed"';
                                    $link = '/jobs-view/closed/id/';
                                  }else{
                                    $status = 'class="label label-danger pull-right" title="Ticket Still Pending (Open)"' ;
                                    $link = '/jobs-view/open/id/';
                                  }
                                  echo '<li class="item">
                                          <div class="product-img">
                                            <h3>1</h3>
                                          </div>
                                          <div class="product-info">
                                            <a href="javascript:void();" class="jobTocketsId" id="'.$job['complaint'].'">'.$job['code'].'</a>
                                            <span '.$status.'>'.$job['time'].'</span>
                                            <span class="product-description">
                                              '.$job['descr'].'.
                                            </span>
                                          </div>
                                        </li><!-- /.item -->';
                                }
                              }else{

                              }
                            ?>
                          </ul>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                          <a href="/jobs-view" class="uppercase">View All</a>
                        </div><!-- /.box-footer -->
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-md-6">
                      <!-- USERS LIST -->
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Latest Centers</h3>
                          <div class="box-tools pull-right">
                            <a class="btn btn-box-tool" href="/users-new" data-toggle="tooltip" title="New User"><i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="glyphicon glyphicon-remove"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                          <ul class="users-list clearfix">
                            <?php
                              $users = $function->get_recent_centers();
                              foreach ($users as $user){
                                echo '<li>
                                        <img src="/images/users/'.$user['id'].'.png" alt="User Image"/>
                                        <a class="users-list-name" href="#">'.$user['name'].'</a>
                                        <span class="users-list-date">'.$user['center'].'</span>
                                      </li>';
                              }
                            ?>
                          </ul><!-- /.users-list -->
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                          <a href="/centers" class="uppercase">View More</a>
                        </div><!-- /.box-footer -->
                      </div><!--/.box -->
                    </div><!-- /.col -->
                  <?php
                }else{
                  ?>
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Latest Jobs</h3>
                          <div class="box-tools pull-right">
                            <a class="btn btn-box-tool" href="/jobs-new" data-toggle="tooltip" title="New Job for a ticket"><i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="glyphicon glyphicon-remove"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <ul class="products-list product-list-in-box">
                            <?php
                              $jobs = $function->get_recent_job_works($centerId);
                              if (!empty($jobs)) {
                                foreach ($jobs as $job){
                                  $status = ($job['status'] == 1) ? 'success' : 'danger' ;
                                  echo '<li class="item">
                                          <div class="product-img">
                                            <h3>IH</h3>
                                          </div>
                                          <div class="product-info">
                                            <a href="javascript:void();" class="jobTocketsId" id="'.$jobs['complaint'].'"> '.$job['code'].'</a>
                                            <span class="label label-'.$status.' pull-right">'.$job['time'].'</span>
                                            <span class="product-description">
                                              '.$job['descr'].'.
                                            </span>
                                          </div>
                                        </li><!-- /.item -->';
                                }
                              }else{
                                echo '<li class="item">
                                          <div class="product-img">
                                            <h3>1</h3>
                                          </div>
                                          <div class="product-info">
                                            <a href="javascript:void();" class="jobTocketsId" id="'.$jobs['complaint'].'"> &nbsp; </a>
                                            <span>NA</span>
                                            <span class="product-description">
                                              No Recent Job Work done
                                            </span>
                                          </div>
                                        </li><!-- /.item -->';
                              }
                            ?>
                          </ul>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                          <a href="/jobs-view/closed" class="uppercase">View All</a>
                        </div><!-- /.box-footer -->
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  <?php
                }
              ?>
            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <?php
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
        });
      </script>
    </body>
    </html>