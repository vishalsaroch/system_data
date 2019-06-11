<?php
$level = $function->checkLogin();
if ($level < 2) {
    header('Location: /error/404');
    exit;
}
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
                <div class="row"><center><?php echo $function->getAdminMessage(); ?></center></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box dark">
                            <header>
                                <div class="icons"><i class="icon-shopping-cart"></i></div>
                                <h5>Add New Brand</h5>
                                <div class="toolbar">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-th-large"></i> Masters
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/shoppo-admin?module=product&mode=add-master&type=new">Add New Product Master</a></li>
                                                <li><a href="/shoppo-admin?module=product&mode=add&type=new">Add New Product</a></li>
                                                <li><a href="/shoppo-admin?module=categories&mode=add-master&type=new">Add New Category</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li>
                                            <a href="#">
                                                <form name="form" action="" method="post" enctype="multipart/form-data">
                                                    <label for="uploadExcel" style="margin:0;">
                                                        <i class="icon-list-alt"></i> Upload Excel
                                                        <input type="file" id="uploadExcel" name="uploadExcel" class="" onchange="uploadExcelf(this.form);">
                                                    </label>
                                                    <input type="hidden" name="adminProcess" value="uploadExcel">
                                                </form>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </header>
                            <div id="div-1" class="accordion-body collapse in body">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-xs-6">
                                            <label for="category_id" class="control-label">Category</label>
                                            <select data-placeholder="Choose Category" id="category_id" name="product[category_id]" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="">Select...</option>
                                                <?php
                                                    $subsubcategories = $function->getArrayOptions_subSubcategories();
                                                    foreach ($subsubcategories as $category) {
                                                        echo '<option value="'.$category['subSubCatId'].'">'.$category['subSubCatTitle'].' - '.$category['catTitle'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="title" class="control-label">Title</label>
                                            <input type="text" id="title" name="product[title]" placeholder="Exe. Nike" title="Title of this product" class="form-control" maxlength="30"  required=""/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4 pull-right">
                                            <label for="submit" class="control-label"></label>
                                            <input type="hidden" name="adminProcess" value="addBrand">
                                            <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Brand"/>
                                        </div>
                                    </div>
                                </form>
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
