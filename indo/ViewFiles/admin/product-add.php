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
                <div class="row"><center><?php echo  $function->getAdminMessage(); ?></center></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box dark">
                            <header>
                                <div class="icons"><i class="icon-shopping-cart"></i></div>
                                <h5>Add New Product</h5>
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
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-xs-6">
                                            <label for="sku" class="control-label">Product Master</label>
                                            <select data-placeholder="Choose Product Master" id="sku" name="product[sku]" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="" data-title="select an option">Select...</option>
                                                <?php
                                                    $subsubcategories = $function->getArrayOptions_productMasters();
                                                    foreach ($subsubcategories as $category) {
                                                        echo '<option value="'.$category['sku'].'" title="'.$category['brand'].'">'.$category['title'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="payment_title" class="control-label">Payment Title</label>
                                            <input type="text" id="payment_title" name="product[payment_title]" placeholder="Exe. Free Shipping on COD" title="Payment Description of this product" class="form-control" maxlength="100"  required=""/>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="product_master_id" class="control-label">Product Type</label>
                                            <select data-placeholder="Choose Product Master" id="product_master_id" name="product_master_id" class="form-control chzn-select" tabindex="2" required="">
                                                <option value="Same">Same Product</option>
                                                <option value="Variants">Its Variant</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="form-group col-xs-4">
                                            <label for="sku" class="control-label">Product SKU</label>
                                            <input type="text" id="sku" name="master[sku]" placeholder="Unique Identifucation" title="unique identifiction for this product, you can use barcode" class="form-control"/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="sku" class="control-label">Product ID</label>
                                            <input type="text" id="sku" name="master[product_id]" placeholder="Unique Identifucation" title="unique identifiction for this product, you can use barcode" class="form-control"/>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <div class="form-group col-xs-3">
                                            <label for="price_sale_center" class="control-label">Sale Price By Vendor (in INR)</label>
                                            <input type="number" min="1" max="10000000" step="0.01" id="price_sale_center" name="product[price_sale_center]" placeholder="Exe. 1000.00" title="Price at which Vendor will sale this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="price_discount_center" class="control-label">Discount (in %)</label>
                                            <input type="number" min="0" max="100" step="0.01" id="price_discount_center" name="product[price_discount_center]" placeholder="Exe. 10.00" title="Discount Percentage by Vendor on this price of this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="price_sale_client" class="control-label">Price for Customer (in INR)</label>
                                            <input type="number" min="1" max="10000000" step="0.01" id="price_sale_client" name="product[price_sale_client]" placeholder="Exe. 1000.00" title="Price at which Vendor will sale this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="price_discount_client" class="control-label">Discount (in %)</label>
                                            <input type="number" min="0" max="100" step="0.01" id="price_discount_client" name="product[price_discount_client]" placeholder="Exe. 10.00" title="Discount Percentage for Customer on this price of this product" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-3">
                                            <label for="price_quantity_unit" class="control-label">Quantity Unit of price</label>
                                            <input type="number" min="1" max="10000000" id="price_quantity_unit" name="product[price_quantity_unit]" placeholder="Exe. 2" title="Unit of products for this price, exe. 2 pcs" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="delivery_days" class="control-label">Days for delivery</label>
                                            <input type="number" min="0" max="100" step="1" id="delivery_days" name="product[delivery_days]" placeholder="Exe. 5" title="Days to deliver this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="dimensions" class="control-label">Product Dimensions</label>
                                            <input type="text" id="dimensions" name="product[dimensions]" placeholder="Exe. 10cm X 20cm X 10cm" title="Physcal dimension of this product" class="form-control" maxlength="50" />
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label for="delivery_charges" class="control-label">Charges for Delivery (in INR)</label>
                                            <input type="number" min="0" max="10000000" id="delivery_charges" name="product[delivery_charges]" placeholder="Exe. 30" title="Charges of delivery for this product" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="warranty_time" class="control-label">Warranty Time (in days)</label>
                                            <input type="number" min="0" max="7300" id="warranty_time" name="product[warranty_time]" placeholder="Exe. 365" title="Warranty time of this product" class="form-control"/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="warranty_text" class="control-label">Warranty Text</label>
                                            <input type="text" id="warranty_text" name="product[warranty_text]" placeholder="Exe. 1 Year Replacement warranty" title="Warranty Description of this product" class="form-control" maxlength="200" />
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="replacements" class="control-label">Replacement Text</label>
                                            <input type="text" id="replacements" name="product[replacements]" placeholder="Exe. 10 Days Replacement Warranty" title="Description of replacement for this product" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4">
                                            <label for="delivery_days" class="control-label">Payment Mode</label>
                                            <select data-placeholder="Select ..." name="product[method]"  class="form-control chzn-select" multiple="multiple" tabindex="4" style="height:25px;" required="">
                                                <option value="Pay On Delivery">Pay On Delivery</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="EMI">EMI</option>
                                                <option value="Debit Card">Debit Card</option>
                                                <option value="Net Banking">Net Banking</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="status" class="control-label">Product Level</label>
                                            <input type="number" min="2" max="250" step="1" id="status" name="product[status]" placeholder="Exe. 5" title="Level of this product" class="form-control" required=""/>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="qty_available_stock" class="control-label">Quantity Stock</label>
                                            <input type="number" min="1" max="100000" step="1" id="qty_available_stock" name="product[qty_available_stock]" placeholder="Exe. 5" title="Level of this product" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-4 pull-right">
                                            <input type="hidden" name="adminProcess" value="addProduct">
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
