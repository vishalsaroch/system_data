<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

pageHeader('Add New Job Work for Complain Ticket | '.CLIENT_TITLE, $page);
?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
      label{
        font-size: 12px;
      }
    </style>
  </head>
    <body class="skin-yellow sidebar-mini" id="tooltip">
      <div class="wrapper">
        <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php pageSideBar($page);?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              New Job Work
            </h1>
            <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Jobs</li>
              <li class="active">Perform New</li>
            </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>
          <div id="overlay" style="display: none;"><img style="margin:20% auto;display: block;" src="/assets/images/loader.svg" alt="Validating ..."></div>
          <!-- Main content -->
          <section class="content">
            <div class='row'>
              <div class='col-xs-12'>
                <div class="nav-tabs-custom">
                  <section id="new">
                    <div class="box-body" >
                      <p style="margin: 0;">
                        <a href="/tickets-view/view/closed" class="btn bg-olive btn-flat btn-sm ">View Closed Tickets</a>
                        <a href="/tickets-view/view/open" class="btn bg-olive btn-flat btn-sm ">View Open Tickets</a>
                        <div id="responseMsg"><?php echo $error = $function->getMessage(); ?></div>
                      </p>
                      <form action="" method="post" role="form" id="form" style="border:1px solid orange; padding:5% 5% 0 5%; margin-top:10px;" enctype="multipart/form-data" >
                        <!-- text input -->
                        <div class="row">
                          <div class="col-xs-6 form-group">
                            <label>Complaint Ticket <span>*</span></label>
                            <select class="form-control input-sm" name="job[complaint_id]" id="complaint" required>
                              <option value="">Select ...</option>
                              <?php $options = $function->getOpenTicketOptions();
                                foreach ($options as $option) {
                                  echo '
                                    <option value="'.$option['id'].'">'.$option['date'].' | '.$option['name'].' | '.$option['mobile'].' | '.$option['code'].' ('.$option['center'].')</option>
                                  ' ;
                                }
                              ?>
                            </select>
                          </div>
                          <div class="col-xs-6 form-group">
                            <label>Technician Name <span>*</span></label>
                            <input type="text" class="form-control input-sm" placeholder="Enter Name & Contact" name="job[attender_name]" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6 form-group">
                            <label>Work / Job Done <span>*</span></label>
                            <textarea class="form-control input-sm" placeholder="Enter Details" name="job[status_brief_internal]" rows="5" required="" pattern="[a-zA-Z0-9,- .].{2,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete details, Don\'t use special characters or  / (Slashes))' : '');" required=""></textarea>
                          </div>
                          <div class="col-xs-6 form-group">
                            <label>Note For Customer</label>
                            <textarea class="form-control input-sm" placeholder="Enter Note/Status (It will Be displayed on website)" name="job[status_brief_customer]" rows="5" pattern="[a-zA-Z0-9,- .].{2,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete details, Don\'t use special characters or  / (Slashes))' : '');"></textarea>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-xs-4 form-group has-warning">
                            <label>Type <span>*</span></label>
                            <select class="form-control input-sm status" id="type" name="job[type]" required>
                              <option value="">Select ...</option>
                              <option value="Onsite">Onsite</option>
                              <option value="Service Center">Service Center</option>
                              <option value="Canceled">Cancel</option>
                              <?php if($_SESSION['SESS__azz_level'] > 7) echo '<option value="Closed by Admin">Admin Force Close</option>'; ?>
                            </select>
                          </div>
                          <section id="optionSection"></section>
                          <section id="tatSection"></section>
                        </div>
                        <div class="box-footer">
                          <input type="hidden" name="ajax" value="addJob">
                          <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                          <div class="col-xs-4">&nbsp;</div>
                          <div class="col-xs-4"> <button type="submit" id="processBtn" class="btn btn-success btn-flat btn-block">Save</button></div>
                        </div>
                      </form>
                    </div>
                  </section>
                </div><!-- /.nav-tabs-custom -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <?php pageFooter(); ?>
      </div><!-- ./wrapper -->
      <?php pageJsInclude($page);?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
      <script type="text/javascript">
          $(function() {
            <?php
              if (isset($_GET['var'])) {
                $ticketId = (int) $_GET['var'];
                echo "$('#complaint').val('$ticketId');";
              }
            ?>
          $('#complaint').select2();
          });
      </script>
      <script type="text/javascript">
        var redirect_from = '<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI']; ?>';
        redirect_from = ('http://www.indocrm.space/tickets-view/open' === redirect_from) ? redirect_from : '/jobs-new';
        $( ".status" ).change(function() {
          if ($(this).val() == '1') {
            $('.tat').attr('required', false);
            $('#tatReq').html('');
          }else{
            $('.tat').attr('required', true);
            $('#tatReq').html('*');
          }
        });
        $(function(){
          $(document).on('change', '#status' ,function(event) {
            var status = $(this).val();
            if (status === '0') {
              $('#tatSection').html('');
              $('#tatSection').append(
                ' <div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label>Next TAT <span id="tatReq"></span></label>'+
                    '<input type="date" class="form-control input-sm tat" name="purchase_date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+7 day", time())); ?>"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>Priority</label>'+
                    '<select class="form-control input-sm" name="job[complaint_priority]">'+
                      '<option value="">Select ...</option>'+
                      '<option value="High">High</option>'+
                      '<option value="Medium">Medium</option>'+
                      '<option value="Low">Low</option>'+
                    '</select>'+
                  '</div>');
            }else{
              $('#tatSection').html('');
            }
          });

          $(document).on('change', '#billWarranty' ,function(event) {
            var bill = $(this).val();
            bill = bill.toLowerCase();
            if (bill == 'stock') {
              $('#purchase_date').attr('required', false);
              $('#purchase_date_req').html('Purchase Date');
            }else{
              $('#purchase_date').attr('required', true);
              $('#purchase_date_req').html('Purchase Date <span>*</span>');
            }
          });

          $(document).on('change', '#km_run' ,function(event) {
            var km_run = $(this).val();
            if (km_run === '0') {
              $('#otp').attr('required', false);
              $('#otp_req').html('OTP');
            }else{
              $('#otp').attr('required', true);
              $('#otp_req').html('OTP <span>*</span>');
            }
          });

          $('#type').change(function(event) {
            var type = $(this).val();
            if (type === 'Onsite') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>KM Run <span>*</span></label>'+
                    '<input type="number" class="form-control input-sm" ID="km_run" name="job[km_run]" min="0" max="200" step="0.01" placeholder="KM Run" required=""/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label id="otp_req">OTP <span>*</span></label>'+
                    '<input type="text" class="form-control input-sm" id="otp" name="otp" maxlength="4" pattern="[0-9]{4}"  placeholder="Customer OTP" required="" />'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Write STOCK if this is a piece from stock">'+
                    '<label>Bill/Warranty <span>*</span></label>'+
                    '<input type="text" class="form-control input-sm" name="job[bill]" min="0" max="200" step="0.01" placeholder="Bill/Warranty Card Number" id="billWarranty"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label id="purchase_date_req">Purchase Date <span>*</span></label>'+
                    '<input type="date" class="form-control input-sm" name="purchase_date" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>" id="purchase_date"/>'+
                  '</div>'+
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<label>Resolved <span>*</span></label>'+
                    '<select class="form-control input-sm status" id="status" name="job[status]" required>'+
                      '<option value="">Select ...</option>'+
                      '<option value="1">Close Now</option>'+
                      '<option value="0">Still Need Work</option>'+
                    '</select>'+
                  '</div>');
            }else if (type === 'Closed by Admin') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>KM Run </label>'+
                    '<input type="text" class="form-control input-sm" name="job[km_run]" min="0" max="200" step="0.01" placeholder="KM Run" />'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Write Stock if this is a piece from stock">'+
                    '<label>Bill/Warranty</label>'+
                    '<input type="text" class="form-control input-sm" name="job[bill]" min="0" max="200" step="0.01" placeholder="Bill/Warranty Card Number" id="billWarranty"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround Time">'+
                    '<label>Purchase Date</label>'+
                    '<input type="date" class="form-control input-sm" name="purchase_date" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>"/>'+
                  '</div>'+
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<label>Resolved <span>*</span></label>'+
                    '<select class="form-control input-sm status" id="status" name="job[status]" required>'+
                      '<option value="">Select ...</option>'+
                      '<option value="1">Close Now</option>'+
                      '<option value="0">Still Need Work</option>'+
                    '</select>'+
                  '</div>');
            }else if (type === 'Canceled') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<input type="hidden" value="2" class="form-control input-sm status" id="status" name="job[status]" required />'+
                  '</div>');
            }else if(type === 'Service Center'){
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#tatSection').append(
                ' <div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label>Next TAT <span id="tatReq"></span></label>'+
                    '<input type="date" class="form-control input-sm tat" name="tat" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+7 day", time())); ?>"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>Priority</label>'+
                    '<select class="form-control input-sm" name="job[complaint_priority]">'+
                      '<option value="">Select ...</option>'+
                      '<option value="High">High</option>'+
                      '<option value="Medium">Medium</option>'+
                      '<option value="Low">Low</option>'+
                    '</select>'+
                  '</div>');
            }else{
              $('#optionSection').html('');
              $('#tatSection').html('');
            }
          });
        });
        $(function() {
          $("#form").submit(function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              data: $("#form").serialize(),
              beforeSend : function(){
                $('#overlay').css({
                    'background': '#000',
                    'width': '100%',
                    'height': '100%',
                    'position': 'absolute',
                    'top': 0,
                    'left': 0,
                    'opacity': .6,
                    'display': 'block',
                    'zIndex': '1001'
                  });
              }
            })
            .done(function(message) {
              console.log(message);
              message = JSON.parse(message);
              if (message.status == 'success') {
                $('#form')[0].reset();
                $('#responseMsg').html('<div class="alert alert-success"><center>'+message.message+'</center></div>');
                setTimeout(function() {
                  window.location = redirect_from;
                }, 2000);
              }else{
                $('#responseMsg').html('<div class="alert alert-danger"><center>'+message.message+'</center></div>');
              }
            })
            .fail(function(message) {
              $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to submit form, Please Wait and retry</center></div>');
            })
            .always(function() {
              $('#overlay').removeAttr('style');
              $('#overlay').css('display', 'none');
            });
          });
        });
        <?php
          if (isset($_GET['perform'])) {
            echo '$("#complaint").val("'.$_GET['perform'].'")';
          }
        ?>
      </script>
    </body>
  </html>