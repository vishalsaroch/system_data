<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

pageHeader('Your Personal Profile | '.CLIENT_TITLE, $page);
if (isset($_FILES['changeProfilePicture'])){
  $_SESSION['MSG'] = $function->upload_file($_FILES['changeProfilePicture'], 'images/users/', 'image') ? array('success', "Profile Picture successfully changed") : $_SESSION['MSG'];
}
$user = $function->employee_detail_array($userId);
$_SESSION['form'] = isset($_SESSION['form']) ? $_SESSION['form'] : $user ;
$formB = $_SESSION['form'];
unset($_SESSION['form']);
?>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php pageTopBar();?>
        <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar();?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $_SESSION['SESS__name']; ?>'s Profile
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
            <li class="active">View Profile</li>
          </ol>
        </section>
        <section class="content-header row">
          <div class="col-md-offset-3 col-md-6">
            <center><?php echo $error = $function->getMessage(); ?></center>
          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header">
                  &nbsp;
                </div>
                <div class="box-body no-padding">
                  <form action="" method="post" enctype="multipart/form-data">
                    <center><label data-toggle="tooltip" title="Click Picture to upload new profile Picture"><img src="/assets/images/users/<?php echo $_SESSION['SESS__user_id']; ?>.png" style="max-width:160px;border:5px ridge #F7F3F3;cursor:pointer"><input type="file" name="changeProfilePicture" accept=".jpg,.png" onchange="if(confirm('Are you sure to change profile picture ? (Only select `.jpg` pictures)')){submit();}else{return false;}" style="display:none"></label></center>
                  </form>
                </div><!-- /.box-body -->
                <div class="box-footer no-border">
                  &nbsp;
                </div>
              </div><!-- /. box -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">Official Details</h4>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <button class='btn btn-box-tool pull-right' data-toggle="tooltip" title="Minimize" data-widget='collapse'><i class='glyphicon glyphicon-minus'></i></button>
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a><i class="glyphicon glyphicon-credit-card text-olive"></i> Employee ID - <b><?php echo CLIENT_SHORT_NAME.$_SESSION['SESS__user'];?></b></a></li>
                    <li><a><i class="glyphicon glyphicon-user text-olive"></i> Designation - <b><?php echo $_SESSION['SESS__designation']; ?></b></a></li>
                    <li><a><i class="glyphicon glyphicon-star text-olive"></i> Center Code - <b><?php echo  $_SESSION['SESS__center_code']; ?></b></a></li>
                    <li><a><i class="glyphicon glyphicon-home text-olive"></i>  <?php echo $_SESSION['SESS__center']; ?></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h4 class="box-title">Personal Details</h4>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <button class='btn btn-box-tool pull-right' data-toggle="tooltip" title="Minimize" data-widget='collapse'><i class='glyphicon glyphicon-minus'></i></button>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding" id="msg-box" style="height:425px;">
                    <div class="box-body table-responsive">
                      <table class="table table-hover">
                        <tr>
                          <th>Contact Number</th>
                          <td><?php echo $user['mobile']; ?></td>
                        </tr>
                        <tr>
                          <th>Alternate Contact</th>
                          <td><?php echo $user['altMobile'] ? $user['altMobile'] : 'Not Provided'; ?></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><?php echo $user['email']; ?></td>
                        </tr>
                        <tr>
                          <th>Address</th>
                          <td><?php echo $user['address']; ?></td>
                        </tr>
                        <tr>
                          <th>City</th>
                          <td><?php echo $user['city'].' - '.$user['pin']; ?></td>
                        </tr>
                        <tr>
                          <th>Aadhar</th>
                          <td><?php echo $user['aadhar'] ? $user['aadhar'] : 'Not Provided'; ?></td>
                        </tr>
                        <tr>
                          <th>Pan</th>
                          <td><?php echo $user['pan'] ? $user['pan'] : 'Not Provided'; ?></td>
                        </tr>
                        <tr>
                          <th>Pan</th>
                          <td><?php echo $user['gstin'] ? $user['gstin'] : 'Not Provided'; ?></td>
                        </tr>
                        <tr>
                          <th>User Since</th>
                          <td><?php echo $user['time']; ?></td>
                        </tr>
                      </table>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer with-border">
                  <button class='btn btn-flat btn-mini btn-info pull-left' data-toggle="modal" data-target=".login-modal">Update Password</button>
                  <button class='btn btn-flat btn-mini btn-primary pull-right' data-toggle="modal" data-target=".update-modal">Update Personal</button>
                  <div class="fade update-modal modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <form action="" method="post" role="form" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                          <h4 class="modal-title">Update Personal Details</h4>
                        </div>
                        <div class="modal-body">
                          <!-- text input -->
                          <?php echo $error = $function->getMessage(); ?>
                          <div class="row">
                            <div class="col-xs-6 form-group">
                              <label>Mobile <span>*</span></label>
                              <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="phone1" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only 10 Digit numbers, Without leading +91 or 0' : '');" title="Please Enter Correct 10 Digit Mobile Number, with STD code and without - or +" data-toggle="tooltip" value="<?php echo $user['mobile']; ?>"  required/>
                            </div>
                            <div class="col-xs-6 form-group">
                              <label>Alternate Contact</label>
                              <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="phone2" pattern="[0-9]{10,15}" maxlength="15" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Alternate Contact numbers, with STD code and Without leading +91' : '');" title="Please Enter Correct Number, with STD code and without - or +" data-toggle="tooltip"  value="<?php echo $user['altMobile']; ?>" required/>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-6 form-group">
                              <label>Email <span>*</span></label>
                              <input type="email" name="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $user['email']; ?>" maxlength="50"/>
                            </div>
                            <div class="col-xs-6 form-group">
                              <label>Address </label>
                              <textarea class="form-control input-sm" placeholder="Address" name="address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="1"><?php echo $user['address']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-6 form-group">
                              <label>Pincode <span>*</span></label>
                              <input type="text" class="form-control input-sm" id="pin" name="city_pin" maxlength="6" minlength="6" pattern="[0-9]{6}" placeholder="Pin Code" value="<?php echo $user['pin']; ?>" required/>
                            </div>
                            <div class="col-xs-6 form-group">
                              <label>City <span>*</span></label>
                              <input type="text" class="form-control input-sm" id="centerCity" placeholder="City Name" name="city" maxlength="100" readonly="" required="" value="<?php echo $user['city']; ?>" />
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-4 form-group">
                              <label>AADHAR</label>
                              <input type="text" title="Enter AADHAR number" class="form-control input-sm numberInput" pattern="[0-9 ]{14}" maxlength="14"  name="aadhar" placeholder="Aadhar Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');" value="<?php echo $user['aadhar']; ?>" />
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>PAN</label>
                              <input type="text" title="Enter PAN number" class="form-control input-sm" pattern="[0-9a-zA-Z]{10}" maxlength="10" minlength="10" name="pan" placeholder="Pan Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');" value="<?php echo $user['pan']; ?>" />
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>GST no.</label>
                              <input type="text" title="Enter GST number" class="form-control input-sm" pattern="[0-9a-zA-Z -_,.]{4,20}" maxlength="20" minlength="4" name="gstin" placeholder="GST Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct GST Number' : '');" value="<?php echo $user['gstin']; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="process" value="updateCenterCumUser">
                          <input type="reset" class="btn btn-default btn-flat btn-sm pull-left" value="Reset">
                          <button type="submit" class="btn btn-success btn-flat btn-sm">Save Center</button>
                        </div>
                      </form>
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <div class="fade login-modal modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                     <form action="" method="post" enctype="multipart/form-data" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);this.opassword.value = login_hash(this.opassword.value);">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                          <h4 class="modal-title">Update Password</h4>
                        </div>
                        <div class="modal-body">
                          <?php echo $error; ?>
                          <table class="table table-hover">
                            <tr>
                              <td id="passwordField">
                                <div style="width:50%;padding-right:5px;float:left">
                                  <input type="password" name="password" class="form-control" maxlength="128" placeholder="New Password" id="inputFirst" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter' : ''); if(this.checkValidity()) form.inputLast.pattern=this.value;" required/>
                                </div>
                                <div style="width:50%;padding-left:5px;float:left">
                                  <input type="password" name="cpassword" class="form-control" maxlength="128" placeholder="Confirm Password" id="inputLast" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" required/>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><input type="password" name="opassword" class="form-control" onchange="this.setCustomValidity(this.patternMismatch ? 'Please Enter your currrent password' : '');" maxlength="128" placeholder="Current Password" required/></td>
                            </tr>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="process" value="udatePassword">
                          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-success btn-flat" onclick="upformhash(this.form, this.form.pass, this.form.password, this.form.password2);">Change</button>
                        </div>
                      </div><!-- /.modal-content -->
                     </form>
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
            <?php pageFooter();
        ?>
      </div><!-- ./wrapper -->
      <script type="text/javascript" src="includes/js/sha512.js"></script>
      <?php pageJsInclude('users');?>
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
        });
        $('.numberInput').on("keyup", function() {
            this.value = this.value.replace(/ /g,"");
            this.value = this.value.replace(/\B(?=(\d{4})+(?!\d))/g, " ");
        });
      </script>
  </body>
</html>