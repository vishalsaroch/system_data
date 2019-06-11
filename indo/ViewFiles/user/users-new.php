<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

pageHeader('Add New CRM User | '.CLIENT_TITLE, $page);
?>
    <style type="text/css">
      label{
        font-size: 12px;
      }
    </style>
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
              New Employee Joining
            </h1>
            <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Employee</li>
              <li class="active">Join New</li>
            </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class='row'>
              <div class='col-xs-12'>
                <div class="nav-tabs-custom">
                  <section id="new">
                    <div class="box-body" >
                      <p style="margin: 0;">
                        <a href="/centers" data-toggle="modal" class="btn bg-olive btn-flat btn-sm ">+ Center</a>
                        <?php echo $error = $function->getMessage(); ?>
                      </p>
                      <form action="" method="post" role="form" style="border:1px solid orange; padding:5% 5% 0 5%; margin-top:10px;" enctype="multipart/form-data" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);">
                        <!-- text input -->
                        <div class="row">
                          <div class="col-sm-12 col-xs-12 form-group">
                            <label>Full Name <span>*</span></label>
                            <input type="text" class="form-control input-sm" placeholder="Enter Name of Staff" name="name" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 4 & Maximum 100 and no special Characters' : '');" required/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Mobile <span>*</span></label>
                            <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for login" data-toggle="tooltip" required/>
                          </div>
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Email <span>*</span></label>
                            <input type="email" name="email" class="form-control input-sm" placeholder="Email Address" maxlength="50"/>
                          </div>
                        </div>
                        <input type="hidden" name="father" value="">
                        <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>AADHAR</label>
                            <input type="text" title="Enter AADHAR number" class="form-control input-sm aadharInput" pattern="[0-9 ]{14}" maxlength="14"  name="aadhar" placeholder="Aadhar Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                          </div>
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label> Upload 1</label>
                            <input type="file" title="JPEG/JPG/PNG format pic max 200 KB" class="form-control input-sm"  name="upload1" accept="image/jpeg, image/png" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>PAN</label>
                            <input type="text" title="Enter PAN number" class="form-control input-sm" pattern="[0-9a-zA-Z]{10}" maxlength="10" minlength="10" name="pan" placeholder="Pan Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                          </div>
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label> Upload 2</label>
                            <input type="file" title="JPEG/JPG/PNG format pic max 200 KB" class="form-control input-sm"  name="upload2" accept="image/jpeg, image/png" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-xs-12 form-group">
                            <label>Address</label>
                            <textarea class="form-control input-sm" placeholder="Address" name="address" pattern="[a-zA-Z0-9,- .].{10,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 50 Characters (only - , . allowed)' : '');" rows="3"></textarea>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-xs-6 col-lg-3 form-group has-success">
                            <label>Center City <span>*</span></label>
                            <select class="form-control input-sm" id="centerCity" required>
                              <option value="">Select ...</option>
                            </select>
                          </div>
                          <div class="col-xs-6 col-lg-3 form-group has-success">
                            <label>Center <span>*</span></label>
                            <select class="form-control input-sm" name="center_id" id="center" required>
                              <option value="">Select ...</option>
                            </select>
                          </div>
                          <div class="col-xs-6 col-lg-3 form-group has-success">
                            <label>Password <span>*</span></label>
                            <input type="password" class="form-control" id="reg_password" name="password" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters' : ''); if(this.checkValidity()) form.cpassword.pattern=this.value;" placeholder="Password*" required="" />
                          </div>
                          <div class="col-xs-6 col-lg-3 form-group has-success">
                            <label>Confirm Password <span>*</span></label>
                            <input type="password" class="form-control" id="reg_confirm-password" name="cpassword" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" placeholder="Confirm Password*" required="" />
                          </div>
                        </div>
                        <div  class="row" id="extraFieldsH"></div>
                        <div class="box-footer">
                          <input type="hidden" name="process" value="addUser">
                          <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                          <div class="col-xs-4">&nbsp;</div>
                          <div class="col-xs-4"> <button type="submit" class="btn btn-success btn-flat btn-block" onclick="regformhash(this.form, this.form.password, this.form.password2);">Save</button></div>
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
      <script type="text/javascript">
        $(function(){
          var centers = <?php $centers = $function->getCenterOptions(); echo json_encode($centers); ?>

          $.each(centers, function(key, value) {
              $("#centerCity").append('<option value="' + value.city + '">' + value.city + '</option>');
          });

          $("#centerCity").change(function(event) {
            centerCity = $(this).val();
            center = centers.filter(function (center) { return center.city == centerCity });
            $("#center").html('<option value="">Select ...</option>');
            $.each(center, function(key, value) {
              $("#center").append('<option value="' + value.id + '">' + value.center + '(' + value.code + ')</option>');
            });
          });
        });
      </script>
    </body>
  </html>