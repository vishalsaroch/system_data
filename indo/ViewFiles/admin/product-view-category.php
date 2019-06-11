<?php
$level = $function->checkLogin();
if ($level < 2) {
    header('Location: /error/404');
    exit;
}
$start = isset($_GET['start']) ? (int) $_GET['start'] : 0;
$catId = isset($_GET['type']) ? (int) $_GET['type'] : 1;
$title = "Add New Product | ".CLIENT_TITLE.' Administration ';
PageHead($title);
    ?>
    <style type="text/css">
        .form-horizontal .form-group {
            margin-right: 0;
            margin-left: 0;
        }
    </style>
<body class="padTop53 " >
       <!-- MAIN WRAPPER -->
    <div id="wrap">
        <?php
            PageTopBar();
            PageLeftNavBar(); ?>
       <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row"><center><?php echo  $function->getAdminMessage(); ?></center></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box dark">
                            <header>
                                <div class="icons"><i class="icon-shopping-cart"></i></div>
                                <h5>View Category-wise Product</h5>
                                <div class="toolbar">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-th-large"></i> Masters
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/shoppo-admin?module=product&mode=add-master&type=new">Add New Product Master</a></li>
                                                <li><a href="/shoppo-admin?module=product&mode=add-brand&type=new">Add New Brand</a></li>
                                                <li><a href="/shoppo-admin?module=categories&mode=add-master&type=new">Add New Category</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <form name="form" action="" method="post" enctype="multipart/form-data">
                                                    <label for="uploadExcel" style="margin:0;">
                                                        <i class="icon-list-alt"></i> Upload Excel
                                                        <input type="file" id="uploadExcel" name="uploadExcel" class="sr-only" onchange="uploadExcelf(this.form);">
                                                    </label>
                                                    <input type="hidden" name="adminProcess" value="uploadExcel">
                                                </form>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </header>
                            <div id="div-1" class="accordion-body collapse in body">
                                <table id="table" class="table table-hover table-responsive">
                                    <tr>
                                        <th>SKU</th>
                                        <th>Title</th>
                                        <th>Brand</th>
                                        <th>Center</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                    </tr>
                                    <?php
                                        $products = $function->getArray_products('m.ul_category_id', $catId, $start, 1000);
                                        foreach ($products as $product) {
                                            echo '
                                                <tr>
                                                    <td>'.$product['sku'].'</td>
                                                    <td>'.$product['title'].'</td>
                                                    <td>'.$product['brand'].'</td>
                                                    <td>'.$product['center'].'</td>
                                                    <td>'.$product['price'].'</td>
                                                    <td>'.$product['discount'].'</td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
        <!-- END PAGE CONTENT -->
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!--END MAIN WRAPPER -->
    <?php
        pageFooter();
        PageJsInclude();
    ?>
    <script type="text/javascript">
        function uploadExcelf(form){
            if (confirm('Are you sure to upload these products via selected excel')) {
                form.submit();
            }else{
                return false;
            }
        }
    </script>
</body>
     <!-- END BODY -->
</html>
