<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$pageType  = isset($_GET['var']) ? $_GET['var'] : 'bsbsbsbsbs';

list($fromV, $toV, $centerV, $statusV, $stateV, $districtV) =  explode('bs', $pageType);
$fromV = $fromV ? filter_data($fromV) : date('Y-m-d');
$toV = $toV ? filter_data($toV) : date('Y-m-d');
$statusV = (int) $statusV;
$stateV = $stateV ? filter_data($stateV) : '';
$districtV = $districtV ? filter_data($districtV) : '';
$showAll = ($statusV == -2) ? true : false;

if ($centerId != 1) {
    $centerV = $centerId;
    $stateV = '';
    $districtV  = '';
}

if (($pageType == 'resendSMS') && ($level > 5)) {
  $id = (int) filter_data($_GET['var2']);
  $complaint = $function->getComplainSMS($id);
  if ($complaint) {
    require_once MODEL_DIRECTORY.'/sms.php';
    $complaint['id'] = str_pad($complaint['id'], 6, 0, STR_PAD_LEFT);
    sendRegSMS($complaint['mobile'], $complaint['id'], $complaint['otp']);
    $_SESSION['MSG'] = array('success', 'Message sent again to '.$complaint['mobile'].' for complain #'.$complaint['id']);
  }else{
    $_SESSION['MSG'] = array('danger', 'Message not sent for complain #'.$id);
  }
  echo '<script>window.location = "/tickets-view";</script>';
  header('Location: /tickets-view');
  exit;
}
pageHeader('Center Reports | '.CLIENT_TITLE, $page);
?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
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
        .print {display: block;}
        .printHeader{
          display: block;
        }
      }
      .select2-container{
        border-radius: 0 !important;
      }
    </style>
  <body class="skin-yellow sidebar-mini">
    <div id="overlay" style="display: none;"><img style="margin:20% auto;display: block;" src="/assets/images/loader.svg" alt="Validating ..."></div>
    <div class="wrapper noprint">
      <?php pageTopBar(); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar($page); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <form class="row" id="form" action="" method="post">
              <div class="col-sm-3 col-xs-6 form-group">
                  <label>From Date </label><br>
                  <input type="date" class="form-control input-sm" name="from" id="fromV" required="">
              </div>
              <div class="col-sm-3 col-xs-6 form-group">
                  <label>To Date </label><br>
                  <input type="date" class="form-control input-sm" name="to" id="toV" required="">
              </div>
              <div class="col-sm-3 col-xs-6 form-group">
                  <label>Status </label><br>
                  <select class="form-control input-sm" name="status" id="statusV" required="">
                    <option value="-2">All</option>
                    <option value="-1">Only Open</option>
                    <option value="1">Only Closed</option>
                    <option value="2">Only Canceled</option>
                  </select>
              </div>
              <div class="col-sm-3 col-xs-6 form-group">
                  <label>&nbsp;</label><br>
                  <input type="submit" value="Get" class="btn btn-success btn-sm pull-right">
              </div>
              <?php if ($centerId == 1) { ?>
                <div class="col-sm-4 col-xs-4">
                  <label>State </label>
                  <select class="form-control input-sm" id="stateV" name="state"  minlength="2">
                    <option value="">Select ...</option>
                    <OPTION VALUE="ANDHRA PRADESH">ANDHRA PRADESH</OPTION>
                    <OPTION VALUE="ARUNANCHAL PRADESH">ARUNANCHAL PRADESH</OPTION>
                    <OPTION VALUE="ASSAM">ASSAM</OPTION>
                    <OPTION VALUE="BIHAR">BIHAR</OPTION>
                    <OPTION VALUE="CHANDIGARH">CHANDIGARH</OPTION>
                    <OPTION VALUE="CHHATTISGARH">CHHATTISGARH</OPTION>
                    <OPTION VALUE="DELHI">DELHI</OPTION>
                    <OPTION VALUE="GOA">GOA</OPTION>
                    <OPTION VALUE="GUJRAT">GUJRAT</OPTION>
                    <OPTION VALUE="HARYANA">HARYANA</OPTION>
                    <OPTION VALUE="HIMACHAL PRADESH">HIMACHAL PRADESH</OPTION>
                    <OPTION VALUE="JHARKHAND">JHARKHAND</OPTION>
                    <OPTION VALUE="KARNATAKA">KARNATAKA</OPTION>
                    <OPTION VALUE="KERALA">KERALA</OPTION>
                    <OPTION VALUE="LAKSHADWEEP">LAKSHADWEEP</OPTION>
                    <OPTION VALUE="MADHYA PRADESH">MADHYA PRADESH</OPTION>
                    <OPTION VALUE="MAHARASHTRA">MAHARASHTRA</OPTION>
                    <OPTION VALUE="MANIPUR">MANIPUR</OPTION>
                    <OPTION VALUE="MEGHALAYA">MEGHALAYA</OPTION>
                    <OPTION VALUE="MIZORAM">MIZORAM</OPTION>
                    <OPTION VALUE="NAGALAND">NAGALAND</OPTION>
                    <OPTION VALUE="ODISHA">ODISHA</OPTION>
                    <OPTION VALUE="PONDICHERRY">PONDICHERRY</OPTION>
                    <OPTION VALUE="PUNJAB">PUNJAB</OPTION>
                    <OPTION VALUE="RAJASTHAN">RAJASTHAN</OPTION>
                    <OPTION VALUE="SIKKIM">SIKKIM</OPTION>
                    <OPTION VALUE="TAMIL NADU">TAMIL NADU</OPTION>
                    <OPTION VALUE="TELANGANA">TELANGANA</OPTION>
                    <OPTION VALUE="TRIPURA">TRIPURA</OPTION>
                    <OPTION VALUE="UTTAR PRADESH">UTTAR PRADESH</OPTION>
                    <OPTION VALUE="UTTARAKHAND">UTTARAKHAND</OPTION>
                    <OPTION VALUE="WEST BENGAL">WEST BENGAL</OPTION>
                  </select>
                </div>
                <div class="col-sm-4 col-xs-4">
                  <label>District </label>
                  <select class="form-control input-sm" name="district" id="districtV">
                    <option value="">Select State First</option>
                  </select>
                </div>
                <div class="col-sm-4 col-xs-4 form-group">
                    <label>Center </label><br>
                    <select class="form-control input-sm" name="center" id="centerV">
                      <?php
                        $centers = $function->getCenterNameOptions();
                        foreach ($centers as $center) {
                          echo '<option value="'.$center['id'].'">'.$center['center'].', '.$center['city'].'</option>
                          ';
                        }
                      ?>
                    </select>
                </div>
              <?php } ?>
            </form>
        </section>
        <section class="content-header">
          <div class="col-md-offset-3 col-md-6"></div>
          <div id="responseMsg"><?php echo $error = $function->getMessage(); ?></div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box"  style="overflow:auto;">
                <div class="box-body">
                  <?php echo $error = $function->getMessage(); ?>
                  <table id="table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#Code</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Center</th>
                        <th>City</th>
                        <th>In</th>
                        <th>Est Close</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Extra</th>
                        <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $tickets = $function->get_ticketsReports_array($statusV, $fromV, $toV, $centerV, $stateV, $districtV, $showAll);
                            foreach ($tickets as $ticket) {
                              // if ($level > 5) {
                              //   $action = '
                              //     <a href="#" class="performAction" id="/tickets-view/deleteticket/'.$ticket['id'].'.html" title="Delete Ticket"><i class="glyphicon glyphicon-trash"></i></a>
                              //     &nbsp; <a href="/tickets-view/changeStatus/'.$ticket['id'].'.html" title="Re-open Ticket"><i class="glyphicon glyphicon-edit"></i></a>';
                              // }else{
                              //   $action = '';
                              // }
                              $status = ($ticket['status'] == 1) ? 'Closed' : (($ticket['status'] == 2) ? 'Canceled' : 'Open');
                              echo '<tr>
                                      <td><a href="javascript:void();" class="ticketsId" id="'.$ticket['id'].'">'.$ticket['code'].'</a></td>
                                      <td>'.$ticket['customer'].' <br> ('.$ticket['mobile'].')</td>
                                      <td>'.$ticket['product'].' <br> ('.$ticket['model'].')</td>
                                      <td>'.$ticket['center'].'</td>
                                      <td>'.$ticket['city'].' <br> ('.$ticket['pin'].')</td>
                                      <td>'.$ticket['open_time'].'</td>
                                      <td><a href="javascript:void();" class="jobTocketsId" id="'.$ticket['id'].'">'.$ticket['close_time'].'</a></td>
                                      <td>'.$ticket['company'].'</td>
                                      <td>'.$status.'</td>
                                      <td>'.(($_SESSION['SESS__azz_level'] > 7) ? $ticket['km_run'].' KM' : '').'</td>
                                      <td>'.$ticket['address'].', '.$ticket['city'].', '.$ticket['district'].'</td>
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
      <?php pageFooter(); ?>
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
      $('#centerV').select2();
      $(function(){

        $('#stateV').change(function(){
            var qstring = $(this).val();
            $.ajax({
              type:'POST',
              data:{
                  'state' : qstring,
                  'ajax' : 'findDistrict'
              },
              beforeSend : function(){
                $('#overlay').css({
                  'background': '#000',
                  'width': '100%',
                  'height': '100%',
                  'position': 'absolute',
                  'top': 0,
                  'lfunctioneft': 0,
                  'opacity': .6,
                  'display': 'block',
                  'zIndex': '1001'
                });
              }
            })
            .done(function(districts) {
              districts = JSON.parse(districts);
              $('#districtV').html('<option value="">Select District ...</option>');
              $.each(districts, function(key, value) {
                $('#districtV').append('<option value="' + value.district + '">' + value.district + '</option>');
              });
            })
            .fail(function() {
              $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to Districts, Please change State and retry</center></div>');
            }).always(function(){
              $('#overlay').removeAttr('style');
              $('#overlay').css('display', 'none');
            });
        });
      });
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
      $(function(){
        $('#fromV').val('<?php echo $fromV; ?>');
        $('#toV').val('<?php echo $toV; ?>');
        $('#centerV').val('<?php echo $centerV; ?>');
        $('#statusV').val('<?php echo $statusV; ?>');
        $('#stateV').val('<?php echo $stateV; ?>'.replace(/-/g, ' '));
        var districtt = '<?php echo $districtV; ?>'.replace(/-/g, ' ');
        $('#districtV').append('<option value="'+districtt+'">'+districtt+'</option>')
        $('#districtV').val(districtt);
      });
      $("#form").submit(function(e) {
          e.preventDefault();
          var fromV  = $('#fromV').val();
          var toV  = $('#toV').val();
          var statusV  = $('#statusV').val();
          var centerV  = $('#centerV').val() ? $('#centerV').val() : '';
          var stateV  = $('#stateV').val() ? $('#stateV').val().replace(/\s+/g, '-') : '';
          var districtV  = $('#districtV').val() ? $('#districtV').val().replace(/\s+/g, '-') : '';

          window.location = "/center-reports/"+fromV+'bs'+toV+'bs'+centerV+'bs'+statusV+'bs'+stateV+'bs'+districtV+"/report";
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