<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
 $user = $function->getDetail_user($_SESSION['SESS__user']); ?>
<div class="inner">
    <div class="col-md-4">
      <div class="box box-solid">
        <div class="box-header"> &nbsp; </div>
        <div class="box-body no-padding">
          <form action="" method="post" enctype="multipart/form-data" class="ajax-form">
            <center>
              <label data-toggle="tooltip" title="Click Picture to upload new profile Picture">
                <img src="<?php echo "/assets/images/users/$_SESSION[SESS__user_id].png?".time(); ?>" style="max-width:160px;border:5px ridge #F7F3F3;cursor:pointer">
                <input type="file" name="changePic" accept=".jpg,.png" onchange="if(confirm('Are you sure to change profile picture ? (Only select `.jpg` or `jpeg` pictures)')){submit();}else{return false;}" style="display:none;">
                <input type="hidden" name="adminAjax" value="updateProfile">
              </label>
            </center>
          </form>
        </div><!-- /.box-body -->
        <div class="box-footer no-border"> &nbsp; </div>
      </div><!-- /. box -->
      <div class="panel panel-success">
        <div class="panel-heading">
            <i class="icon-home"></i> Official Details
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills nav-stacked">
                <li><a><i class="glyphicon glyphicon-credit-card"></i> Employee ID - <b><?php echo $user['code'];?></b></a></li>
                <li><a><i class="glyphicon glyphicon-user"></i> Designation - <b><?php echo $_SESSION['SESS__designation']; ?></b></a></li>
                <li><a><i class="glyphicon glyphicon-star"></i> Center Code - <b><?php echo  $_SESSION['SESS__center_code']; ?></b></a></li>
                <li><a><i class="glyphicon glyphicon-home"></i>  <?php echo $_SESSION['SESS__center']; ?></a></li>
                <li><a><i class="glyphicon glyphicon-time"></i> User Since - <?php echo $user['time']; ?></a></li>
            </ul>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <button type="button" class="btn btn-flat btn-info btn-block pull-left" data-toggle="modal" data-target=".login-modal">Update Password</button>
    </div><!-- /.col -->
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="icon-user"></i> Personal Details
            </div>
            <form class="ajax-form panel-body" id="changePersonal-form">
                <table class="table table-hover">
                    <tr>
                      <th>Contact Number</th>
                      <td><input type="text" name="form[mobile]" disabled="disabled" required="" value="<?php echo $user['mobile']; ?>" class="form-control allInput"></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><input type="text" name="form[email]" disabled="disabled" required="" value="<?php echo $user['email']; ?>" class="form-control allInput"></td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td><input type="text" name="form[address]" disabled="disabled" required="" value="<?php echo $user['address']; ?>" class="form-control addressInput"></td>
                    </tr>
                    <tr>
                      <th>City</th>
                      <td><input type="text" disabled="disabled" required="" value="<?php echo "$user[city], $user[district], $user[state] - $user[city_pin]"; ?>" class="form-control addressInput"></td>
                    </tr>
                    <tr>
                      <th>Aadhar</th>
                      <td><input type="text" name="form[aadhar]" disabled="disabled" required="" value="<?php echo $user['aadhar'] ? $user['aadhar'] : 'Not Provided'; ?>" class="form-control allInput"></td>
                    </tr>
                    <tr>
                      <th>Pan</th>
                      <td><input type="text" name="form[pan]" disabled="disabled" required="" value="<?php echo $user['pan'] ? $user['pan'] : 'Not Provided'; ?>" class="form-control allInput"></td>
                    </tr>
                    <?php
                      if (($level == 4) || ($level >= 8)) {
                        ?>
                        <tr>
                          <th>Center GSTIN</th>
                          <td><input type="text" name="form[gstin]" disabled="disabled" required="" value="<?php echo $user['gstin'] ? $user['gstin'] : 'Not Provided'; ?>" class="form-control allInput"></td>
                        </tr>
                        <tr>
                          <th>Center Contact</th>
                          <td><input type="text" name="form[phone1]" disabled="disabled" required="" value="<?php echo $user['phone1']; ?>" class="form-control allInput"></td>
                        </tr>
                        <tr>
                          <th>Center Contact 2</th>
                          <td><input type="text" name="form[phone2]" disabled="disabled" required="" value="<?php echo $user['phone2']; ?>" class="form-control allInput"></td>
                        </tr>
                        <tr>
                          <th>Center Email</th>
                          <td><input type="text" name="form[cenEmail]" disabled="disabled" required="" value="<?php echo $user['cenEmail']; ?>" class="form-control allInput"></td>
                        </tr>
                        <tr>
                          <th>Center Address</th>
                          <td><input type="text" name="form[cenAddress]" disabled="disabled" required="" value="<?php echo $user['cenAddress']; ?>" class="form-control addressInput"></td>
                        </tr>
                        <?php
                      }
                    ?>
                </table>
                <div id="update-buttons">
                  <button id="updateButton" type="submit" class="btn btn-flat btn-success pull-right">Update Personal Info</button>
                </div>
            </form>
        </div><!-- /.box-body -->
        <div class="box-footer with-border">
          <div class="fade login-modal modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
             <form action="" id="changePass-form" class="ajax-form" method="post" enctype="multipart/form-data" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);this.opassword.value = login_hash(this.opassword.value);">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                  <h4 class="modal-title">Update Password</h4>
                </div>
                <div class="modal-body">
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
                  <input type="hidden" name="adminAjax" value="updateProfile">
                  <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success btn-flat">Change</button>
                </div>
              </div><!-- /.modal-content -->
             </form>
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>
      </div><!-- /. box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<template id="update-buttons-temp">
  <button id="updateButton" type="submit" class="btn btn-flat btn-success pull-right">Update Personal Info</button>
</template>
<script>
  $(function(){
    $("#content").on("click", "#updateButton", function(event) {
      $(".addressInput").parent().parent().hide();
      $(".allInput").attr('disabled', false).removeAttr('disabled');
      $("#update-buttons").html(
        '<input type="hidden" name="process" value="updateCenterCumUser">'+
        '<button type="reset"  class="btn btn-flat btn-default pull-left">Reset</button>'+
        '<button type="submit" class="btn btn-flat btn-success pull-right">Save Changes</button>'
      );
    });
  });
</script>