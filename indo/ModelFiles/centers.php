<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$varVal  = isset($_GET['var']) ? $_GET['var'] : '';
$varName  = isset($_GET['var2']) ? $_GET['var2'] : '';
if ($varName == 'resetCenter') {
  $centerId = (int) $varVal;
  $function->updateData_resetCenterUsersPassword($centerId);
  echo '<script>window.history.pushState("", "", "/centers");</script>';
}elseif ($varName == 'blockCenter') {
  $centerId = (int) $varVal;
  $function->updateData_centerUserStatus($centerId, 0);
  echo '<script>window.history.pushState("", "", "/centers");</script>';
}elseif ($varName == 'unblockCenter') {
  $centerId = (int) $varVal;
  $function->updateData_centerUserStatus($centerId, 1);
  echo '<script>window.history.pushState("", "", "/centers");</script>';
}
pageHeader('View & Modify Centers | '.CLIENT_TITLE, $page);
?>
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .glyphicon-ban-circle{color: red;}
      .glyphicon-refresh{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-ok-circle{color: green;}
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
            <a href="#newCenter" data-toggle="modal" class="btn bg-olive btn-flat btn-sm ">+ Center</a>
            All Partners Centers Details
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Centers</li>
              <li class="active">Details </li>
          </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>
          <div class="modal" id="newCenter">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="" method="post" role="form" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                    <h4 class="modal-title">Add Center</h4>
                  </div>
                  <div class="modal-body">
                      <!-- text input -->
                      <?php echo $error = $function->getMessage(); ?>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label>Center Name <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Center Name" name="name" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" required/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>Center Code <small>(Optional)</small></label>
                          <input type="text" class="form-control input-sm" placeholder="Center Code" name="code" pattern="[a-zA-Z0-9]{2,20}" maxlength="20" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Unique Code For Center (Only Alphabets and Numbers), Minimum 2 & Maximum 20 and no special Characters' : '');"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Date Of Join </label>
                            <input type="text" class="form-control input-sm" name="doj" maxlength="10" pattern="(1[89][0-9][0-9]|20[01][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" onfocus="this.type = 'date';" onblur="this.type = 'text';" placeholder="YYYY-MM-DD" max="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>Partner<span>*</span></label>
                          <select class="form-control input-sm" name="partner_id" required>
                            <?php
                              $partners = $function->getPartnerOptions();
                              foreach ($partners as $partner) {
                               echo '<option value="'.$partner['id'].'">'.$partner['partner'].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label>Mobile <span>*</span></label>
                          <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="phone1" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only 10 Digit numbers, Without leading +91 or 0' : '');" title="Please Enter Correct 10 Digit Mobile Number, with STD code and without - or +" data-toggle="tooltip" required/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>Email <span>*</span></label>
                          <input type="email" name="email" class="form-control input-sm" placeholder="Email Address" maxlength="50"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 form-group">
                          <label>Address </label>
                          <textarea class="form-control input-sm" placeholder="Address" name="address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label>Pincode <span>*</span></label>
                          <input type="text" class="form-control input-sm" id="pin" name="city_pin" maxlength="6" minlength="6" pattern="[0-9]{6}" placeholder="Pin Code" required/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>City <span>*</span></label>
                          <input type="text" class="form-control input-sm" id="centerCity" placeholder="City Name" name="city" maxlength="100" readonly="" required="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4 form-group">
                          <label>AADHAR</label>
                          <input type="text" title="Enter AADHAR number" class="form-control input-sm numberInput" pattern="[0-9 ]{14}" maxlength="14"  name="aadhar" placeholder="Aadhar Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                        </div>
                        <div class="col-xs-4 form-group">
                          <label>PAN</label>
                          <input type="text" title="Enter PAN number" class="form-control input-sm" pattern="[0-9a-zA-Z]{10}" maxlength="10" minlength="10" name="pan" placeholder="Pan Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                        </div>
                        <div class="col-xs-4 form-group">
                          <label>GST no.</label>
                          <input type="text" title="Enter GST number" class="form-control input-sm" pattern="[0-9a-zA-Z -_,.]{4,20}" maxlength="20" minlength="4" name="gstin" placeholder="GST Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct GST Number' : '');"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group has-success">
                          <label>Password <span>*</span></label>
                          <input type="password" class="form-control" id="reg_password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter' : ''); if(this.checkValidity()) form.cpassword.pattern=this.value;" placeholder="Password*" required="" />
                        </div>
                        <div class="col-xs-6 form-group has-success">
                          <label>Confirm Password <span>*</span></label>
                          <input type="password" class="form-control" id="reg_confirm-password" name="cpassword" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" placeholder="Confirm Password*" required="" />
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="process" value="addCenterCumUser">
                    <input type="reset" class="btn btn-default btn-flat btn-sm pull-left" value="Reset">
                    <button type="submit" class="btn btn-success btn-flat btn-sm">Save Center</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box"  style="overflow:auto;">
                <div class="box-body">
                  <?php echo $error; ?>
                  <table id="employees" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Code#</th>
                        <th>User & Center</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Joined On</th>
                        <th>City (Pin)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $centers = $function->get_centers_array();
                          foreach ($centers as $center) {
                            echo '<tr title="'.$center['address'].'">
                                    <td>'.$center['code'].'</td>
                                    <td>'.$center['user'].'<br>'.$center['name'].'</td>
                                    <td><a href="tel:'.$center['phone1'].'">'.$center['phone1'].'</a></td>
                                    <td><a href="mailto:'.$center['email'].'">'.$center['email'].'</a></td>
                                    <td>'.$center['doj'].'</td>
                                    <td>'.$center['city'].' ('.$center['pin'].')</td>
                                    <td>
                                       <center>
                                          <a href="#" class="performAction" action="Reset Center Passowrd of #'.$center['id'].'" id="/centers/'.$center['id'].'/resetCenter" title="Reset center password to Sonuu1"><i class="glyphicon glyphicon-refresh"></i></a>
                                          &nbsp; &nbsp;
                                          '.(($center['status'] == 1) ?
                                             '<a href="#" class="performAction" action="Block Center #'.$center['id'].'" id="/centers/'.$center['id'].'/blockCenter" title="Block center"><i class="glyphicon glyphicon-ban-circle"></i></a>' :
                                             '<a href="#" class="performAction" action="Unblock Center #'.$center['id'].'" id="/centers/'.$center['id'].'/unblockCenter" title="Unlock center"><i class="glyphicon glyphicon-ok-circle"></i></a>').'
                                        </center>
                                    </td>
                                  </tr>';
                          }

                      ?>
                    </tbody>

                  </table>
                  <div class="modal" id="partnerDetailModal">
                    <div class="modal-dialog">
                      <div class="modal-content" id="partnerDetails">
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
      function getCityFromPin(pin){
        var value = true;
        $.ajax({
          type:'POST',
          async: false,
          data:{
              'pin' : pin,
              'ajax' : 'findCity'
          }
        })
        .done(function(city) {
          value = city;
        })
        .fail(function() {
          value = false;
        });
        return value;
      }
      $(function(){
        $('#pin').keyup(function(){
          qstring = $(this).val();
          if (qstring.length == 6) {
            var cityName = getCityFromPin(qstring);
            console.log(cityName);
            cityName = JSON.parse(cityName);
            cityName = cityName[0].district;
            if (cityName) {
              $("#centerCity").val(cityName);
            }else{
              $("#centerCity").val('');
            }
          }else{
            $("#centerCity").val('');
          }
        });

        $('.content').on('click' ,'.performAction', function(e) {
          e.preventDefault();
          var action = $(this).attr('action');
          if (confirm('Are you sure to '+action+' ?')) {
            window.location = $(this).attr('id');
          }
        });

        $('.numberInput').on("keyup", function() {
            this.value = this.value.replace(/ /g,"");
            this.value = this.value.replace(/\B(?=(\d{4})+(?!\d))/g, " ");
        });
      });
    </script>
    <script type="text/javascript">
      <?php
        if (isset($_GET['newCenter'])) {
          echo '$("#newCenter").modal("show");';
        }
      ?>
    </script>
  </body>
</html>