<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Specifications Values</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Masters
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/BestWebs?module=product&mode=add&type=new">Add New Product</a></li>
                                    <li><a href="/BestWebs?module=product&mode=add-master&type=new">Add New Product Master</a></li>
                                    <li><a href="/BestWebs?module=product&mode=add-brand&type=new">Add New Brand</a></li>
                                    <li><a href="/BestWebs?module=categories&mode=add-master&type=new">Add New Category</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <form name="form" action="" method="post" enctype="multipart/form-data" onsubmit="return false;">
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
                    <form class="ajax-form" action="" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <label  class="control-label">Specification <sup>*</sup></label>
                                    <select data-placeholder="Choose Spec" name="spec[]" data-entity="specs" class="form-control chzn-select" tabindex="3" required="required">
                                        <option value="">Select ...</option>
                                        <?php
                                            $options = $function->getArrayOptions_All_Table('client_specsheet', array('spec_heading heading', 'spec spec', 'specsheet_id id'), ' ORDER BY ul_spec_heading ASC ');
                                            foreach ($options as $option) {
                                                echo '<option value="'.$option['id'].'">'.$option['spec'].' ('.$option['heading'].')</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-4" id="heading_select" title="Separate with comma">
                                    <label class="control-label">Values <sup>*</sup></label>
                                    <input name="values[]" value="" class="form-control tags-input hidden-but-required" placeholder="Enter Possible Values" required=""/>
                                </div>
                                <div class="form-group col-xs-2" id="heading_select" title="Double Click for options">
                                    <label class="control-label">Unit <sup>*</sup></label>
                                    <input type="text" list="unit_options" name="unit[]" placeholder="Ex. GB" title="Double Click for options" class="form-control" maxlength="20"  required=""/>
                                    <small>Double Click for options</small>
                                    <datalist id="unit_options">
                                        <option value="No Unit">
                                        <option value="Unit">
                                        <option value="Pc">
                                        <option value="KB">
                                        <option value="MB">
                                        <option value="GB">
                                        <option value="TB">
                                        <option value="Mg">
                                        <option value="Gm">
                                        <option value="Kg">
                                        <option value="MM">
                                        <option value="CM">
                                        <option value="Inch">
                                        <option value="Feet">
                                        <option value="Yard">
                                        <option value="M">
                                        <option value="KM">
                                        <option value="KHz">
                                        <option value="MHz">
                                        <option value="GHz">
                                        <option value="THz">
                                        <option value="mAh">
                                    </datalist>
                                </div>
                                <div class="form-group col-xs-1">
                                    <label for="" class="control-label"> &nbsp;  </label><br>
                                    <a href="#" title="Click Here to toggle" class="add-new-option-btn heading_toggle pull-right"><i class="icon-refresh"></i></a>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-left">
                                <button type="button" class="btn btn-info add-row"><i class="icon-plus"></i> Add Row</button>
                            </div>
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addSpecVal">
                                <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Spec Values"/>
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
        $('#content').on('click', '.delete-row', function(event) {
            $(this).closest('.row').remove();
        });

        $('#content').on('click', '.add-row', function(event) {
            var form = $('#content fieldset');
            form.find('.chzn-select').chosen("destroy");
            form.find('.tags-input').destroyTagsInput();
            $("#selector").destroyTagsInput();
            var row = form.children().eq(0).html(),
                newRow = $('<div class="row"/>').html(row).append('<div class="form-group col-xs-1">'+
                                    '<label for="" class="control-label"> &nbsp;  </label><br>'+
                                    '<a href="#" title="Click Here to toggle" class="add-new-option-btn delete-row pull-left"><i class="icon-trash"></i></a>'+
                                '</div>');
            newRow = form.append(newRow);
            form.find('.chzn-select').chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, not found!"
            }).trigger("chosen:updated");
            form.find('.tags-input').tagsInput();
        });
    });
</script>