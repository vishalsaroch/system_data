<?php
$level = $function->checkLogin();
if ($level < 8) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

if (isset($_GET['deletepartner'])) {
  $id = (int) $_GET['deletepartner'];
  $function->delete_partner($id);
  echo '<script>window.location = "/partners.html";</script>';
  exit;
}
pageHeader('View & Modify Partners | '.CLIENT_TITLE, $page);
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
            <a href="/centers.html?newCenter" class="btn bg-olive btn-flat btn-sm ">+ Center</a>
            <a href="#newPartner" data-toggle="modal" class="btn bg-olive btn-flat btn-sm ">+ Partner</a>
            All Partners Details
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Partners</li>
              <li class="active">Details </li>
          </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>
          <div class="modal" id="newPartner">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/process.html" method="post" role="form" onsubmit="regformhash(this.form, this.form.password, this.form.password2);">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                    <h4 class="modal-title">Add Partner</h4>
                  </div>
                  <div class="modal-body">
                      <!-- text input -->
                      <?php echo $error = $function->getMessage(); ?>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Partner Company Name <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Designation Name" name="name" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" required/>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                            <label>Date Of Join <span>*</span></label>
                            <input type="text" class="form-control input-sm" name="doj" maxlength="10" pattern="(1[89][0-9][0-9]|20[01][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" onfocus="this.type = 'date';" onblur="this.type = 'text';" placeholder="YYYY-MM-DD" max="<?php echo date('Y-m-d'); ?>" required/>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Phone <span>*</span></label>
                          <input type="tel" class="form-control input-sm" placeholder="Phone Number" name="phone" pattern="[0-9]{7,15}" maxlength="15" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only numbers, Without leading +91 or 0' : '');" title="Please Enter Correct Phone Number, with STD code and without - or +" data-toggle="tooltip" required/>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Email</label>
                          <input type="email" name="regEmail" class="form-control input-sm" placeholder="Email Address" maxlength="50"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Address <span>*</span></label>
                            <textarea class="form-control input-sm" placeholder="Address" name="address" pattern="[a-zA-Z0-9,- .].{10,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 50 Characters (only - , . allowed)' : '');" rows="3" required></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="process" value="addPartner">
                    <input type="reset" class="btn btn-default btn-flat btn-sm pull-left" value="Reset">
                    <button type="submit" class="btn btn-success btn-flat btn-sm">Save Partner</button>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Joined On</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $partners = $function->get_partners_array();
                          foreach ($partners as $partner) {
                            echo '<tr>
                                    <td>'.$partner['name'].'</td>
                                    <td><a href="tel:'.$partner['phone'].'">'.$partner['phone'].'</a></td>
                                    <td><a href="mailto:'.$partner['email'].'">'.$partner['email'].'</a></td>
                                    <td>'.$partner['doj'].'</td>
                                    <td>'.$partner['city'].'</td>
                                    <td style="max-width:200px;">'.$partner['address'].'</td>
                                    <td>
                                       <center><a href="#" class="performAction" id="/partners/deletepartner/'.$partner['id'].'.html" title="Delete partner"><i class="glyphicon glyphicon-trash"></i></a></center>
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
        if (isset($_GET['newPartner'])) {
          echo '$("#newPartner").modal("show");';
        }
      ?>
    </script>
  </body>
</html>