<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Product Variant Master</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Masters
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/BestWebs?module=product&mode=add&type=new">Add New Product</a></li>
                                    <li><a href="/BestWebs?module=product&mode=add-brand&type=new">Add New Brand</a></li>
                                    <li><a href="/BestWebs?module=categories&mode=add-master&type=new">Add New Category</a></li>
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
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Variant Details</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-xs-4">
                                                    <label for="category_id" class="control-label">Category <sup>*</sup></label>
                                                    <select data-placeholder="Choose Category" id="category_id" name="master[category_id]" class="form-control chzn-select" tabindex="0" required="">
                                                        <option value="">Select...</option>
                                                        <?php
                                                            $options = $function->getArrayOptions_All_Table('client_categories', array('title title', 'category_id catId'));
                                                            foreach ($options as $option) {
                                                                echo '<option value="'.$option['catId'].'">'.$option['title'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="sku" class="control-label">Product <sup>*</sup></label>
                                                    <select data-placeholder="Choose Product Master" id="sku" name="sku" class="form-control chzn-select" tabindex="0" required="">
                                                        <option value="" data-title="select an option">Select Category first...</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="brand_id" class="control-label">Product Brand <sup>*</sup></label>
                                                    <select data-placeholder="Choose Product Master" id="brand_id" name="master[brand_id]" class="form-control chzn-select" tabindex="0" required="">
                                                        <option value="" data-title="select an option">Select Category first...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-6">
                                                    <label for="title" class="control-label">Product Title <sup>*</sup></label>
                                                    <input type="text" minlength="1" maxlength="200" id="title" name="master[title]" placeholder="Product Title" title="Title of this product" class="form-control" required=""/>
                                                </div>
                                                <div class="form-group col-xs-6">
                                                    <label for="subtitle" class="control-label">Product SubTitle <sup>*</sup></label>
                                                    <input type="text" minlength="1" maxlength="200" id="subtitle" name="master[subtitle]" placeholder="Product SubTitle" title="Sub title of this product" class="form-control" required=""/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-4">
                                                    <label for="under_sale_badge" class="control-label">Under Sale ? <sup>*</sup></label>
                                                    <div>
                                                        <div class="make-switch" data-on="success" data-on-label="Yes" data-off="primary" data-off-label="No">
                                                            <input type="checkbox" name="master[under_sale_badge]" value="1" id="under_sale_badge" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="product_status" class="control-label">Live this Product ? <sup>*</sup></label>
                                                    <div>
                                                        <div class="make-switch" data-on="danger" data-on-label="Later" data-off="success" data-off-label="Yes">
                                                            <input type="checkbox" id="product_status" name="master[status]" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="productImages" class="control-label">Product Images ? <sup>*</sup></label>
                                                    <div>
                                                        <div class="make-switch images-switch" data-on="success" data-on-label="Self" data-off="primary" data-off-label="Externally" data-text-label="Hosted">
                                                            <input type="checkbox" id="productImages" value="1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="productImagesDiv" style="border:1px dashed gray;margin:15px 0;">
                                                <fieldset id="localImages" style="height: 100px;">
                                                    <div class="form-group col-xs-4">
                                                        <div class="form-group">
                                                            <label class="btn btn-primary">
                                                                <span id="uploadedthumbnailBtn">Select Thumbnail ... <sup>*</sup></span>
                                                                <input type="file" id="thumbnail" name="image[]" class="hidden-but-required" accept="image/jpeg,image/png,image/gif" required="">
                                                            </label>
                                                            <br><br>
                                                            <label class="btn btn-info"  title="Use CTRL key to uploade more than one upto five.">
                                                                <span id="uploadedImageBtn">Select Images ... <sup>*</sup></span>
                                                                <input type="file" id="image" name="image[]" class="hidden-but-required" accept="image/jpeg,image/png,image/gif" multiple="" required="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-8">
                                                        <div id="uploadedThumbnailPreview" style="display: inline-block; border-right: 1px solid black;"></div>
                                                        <div id="uploadedImagePreview" style="display: inline-block;"></div>
                                                    </div>
                                                </fieldset>
                                                <fieldset id="externalImages">
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="img_url" class="control-label">Thumbnail <sup>*</sup></label>
                                                        <input type="url" minlength="10" maxlength="200" id="img_url" name="master[spec][image][]" placeholder="Thumbnail URL" title="Thumbnail URL this product" class="form-control" required=""/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-0" class="control-label">Image 1 <sup>*</sup></label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-0" name="master[spec][image][]" placeholder="Image 1 URL" title="Image 1 of this product" class="form-control" required=""/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-1" class="control-label">Image 2</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-1" name="master[spec][image][]" placeholder="Image 2 URL" title="Image 2 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-2" class="control-label">Image 3</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-2" name="master[spec][image][]" placeholder="Image 3 URL" title="Image 3 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-3" class="control-label">Image 4</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-3" name="master[spec][image][]" placeholder="Image 4 URL" title="Image 4 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-4" class="control-label">Image 5</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-4" name="master[spec][image][]" placeholder="Image 5 URL" title="Image 5 of this product" class="form-control"/>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Product Specs <label><sup>*</sup></label></a>
                                            <a href="/BestWebs?module=specification&mode=add-value&type=new" target="_blank" class="add-new-option-btn" title="Add New Spec Value, if not coming in Autocomplete"><i class="icon-plus"></i> </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div id="catSpec">

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="cleditorDiv body collapse in">
                                                <textarea class="cleditor form-control" name="master[spec][spec]" id="spec" required="">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Product Description <label><sup>*</sup></label></a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="cleditorDiv body collapse in">
                                                <textarea class="cleditor form-control" name="master[spec][description]" id="description" required="">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addMaster">
                                <label for="submit" class="control-label"></label>
                                <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Product"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        var catId;
        $('#localImages').hide();
        $('#localImages').prop("disabled",true);

        $('#image').on('change', function(){
            var targetDiv = $("#uploadedImagePreview"),
                inputTag = $(this),
                status = previewSelectedImages(targetDiv, inputTag, 5);
            if(status){
                $('#uploadedImageBtn').text('Change Images ...');
            }else{
                $('#uploadedImageBtn').text('Select Images ...');
            }
        });

        $('#thumbnail').on('change', function(){
            var targetDiv = $("#uploadedThumbnailPreview"),
                inputTag = $(this),
                status = previewSelectedImages(targetDiv, inputTag, 1);
            if(status){
                $('#uploadedthumbnailBtn').text('Change Thumbnail ...');
            }else{
                $('#uploadedthumbnailBtn').text('Select Thumbnail ...');
            }
        });

        $('.images-switch').on('switch-change', function (e, data) {
            var value = data.value;
            if(value == 1){
                $('#localImages').show();
                $('#localImages').prop("disabled",false);
                $('#externalImages').hide();
                $('#externalImages').prop("disabled",true);
            }else{
                $('#externalImages').show();
                $('#externalImages').prop("disabled",false);
                $('#localImages').hide();
                $('#localImages').prop("disabled",true);
            }
        });

        $("#category_id").chosen().on("change", function(event) {
            $("#sku").html('<option value="" data-title="select an option">Select...</option>');
            $("#brand_id").html('<option value="" data-title="select an option">Select...</option>');
            catId = $(this).val()
            var action = "fetchDependentSelect",
                entity = "cat-PrdList",
                varsArray = {"adminAjax":action, "entity":entity, "id":catId};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    // List Cat Products
                    if(!msg.product) $("#sku").html('<option value="" data-title="Oops!">No Product Added for this Category</option>');
                    $.each(msg.product, function(index,data){
                        $("#sku").append('<option value="'+data.sku+'">'+data.title+'</option>');
                    });
                    $("#sku").trigger("chosen:updated");

                    // List Cat Brands
                    if(!msg.brand) $("#brand_id").html('<option value="" data-title="Oops!">No Brand Added for this Category</option>');
                    $.each(msg.brand, function(index,data){
                        $("#brand_id").append('<option value="'+data.brdId+'">'+data.brandName+'</option>');
                    });
                    $("#brand_id").trigger("chosen:updated");

                    // List Cat Specs
                    var catSpecDiv = $('#catSpec');
                    if(msg.catSpec){
                        var label = msg.catSpec[0]['specHead'];
                        catSpecDiv.html('<fieldset><legend>'+label+'</legend>');
                        $.each(msg.catSpec, function(index,data){
                            var form_group = $('<div class="form-group col-xs-6"/>');
                            form_group.append('<label class="control-label">'+data.spec+' <sup>*</sup></label>');
                            if(data.specHead !== label){
                                label = data.specHead;
                                catSpecDiv.append('</fieldset><fieldset><legend>'+label+'</legend>');
                            }
                            var $input = $("<input>", {
                              "class": "form-control auto-complete",
                              "id" : data.specID,
                              maxlength: "20",
                              minlength: "2",
                              required: "required"
                            });
                            var $input2 = $('<input type="hidden" name="spec['+data.specID+']" id="input-'+data.specID+'" required="required"/>');
                            $input2.appendTo(form_group);
                            $input
                              .appendTo(form_group)
                              .focus()
                              .autocomplete({
                                    minLength: 1,
                                    source: function( request, response ) {
                                        var varsArray = {"adminAjax":"fetchSpecAutocomplete", "entity":data.specID, "id":request.term};
                                        performAjax(varsArray, " ", function(status, msg){
                                            response( msg );
                                        }, true);
                                    },
                                    select: function (event, ui) {
                                        var inputId = $(this).attr('id'),
                                            label = ui.item.label,
                                            valueId = ui.item.valueId,
                                            value = ui.item.value;
                                        $('#input-'+inputId).val(valueId);
                                    },
                                    change: function(event,ui){
                                        $(this).val((ui.item ? ui.item.label : ""));
                                    }
                                });
                            catSpecDiv.append(form_group);
                        });
                    }else{
                        catSpecDiv.html('');
                    }
                }else{
                    showResponse(status, msg);
                    setShowModal(msg, status);
                }
            });
        });

        $("#sku").chosen().on("change", function(event) {
            var id = $(this).val(),
                action = "fetchDependentSelect",
                entity = "prd-DataMeta",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                console.log(msg);
                if(status === "success"){
                    // List Product SpecSheet
                    var decoded = $('<div/>').html(msg.data.spec).text(),
                        $input2 = $('<input type="hidden" name="master[product_id]" id="product_id" value="'+msg.data.product+'" required="required"/>');
                    $('#product_id').remove();
                    $input2.appendTo('#content form');
                    $('#spec').val('').val(decoded);
                    $("#spec").cleditor({ width: "100%", height: "400px" })[0].updateFrame();

                    // List Product Description
                    decoded = $('<div/>').html(msg.data.description).text();
                    $('#description').val('').val(decoded);
                    $("#description").cleditor({ width: "100%", height: "400px" })[0].updateFrame();

                    // List Product Data
                    $("#title").val('').val(msg.data.title);
                    $("#subtitle").val('').val(msg.data.subtitle);
                    $("#img_url").val('').val(msg.data.img_url);
                    $('#brand_id').val('').val(msg.data.brand).trigger("chosen:updated");

                    // List Product Images
                    if(msg.data.image){
                        $.each(msg.data.image, function(index,data){
                            $("#image-"+index).val('').val(data);
                        });
                    }else{
                        $.each($("input[id^='image-']"), function(index,data){
                            $(this).val('');
                        });
                    }

                    // List Product Specs
                    if(msg.prdSpec){
                        $.each(msg.prdSpec, function(index,data){
                            $("#"+data.specID).val('').val(data.specVal+' '+data.specUnit);
                            $("#input-"+data.specID).val('').val(data.unit);
                        });
                    }else{
                        $.each($("input[id^='input-']"), function(index,data){
                            $(this).val('');
                            $(this).siblings('.auto-complete').val('');
                        });
                    }

                }else{
                    showResponse(status, msg);
                    setShowModal(msg, status);
                }
            });
        });
    });
</script>