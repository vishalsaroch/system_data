<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5 id="pageTitle">Add Product Spare Parts</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Masters
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/BestWebs?module=product&mode=add&type=new">Add New Product</a></li>
                                    <li><a href="/BestWebs?module=product&mode=add-brand&type=new">Add New Brand</a></li>
                                    <li><a href="/BestWebs?module=categories&mode=add-product&type=new">Add New Category</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <form name="form" action="" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                        <label for="uploadExcel" style="margin:0;">
                                            <i class="icon-list-alt"></i> Upload Excel
                                            <input type="file" id="uploadExcel" name="uploadExcel" onchange="uploadExcelf(this.form);">
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
                    <form id="product-spare" class="ajax-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-xs-4">
                                <label for="category" class="control-label">Category <sup>*</sup></label>
                                <input type="text" minlength="1" maxlength="20" id="category" name="form[category]" placeholder="Category Name" title="category of this spare part" class="form-control" autocomplete="off" list="categoryOptions" required=""/>
                                <datalist id="categoryOptions">

                                </datalist>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="name" class="control-label">Part Name <sup>*</sup></label>
                                <input type="text" minlength="1" maxlength="50" id="name" name="form[name]" placeholder="Spare Name" title="Calling name of this spare part" class="form-control" autocomplete="off" list="partOptions" required=""/>
                                <datalist id="partOptions">

                                </datalist>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="model" class="control-label">Model </label>
                                <input type="text" minlength="1" maxlength="50" id="model" name="form[model]" placeholder="Model/Variant" title="Model/Variant of this spare part" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4">
                                <label for="code" class="control-label">Code</label>
                                <input type="text" minlength="1" maxlength="20" id="code" name="form[code]" placeholder="Code" title="Unique Code of this spare part" class="form-control"/>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="brand" class="control-label">Brand Name</label>
                                <input type="text" minlength="1" maxlength="20" id="brand" name="form[brand]" placeholder="Brand" title="Brand of this spare part" class="form-control" autocomplete="off" list="brandOptions" />
                                <datalist id="brandOptions">

                                </datalist>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="hsn" class="control-label">HSN Code</label>
                                <input type="text" minlength="1" maxlength="20" id="hsn" name="form[hsn]" placeholder="HSN Code" title="HSN Taxation Code of this spare part" class="form-control" autocomplete="off" list="hsnOptions" />
                                <datalist id="hsnOptions">

                                </datalist>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-3">
                                <label for="stock" class="control-label">Opening Fresh Stock <sup>*</sup></label>
                                <input type="number" min="0" max="10000000" step="1" id="stock" name="form[stock]" placeholder="Opening Stock" title="Opening Stock of this product" class="form-control" required=""/>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="old_stock" class="control-label">Opening Old Stock <sup>*</sup></label>
                                <input type="number" min="0" max="10000000" step="1" id="old_stock" name="form[old_stock]" placeholder="Opening Stock" title="Opening Stock of Old Spare" class="form-control" required=""/>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="price" class="control-label">Bill Price <sup>*</sup></label>
                                <input type="number" min="0" max="100000" step="0.01" id="price" name="form[price]" placeholder="Bill Price" title="Your Bill Price of spare part" class="form-control" required=""/>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="gst" class="control-label">GST <small>(in %) </small><sup>*</sup></label>
                                <input type="number" min="0" max="100" step="0.01" id="gst" name="form[gst]" placeholder="(in %)" title="GST Percent of spare part" autocomplete="off" list="gstOptions" class="form-control" required=""/>
                                <datalist id="gstOptions">
                                  <option value="0.00">
                                  <option value="5.00">
                                  <option value="12.00">
                                  <option value="18.00">
                                  <option value="28.00">
                                </datalist>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="description" class="control-label">Description <sup>*</sup></label>
                                <input type="text" minlength="1" maxlength="200" id="description" name="form[description]" placeholder="Detail" title="Description of this Spare Part" class="form-control" required=""/>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="warranty" class="control-label">Warranty <small>(in months)</small></label>
                                <input type="number" min="0" max="250" step="1" id="warranty" name="form[warranty]" placeholder="(in Months)" title="Your Warranty of spare part" autocomplete="off" list="warrantyOptions" class="form-control"/>
                                <datalist id="warrantyOptions">
                                    <option value="1">
                                    <option value="3">
                                    <option value="6">
                                    <option value="9">
                                    <option value="12">
                                    <option value="18">
                                    <option value="24">
                                    <option value="36">
                                    <option value="48">
                                    <option value="60">
                                </datalist>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="spec" class="control-label">Specification</label>
                                <input type="text" minlength="1" maxlength="50" id="spec" name="form[spec]" placeholder="Specification" title="Specification of this Spare Part" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="form[spare_id]" value="">
                                <input type="hidden" name="adminAjax" value="addSpare">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>Warranty, Replacement, Delivery etc. ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save Spare Part"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        <?php
            if ($_GET['type'] != "new") {
                $id = (int)$_GET['type'];
            };
            echo 'var options = '.json_encode($function->getArrayOptions_All_Table('client_spares', array('category category', 'name part', 'brand brand', 'hsn hsn'))).';';
        ?>
        var categoryOptions = [],
            partOptions = [],
            brandOptions = [];
            hsnOptions = [];
        $.each(options, function( index, item ) {
            if(! categoryOptions.includes(item.category)){
                categoryOptions.push(item.category);
                $('#categoryOptions').append('<option value="'+item.category+'">');
            }
            if(! partOptions.includes(item.part)){
                partOptions.push(item.part);
                $('#partOptions').append('<option value="'+item.part+'">');
            }
            if(! brandOptions.includes(item.brand)){
                brandOptions.push(item.brand);
                $('#brandOptions').append('<option value="'+item.brand+'">');
            }
            if(! hsnOptions.includes(item.hsn)){
                hsnOptions.push(item.hsn);
                $('#hsnOptions').append('<option value="'+item.hsn+'">');
            }
        });
    });
    $(function(){
        <?php
            $type = $_GET["type"];
            if ($type != "new") {
                $id = (int) $type;
                echo "var id = $id,
                          details = ".json_encode($function->getDetail_spare($id)).';';
                ?>
                if(details){
                    $.each(details, function(index, el) {
                        var input = $('[name="form['+index+']"]');
                        if(input.prop('tagName') == 'SELECT'){
                            input.val(html_entity_decode(el)).trigger('chosen:updated');
                        }else{
                            input.val(html_entity_decode(el));
                        }
                    });
                    $('#pageTitle').html('Edit Product Spare Part #'+details.code);
                    $('[name="form[spare_id]"]').val(id);
                }
                <?php
            }
        ?>
    });
</script>