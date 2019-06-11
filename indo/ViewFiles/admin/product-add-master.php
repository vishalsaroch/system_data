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
                                <h5>Add New Product Master</h5>
                                <div class="toolbar">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-th-large"></i> Masters
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/shoppo-admin?module=product&mode=add&type=new">Add New Product</a></li>
                                                <li><a href="/shoppo-admin?module=product&mode=add-brand&type=new">Add New Brand</a></li>
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
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-xs-6">
                                            <label for="category_id" class="control-label">Category</label>
                                            <select data-placeholder="Choose Category" id="category_id" name="master[category_id]" class="form-control chzn-select" tabindex="2" required="">
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
                                            <label for="brand_id" class="control-label">Product Brand</label>
                                            <select data-placeholder="Choose Product Master" id="brand_id" name="master[brand_id]" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="" data-title="select an option">Select...</option>
                                                <?php
                                                    $brands = $function->getArrayOptions_productBrands();
                                                    foreach ($brands as $brand) {
                                                        echo '<option value="'.$brand['brandId'].'">'.$brand['catTitle'].' - '.$brand['brandTitle'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group col-xs-4">
                                        <label for="product_master_id" class="control-label">Product Type</label>
                                        <select data-placeholder="Choose Product Master" id="product_master_id" name="product_master_id" class="form-control chzn-select" tabindex="2" required="">
                                            <option value="Same">Same Product</option>
                                            <option value="Variants">Its Variant</option>
                                        </select>
                                    </div> -->
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="sku" class="control-label">Product SKU</label>
                                            <input type="text" id="sku" name="master[sku]" placeholder="Unique Identifucation" title="unique identifiction for this product, you can use barcode" class="form-control"/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="product_id" class="control-label">Product ID</label>
                                            <input type="text" id="product_id" name="master[product_id]" placeholder="Unique Identifucation" title="unique identifiction for this product, you can use barcode" class="form-control"/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="title" class="control-label">Product Title</label>
                                            <input type="text" minlength="1" maxlength="200" id="title" name="master[title]" placeholder="Product Title" title="Title of this product" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="subtitle" class="control-label">Product SubTitle</label>
                                            <input type="text" minlength="1" maxlength="200" id="subtitle" name="master[subtitle]" placeholder="Product SubTitle" title="Sub title of this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="under_sale_badge" class="control-label">Under Sale</label>
                                            <select data-placeholder="Is this product under sale" id="under_sale_badge" name="master[under_sale_badge]" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="0" data-title="select an option">No</option>
                                                <option value="1" data-title="select an option">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="product_variants" class="control-label">Have Variants ?</label>
                                            <select data-placeholder="Is this product under sale" id="product_variants" name="master[product_variants]" multiple="multiple" class="form-control chzn-select" tabindex="2" >
                                                <option value="" data-title="select an option">No Variants</option>
                                                <option value="Size" data-title="select an option">Size</option>
                                                <option value="Weight" data-title="select an option">Weight</option>
                                                <option value="Color" data-title="select an option">Color</option>
                                                <option value="Units" data-title="select an option">Units</option>
                                                <option value="Storage" data-title="select an option">Storage</option>
                                                <option value="Specifications" data-title="select an option">Specifications</option>
                                                <option value="Other" data-title="select an option">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="product_variants_data" class="control-label">Variant Data (if have)</label>
                                            <input type="text" id="product_variants_data" name="product[product_variants_data]" placeholder="Ex. 8GB, Red, XL etc." title="Is this Product have variant" class="form-control" maxlength="10" />
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="handling" class="control-label">Handling</label>
                                            <select data-placeholder="Handling details" id="handling" name="master[handling]" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="Fragile" data-title="select an option">Fragile</option>
                                                <option value="Electronics" data-title="select an option">Electronics</option>
                                                <option value="Store in Cool" data-title="select an option">Store in Cool</option>
                                                <option value="Hot" data-title="select an option">Hot</option>
                                                <option value="Put Up Side" data-title="select an option">Put Up Side</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="handling" class="control-label">Suitable for</label>
                                            <select data-placeholder="Suitability Details" id="handling" name="master[suitability]" class="form-control chzn-select" multiple="multiple" tabindex="2">
                                                <option value="" data-title="select an option">NA</option>
                                                <option value="Men" data-title="select an option">Men</option>
                                                <option value="Women" data-title="select an option">Women</option>
                                                <option value="Boys" data-title="select an option">Boys</option>
                                                <option value="Girls" data-title="select an option">Girls</option>
                                                <option value="Kids" data-title="select an option">Kids</option>
                                                <option value="Infants" data-title="select an option">Infants</option>
                                                <option value="Pets" data-title="select an option">Pets</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-8">
                                            <label for="image" class="control-label">Product Image</label>
                                            <input type="file" id="image" name="productImage" title="Image of this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="hsn_code" class="control-label">HSN Code</label>
                                            <input type="text" id="hsn_code" name="master[hsn_code]" placeholder="GST HSN code" title="Taxation HSN Code for this product" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4 pull-right">
                                            <input type="hidden" name="adminProcess" value="addMaster">
                                            <label for="submit" class="control-label"></label>
                                            <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Product"/>
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
