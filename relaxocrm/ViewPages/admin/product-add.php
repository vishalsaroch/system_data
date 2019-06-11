<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Products</h5>
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
                    <form class="ajax-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 panel-group" id="accordion">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Product Details</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-xs-4">
                                                    <label for="brand" class="control-label"> Brand <sup>*</sup></label>
                                                    <select id="brand" name="form[brand]" title="Product Brand" class="form-control chzn-select" required="">
                                                        <option value="">Select ...</option>}
                                                        option
                                                        <option value='Oxaler'>Oxaler</option>
                                                        <option value='Relaxo'>Relaxo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="category" class="control-label">Category <sup>*</sup></label>
                                                    <input type="text" minlength="1" maxlength="20" id="category" name="form[category]" placeholder="Category Name" title="category of this product" class="form-control" autocomplete="off" list="categoryOptions" required=""/>
                                                    <datalist id="categoryOptions">

                                                    </datalist>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="name" class="control-label">Product Name <sup>*</sup></label>
                                                    <input type="text" minlength="1" maxlength="50" id="name" name="form[name]" placeholder="Product Name" title="Calling name of this product" class="form-control" autocomplete="off" list="productOptions" required=""/>
                                                    <datalist id="productOptions">

                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-4">
                                                    <label for="model" class="control-label">Model </label>
                                                    <input type="text" minlength="1" maxlength="50" id="model" name="form[model]" placeholder="Model/Variant" title="Model/Variant of this product" class="form-control"/>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="spec1" class="control-label">Color </label>
                                                    <input type="text" minlength="1" maxlength="20" id="spec1" name="form[spec1]" placeholder="Color"  list="spec1Options"  class="form-control"/>
                                                    <datalist id="spec1Options">

                                                    </datalist>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="spec2" class="control-label">Size </label>
                                                    <input type="text" minlength="1" maxlength="20" id="spec2" name="form[spec2]" placeholder="Size"  list="spec2Options"  class="form-control"/>
                                                    <datalist id="spec2Options">

                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-3">
                                                    <label for="stock" class="control-label">Opening Stock</label>
                                                    <input type="number" min="0" max="10000000" step="1" id="stock" name="form[stock]" placeholder="Opening Stock" title="Opening Stock of this product" class="form-control"/>
                                                </div>
                                                <div class="form-group col-xs-3">
                                                    <label for="price" class="control-label">Bill Price</label>
                                                    <input type="number" min="0" max="100000" step="0.01" id="price" name="form[price]" placeholder="Bill Price" title="Your Bill Price of spare part" class="form-control"/>
                                                </div>
                                                <div class="form-group col-xs-3">
                                                    <label for="gst" class="control-label">GST <small>(in %) </small></label>
                                                    <input type="number" min="0" max="100" step="0.01" id="gst" name="form[gst]" placeholder="(in %)" title="GST Percent of spare part" list="gstOptions" class="form-control"/>
                                                    <datalist id="gstOptions">
                                                      <option value="0.00">
                                                      <option value="5.00">
                                                      <option value="12.00">
                                                      <option value="18.00">
                                                      <option value="28.00">
                                                    </datalist>
                                                </div>
                                                <div class="form-group col-xs-3">
                                                    <label for="warranty" class="control-label">Warranty <small>(in months)</small> <sup>*</sup></label>
                                                    <input type="number" min="0" max="250" step="1" id="warranty" name="form[warranty]" placeholder="(in Months)" title="Your Warranty of spare part" list="warrantyOptions" class="form-control" required=""/>
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
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-3">
                                                    <label for="code" class="control-label">Code</label>
                                                    <input type="text" minlength="1" maxlength="20" id="code" name="form[code]" placeholder="Code" title="Unique Code of this spare part" class="form-control"/>
                                                </div>
                                                <div class="form-group col-xs-3">
                                                    <label for="hsn" class="control-label">HSN Code</label>
                                                    <input type="text" minlength="1" maxlength="20" id="hsn" name="form[hsn]" placeholder="HSN Code" title="HSN Taxation Code of this spare part" class="form-control" autocomplete="off" list="hsnOptions" />
                                                    <datalist id="hsnOptions">

                                                    </datalist>
                                                </div>
                                                <div class="form-group col-xs-6">
                                                    <label for="description" class="control-label">Description <sup>*</sup></label>
                                                    <input type="text" minlength="1" maxlength="200" id="description" name="form[description]" placeholder="Detail" title="Description of this Spare Part" class="form-control" required=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title" id="spareTabTitle">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Product Spares </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-xs-12">
                                                    <a class="btn btn-block btn-info add-row">
                                                        <i class="icon-plus"></i> Add One More Spare
                                                    </a>
                                                </div>
                                            </div>
                                            <fieldset>

                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="form[product_id]" value="">
                                <input type="hidden" name="adminAjax" value="addProduct">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save Product"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<template  id="addSprTemp">
    <div class="row">
        <div class="form-group col-xs-8" id="heading_select">
            <label class="control-label">Spare Part <sup>*</sup></label>
            <select data-placeholder="Choose Category" name="spareName[]" class="form-control chzn-select spec_heading_select" tabindex="3" required="">
                <option value="">Select...</option>
                <?php
                    $options = $function->getArrayOptions_All_Table('client_spares', array('category category', 'name part', 'model model', 'spec spec', 'spare_id id'));
                    foreach ($options as $option) {
                        echo '<option value="'.$option['id'].'">'.$option['category'].' - '.$option['part'].' - '.$option['model'].' ('.$option['spec'].')</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-xs-2">
            <label class="control-label">Quantity <sup>*</sup></label>
            <input type="number" name="spareQuantity[]" placeholder="No." title="Number of this spare used in this product" class="form-control" min="1"  required=""/>
        </div>
        <div class="form-group col-xs-2">
            <label for="" class="control-label"> &nbsp;  </label><br>
            <a href="#" title="Click Here to delete row" class="add-new-option-btn delete-row text-center"><i class="icon-trash"></i></a>
        </div>
    </div>
</template>
<script type="text/javascript">
    $(function(){
        $('#content').on('click', '.delete-row', function(event) {
            $(this).closest('.row').remove();
        });

        $('#content').on('click', '.add-row', function(event) {
            var form = $('#content fieldset'),
                row = $("#addSprTemp").html();
            row = form.append(row);
            row.find('.chzn-select').chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, not found!"
            }).trigger("chosen:updated");
        });
    });
    $(function(){
        <?php
            $type = $_GET["type"];
            if ($type != "new" && $level >= 8) {
                $id = (int) $type;
                echo "var id = $id,
                          details = ".json_encode($function->getDetail_product($id)).',
                          spares = '.json_encode($function->getDetail_productsSpares($id)).';';
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
                    $('#pageTitle').html('Edit Product #'+details.code);
                    $('[name="form[product_id]"]').val(id);
                }
                <?php
            }
        ?>
    });
