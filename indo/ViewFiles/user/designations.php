<?php
require_once 'cimages/page_include_100lution.php';
require_once 'cimages/functions_100lution.php';
$page = 'employee-all';
$centerId = (int) $_SESSION['s_center_id'];
if ($function->check_login() > 5) {
    if (isset($_GET['deletedesignation'])) {
      $id = (int) $_GET['deletedesignation'];
      $function->delete_designation($id);
      echo '<script>window.location = "/designations.html";</script>';
      exit;
    }
    pageHeader('View & Modify Designations | '.CLIENT_TITLE, $page);
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
            <a href="#newDesignation" data-toggle="modal" class="btn bg-olive btn-flat btn-sm ">+ Designation</a>
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
          <div class="modal" id="newDesignation">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/process.html" method="post" role="form" onsubmit="regformhash(this.form, this.form.password, this.form.password2);">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                    <h4 class="modal-title">Add Designation/Role</h4>
                  </div>
                  <div class="modal-body">
                      <!-- text input -->
                      <?php echo $error = $function->getMessage(); ?>
                      <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                          <label>Designation Name <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Designation Name" name="designation" pattern="[a-zA-Z0-9. ]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 50 and no special Characters' : '');" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                          <label>Designation Level <span>*</span></label>
                          <input type="number" class="form-control input-sm" placeholder="Designation Level" name="level" min="1" max="250" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                          <label>Work Description</label>
                          <textarea class="form-control input-sm" placeholder="Enter Details" name="details" maxlength="200" rows="4"></textarea>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="process" value="addDesignation">
                    <input type="reset" class="btn btn-default btn-flat btn-sm pull-left" value="Reset">
                    <button type="submit" class="btn btn-success btn-flat btn-sm">Save Designation</button>
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
                        <th>Designation</th>
                        <th>Level</th>
                        <th>Work Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $designations = $function->get_designation_array();
                          foreach ($designations as $designation) {
                            echo '<tr>
                                    <td>'.$designation['name'].'</td>
                                    <td>'.$designation['level'].'</td>
                                    <td>'.$designation['descr'].'</td>
                                    <td>
                                       <center><a href="#" class="performAction" id="/designations/deletedesignation/'.$designation['id'].'.html" title="Delete Designation"><i class="glyphicon glyphicon-trash"></i></a></center>
                                    </td>
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
    </script>
  </body>
</html>
    <?php
}else{
  header('Location: login');
  exit;
}