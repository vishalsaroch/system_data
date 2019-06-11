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
if ($varName == 'blockProduct') {
  $ProductsId = (int) $varVal;
  $function->updateData_productStatus($ProductsId, 0);
  echo '<script>window.history.pushState("", "", "/Products");</script>';
}elseif ($varName == 'unblockProduct') {
  $ProductsId = (int) $varVal;
  $function->updateData_productStatus($ProductsId, 1);
  echo '<script>window.history.pushState("", "", "/Products");</script>';
}

pageHeader('View All Products | '.CLIENT_TITLE, $page);
?>
  <style type="text/css">
    .glyphicon-ban-circle{color: #f3a23a;}
    .glyphicon-trash{color: red;}
    .glyphicon-ok{color: green;}
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
            <a href="#newProduct" data-toggle="modal" class="btn bg-olive btn-flat btn-sm ">+ Product</a>
            All Products Details
          </h1>
          <ol class="breadcrumb">
              <li><i class="glyphicon glyphicon-compressed"></i> Products</li>
              <li class="active">Products </li>
          </ol>
          </section>
          <section class="content-header">
            <div class="col-md-offset-3 col-md-6"></div>
          </section>
          <div class="modal" id="newProduct">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="" method="post" role="form">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                    <h4 class="modal-title">Add Product</h4>
                  </div>
                  <div class="modal-body">
                      <!-- text input -->
                      <?php echo $error = $function->getMessage(); ?>
                      <div class="row">
                        <div class="col-xs-12 form-group">
                          <label>Product Name <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Product Name" name="name" pattern="[a-zA-Z0-9., -]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 50, only . - , allowed' : '');" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label>Warranty <span>*</span></label>
                          <input type="number" class="form-control input-sm" placeholder="In Months" name="warranty" min="0" max="255" required/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>Model <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Product Model" name="variant" pattern="[a-zA-Z0-9., -]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Product variant/Model (Only Alphabets), Minimum 2 & Maximum 50, only . - , allowed' : '');" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label>Product Code <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Product Code" name="code" pattern="[a-zA-Z0-9]{2,20}" maxlength="20" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Product Code (Only Alphabets), Minimum 2 & Maximum 20 allowed' : '');" required/>
                        </div>
                        <div class="col-xs-6 form-group">
                          <label>Category <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Exe. Celing Fan" name="category" pattern="[a-zA-Z0-9., -]{2,20}" maxlength="20" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 20, only . - , allowed' : '');" required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 form-group">
                            <label>Description <span>*</span></label>
                            <textarea class="form-control input-sm" placeholder="Description" name="description" pattern="[a-zA-Z0-9,- .]{1,200}" maxlength="200" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter product description, Maximum 200 Characters (only - , . allowed)' : '');" rows="3" required></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="process" value="addProduct">
                    <input type="reset" class="btn btn-default btn-flat btn-sm pull-left" value="Reset">
                    <button type="submit" class="btn btn-success btn-flat btn-sm">Save Product</button>
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
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Model</th>
                        <th>Warranty</th>
                        <th>Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $products = $function->get_products_array(true);
                          foreach ($products as $product) {
                            echo '<tr title="'.$product['description'].'">
                                    <td>'.$product['id'].'</td>
                                    <td>'.$product['category'].'</td>
                                    <td>'.$product['product'].'</td>
                                    <td>'.$product['variant'].'</td>
                                    <td>'.$product['warranty'].'</td>
                                    <td>'.$product['code'].'</td>
                                    <td>
                                       <center>
                                          '.(($product['status'] == 1) ?
                                             '<a href="#" class="performAction" action="Block Product #'.$product['id'].'" id="/products/'.$product['id'].'/blockProduct" title="Block Product"><i class="glyphicon glyphicon-ban-circle"></i></a>' :
                                             '<a href="#" class="performAction" action="Unblock Product #'.$product['id'].'" id="/products/'.$product['id'].'/unblockProduct" title="Unlock Product"><i class="glyphicon glyphicon-ok-circle"></i></a>').'
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
      $('.performAction').click(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        if (confirm('Are you sure to '+action+' ?')) {
          window.location = $(this).attr('id');
        }
      });
      <?php
        if (isset($_GET['newProduct'])) {
          echo '$("#newProduct").modal("show");';
        }
      ?>
    </script>
  </body>
</html>