</script>
<script type="text/javascript">
    $(function(){
        <?php
            echo 'var options = '.json_encode($function->getArrayOptions_All_Table('client_products', array('category category', 'name product', 'hsn hsn', 'spec1 spec1', 'spec2 spec2'))).';';
        ?>

        var categoryOptions = [],
            productOptions = [],
            spec1Options = [],
            spec2Options = [],
            hsnOptions = [];
        $.each(options, function( index, item ) {
            if(! categoryOptions.includes(item.category)){
                categoryOptions.push(item.category);
                $('#categoryOptions').append('<option value="'+item.category+'">');
            }
            if(! productOptions.includes(item.product)){
                productOptions.push(item.product);
                $('#productOptions').append('<option value="'+item.product+'">');
            }
            if(! hsnOptions.includes(item.hsn)){
                hsnOptions.push(item.hsn);
                $('#hsnOptions').append('<option value="'+item.hsn+'">');
            }
            if(! spec1Options.includes(item.spec1)){
                spec1Options.push(item.spec1);
                $('#spec1Options').append('<option value="'+item.spec1+'">');
            }
            if(! spec2Options.includes(item.spec2)){
                spec2Options.push(item.spec2);
                $('#spec2Options').append('<option value="'+item.spec2+'">');
            }
        });
    });

</script>