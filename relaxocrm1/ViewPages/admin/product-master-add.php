<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Fresh Product Master</h5>
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
                    <form class="ajax-fom" action="" method="post" enctype="multipart/form-data">
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
                                                    <label for="brand_id" class="control-label">Product Brand <sup>*</sup></label>
                                                    <select data-placeholder="Choose Product Master" id="brand_id" name="master[brand_id]" class="form-control chzn-select" tabindex="0" required="">
                                                        <option value="" data-title="select an option">Select Category first...</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xs-4">
                                                    <label for="hsn_code" class="control-label">HSN Code </label>
                                                    <input type="text" minlength="1" maxlength="20" id="hsn_code" name="master[hsn_code]" placeholder="Tax HSN Code" title="HSN Code of this product" class="form-control"/>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group col-xs-4">
                                                <label for="product_master_id" class="control-label">Product Type</label>
                                                <select data-placeholder="Choose Product Master" id="product_master_id" name="product_master_id" class="form-control chzn-select" required="">
                                                    <option value="Same">Same Product</option>
                                                    <option value="Variants">Its Variant</option>
                                                </select>
                                            </div> -->
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
                                                        <label for="image-1" class="control-label">Image 1 <sup>*</sup></label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-1" name="master[spec][image][]" placeholder="Image 1 URL" title="Image 1 of this product" class="form-control" required=""/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-2" class="control-label">Image 2</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-2" name="master[spec][image][]" placeholder="Image 2 URL" title="Image 2 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-3" class="control-label">Image 3</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-3" name="master[spec][image][]" placeholder="Image 3 URL" title="Image 3 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-4" class="control-label">Image 4</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-4" name="master[spec][image][]" placeholder="Image 4 URL" title="Image 4 of this product" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-xs-6 col-md-4">
                                                        <label for="image-5" class="control-label">Image 5</label>
                                                        <input type="url" minlength="10" maxlength="200" id="image-5" name="master[spec][image][]" placeholder="Image 5 URL" title="Image 5 of this product" class="form-control"/>
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
                                                        <div style="box-sizing: border-box; margin: 24px 0px 0px; padding: 0px; border: 1px solid rgb(240, 240, 240); color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px; position: relative; display: flex; border-top: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px; flex: 2 1 0%;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 20px 0px; display: inline-block;"><div class="-aY3" style="box-sizing: border-box; margin: 0px; padding: 0px 40px; font-size: 18px; position: relative;"><span style="font-size: 24px;">Product Description</span></div></div></div></div></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div class="  " style="box-sizing: border-box; margin: 0px auto 5px 0px; padding: 0px 0px 0px 32px; text-align: center; float: right; overflow: hidden; width: 200px;"><img src="https://rukminim1.flixcart.com/image/200/200/j8vy1e80/mobile/h/e/t/mi-mi-a1-mzb5645in-mzb5717in-original-imaeyt4fj5guh6sh.jpeg?q=90" style="box-sizing: border-box; margin: 0px; padding: 0px; color: inherit; border: none; outline: none; max-width: 100%; vertical-align: middle;"></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Numero Uno</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">The Xiaomi Mi A1 is an Android One phone that is powered by Google itself. So not only do you get near-stock Android Nougat out of the box, but you are also guaranteed OS upgrades. Further, Android One device is also one of the first to get the upgrade.</p></div></div></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px auto 5px 0px; padding: 0px 32px 0px 0px; text-align: center; float: left; overflow: hidden; width: 200px;"><img src="https://rukminim1.flixcart.com/image/200/200/jah3ngw0/mobile/h/e/t/mi-mi-a1-mzb5645in-mzb5717in-original-imafyfjt3cajyzpr.jpeg?q=90" style="box-sizing: border-box; margin: 0px; padding: 0px; color: inherit; border: none; outline: none; max-width: 100%; vertical-align: middle;"></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Twice the Fun</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">With the Xiaomi Mi A1, you get a dual rear camera setup. One of the sensors sports a wide-angle lens, while the other is equipped with a telephoto lens. Further, the two cameras also let you take bokeh shots. If that wasn’t cool enough, you also get unlimited storage on Google Photos.</p></div></div></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div class="  " style="box-sizing: border-box; margin: 0px auto 5px 0px; padding: 0px 0px 0px 32px; text-align: center; float: right; overflow: hidden; width: 200px;"><img src="https://rukminim1.flixcart.com/image/200/200/j8vy1e80/mobile/h/e/t/mi-mi-a1-mzb5645in-mzb5717in-original-imaeyt4ffvphantg.jpeg?q=90" style="box-sizing: border-box; margin: 0px; padding: 0px; color: inherit; border: none; outline: none; max-width: 100%; vertical-align: middle;"></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Sleek and Trendy</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">With the Xiaomi Mi A1 you get a metal unibody design with rounded corners to ensure a comfortable grip. You also get a fingerprint resistant back, that helps keep the phone smudge-free.</p></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 36px 40px 0px 0px; display: inline-block;"><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 22px; line-height: 1;">Metal<sup style="box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 2px; font-size: 14px;"></sup></span><p style="box-sizing: border-box; margin: 0px; padding: 3px 0px 0px; color: rgb(135, 135, 135);">Unibody</p></div><div style="box-sizing: border-box; margin: 0px; padding: 36px 40px 0px 0px; display: inline-block;"><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 22px; line-height: 1;">7.3 mm<sup style="box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 2px; font-size: 14px;"></sup></span><p style="box-sizing: border-box; margin: 0px; padding: 3px 0px 0px; color: rgb(135, 135, 135);">Thick</p></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px auto 5px 0px; padding: 0px 32px 0px 0px; text-align: center; float: left; overflow: hidden; width: 200px;"><img src="https://rukminim1.flixcart.com/image/200/200/j8vy1e80/mobile/h/e/t/mi-mi-a1-mzb5645in-mzb5717in-original-imaeyt4gu9ckbwjg.jpeg?q=90" style="box-sizing: border-box; margin: 0px; padding: 0px; color: inherit; border: none; outline: none; max-width: 100%; vertical-align: middle;"></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Full HD Display</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">The Xiaomi Mi A1 sports a large display that makes watching movies or playing games an enjoyable experience. The high-resolution display ensures crisp visuals.</p></div></div></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Power Packed</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">The Xiaomi Mi A1 is powered by Qualcomm’s Snapdragon 625 platform, which is powerful enough to run most apps and games available on the Play Store. Further, the chipset is manufactured using the 14nm FinFET process, which offers better performance and efficiency.</p></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 36px 40px 0px 0px; display: inline-block;"><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 22px; line-height: 1;">Snapdragon<sup style="box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 2px; font-size: 14px;"></sup></span><p style="box-sizing: border-box; margin: 0px; padding: 3px 0px 0px; color: rgb(135, 135, 135);">625</p></div><div style="box-sizing: border-box; margin: 0px; padding: 36px 40px 0px 0px; display: inline-block;"><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 22px; line-height: 1;">2 GHz<sup style="box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 2px; font-size: 14px;"></sup></span><p style="box-sizing: border-box; margin: 0px; padding: 3px 0px 0px; color: rgb(135, 135, 135);">Clock Speed</p></div><div style="box-sizing: border-box; margin: 0px; padding: 36px 40px 0px 0px; display: inline-block;"><span style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 22px; line-height: 1;">4GB<sup style="box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 2px; font-size: 14px;"></sup></span><p style="box-sizing: border-box; margin: 0px; padding: 3px 0px 0px; color: rgb(135, 135, 135);">RAM</p></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Ample Storage Space</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">The Xiaomi Mi A1 offers plenty of inbuilt storage space for apps, games, photos and videos. However, if you still find yourself lacking in space, you can expand the storage via a microSD card slot.</p></div></div></div></div></div></div><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: -1px 0px 0px; padding: 24px; border: 1px solid rgb(240, 240, 240);"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px;"><div style="box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; font-size: 20px;">Improved Audio</div><div style="box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.29;"><p style="box-sizing: border-box; margin: 0px; padding: 0px;">The Xiaomi Mi A1 comes with Dirac HD Sound Algorithm. This means you get boosted volume along with better bass, leading to a much improved listening experience.</p></div></div></div></div></div></div></div>
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
            $("#brand_id").html('<option value="" data-title="select an option">Select...</option>');
            var id = $(this).val(),
                action = "fetchDependentSelect",
                entity = "cat-BrandMeta",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                // console.log(msg);
                if(status === "success"){
                    // List Cat Brands
                    if(!msg.brand) $("#brand_id").html('<option value="" data-title="Oops!">No Brand Added for this Category</option>');
                    $.each(msg.brand, function(index,data){
                        $("#brand_id").append('<option value="'+data.brdId+'">'+data.brandName+'</option>');
                    });
                    $("#brand_id").trigger("chosen:updated");

                    // List Cat SpecSheet
                    var decoded = $('<div/>').html(msg.prdSpec).text();
                    $('#spec').val(decoded);
                    $("#spec").cleditor({ width: "100%", height: "400px" })[0].updateFrame();

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
    });
</script>