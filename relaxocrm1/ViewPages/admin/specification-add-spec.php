<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add New Specification</h5>
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
                            <datalist id="spec_heading_list">
                            </datalist>
                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <label  class="control-label">Specification Name <sup>*</sup></label>
                                    <input type="text" name="spec[]" placeholder="Exe. Electronics" title="Title of this product" class="form-control" maxlength="50"  required=""/>
                                </div>
                                <div class="form-group col-xs-4" id="heading_select">
                                    <label class="control-label">Specification Heading <sup>*</sup></label>
                                    <select data-placeholder="Choose Category" name="spec_heading[]" class="form-control chzn-select spec_heading_select" tabindex="3" required="">
                                        <option value="">Select...</option>
                                        <?php
                                            $options = $function->getArrayOptions_All_Table('client_specsheet', array('spec_heading heading'), ' GROUP BY ul_spec_heading ');
                                            foreach ($options as $option) {
                                                echo '<option value="'.$option['heading'].'">'.$option['heading'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <input type="text" list="spec_heading_list" name="spec_heading[]" placeholder="Exe. Memory (Double Click for Options)" title="Heading of this Specification" class="form-control spec_heading_input" maxlength="50" disabled="disabled"  required=""/>
                                </div>
                                <div class="form-group col-xs-2">
                                    <label for="" class="control-label"> &nbsp;  </label><br>
                                    <a href="#" title="Click Here to toggle Heading Options and Manual" class="add-new-option-btn heading_toggle pull-right"><i class="icon-refresh"></i></a>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-left">
                                <button type="button" class="btn btn-info add-row"><i class="icon-plus"></i> Add Row</button>
                            </div>
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addSpec">
                                <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Specifications"/>
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
        $('.spec_heading_input').hide();
        $('#content').on('click', '.heading_toggle',function(event) {
            var select = $(this).closest('.row').find('.spec_heading_select'),
                input = $(this).closest('.row').find('.spec_heading_input');
            if(input.attr('disabled')){
                select.attr('disabled', 'disabled');
                select.chosen("destroy");
                select.hide();
                input.show();
                input.removeAttr('disabled');
            }else{
                select.removeAttr('disabled');
                select.chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, not found!"
                }).trigger("chosen:updated");
                select.show();
                input.hide();
                input.attr('disabled', 'disabled');
            }
        });

        $('#content').on('click', '.delete-row', function(event) {
            $(this).closest('.row').remove();
        });

        $('#content').on('click', '.add-row', function(event) {
            var form = $('#content fieldset');
            form.find('.chzn-select').chosen("destroy");
            var row = form.children().eq(1).html(),
                newRow = $('<div class="row"/>').html(row).append('<div class="form-group col-xs-2">'+
                                    '<label for="" class="control-label"> &nbsp;  </label><br>'+
                                    '<a href="#" title="Click Here to toggle" class="add-new-option-btn delete-row pull-left"><i class="icon-trash"></i></a>'+
                                '</div>');
                newRow = form.append(newRow);
            newRow.find('.chzn-select').chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, not found!"
            }).trigger("chosen:updated");
        });
    });
</script>