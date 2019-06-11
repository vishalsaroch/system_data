<?php if($level < 7){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<style type="text/css" media="screen">
    input::-webkit-inner-spin-button, input::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    .form-control{padding:6px;}
    .expenseContent .form-group{padding: 0 5px;}
</style>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Expense/Income Entry</h5>
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
                            <div class="form-group col-xs-4">
                                <label for="date" class="control-label">Date <sup>*</sup></label>
                                <input type="date" id="date" name="date" placeholder="Inward Date" title="Inward Date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required=""/>
                            </div>
                            <div class="form-group col-xs-4" id="heading_select">
                                <label class="control-label">Data <sup>*</sup></label>
                                <select data-placeholder="Choose Category" name="type" class="form-control" required="">
                                    <option value="">Select...</option>
                                    <option value="1">Income</option>
                                    <option value="-1">Expense</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-4">
                                <label for="code" class="control-label">Invoice/Challan</label>
                                <input type="text" minlength="1" maxlength="20" id="code" name="challan" placeholder="Challan/Invoice No." title="Manual Challan Number" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <a class="btn btn-block btn-info add-row">
                                    <i class="icon-plus"></i> Add One More Row
                                </a>
                            </div>
                        </div>
                        <div class="expenseContent col-xs-12">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-4" id="heading_select">
                                        <label class="control-label">Type <sup>*</sup></label>
                                        <input type="text" name="expenseType[]" placeholder="Enter to Search" title="Type of this Expense" autocomplete="off" list="typeOptions" class="form-control" maxlength="30"  required=""/>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label class="control-label">Detail <sup>*</sup></label>
                                        <input type="text" name="expenseDetail[]" placeholder="Enter Detail" title="Detail of this Expense" class="form-control" maxlength="200"  required=""/>
                                    </div>
                                    <div class="form-group col-xs-2">
                                        <label class="control-label">Amount <sup>*</sup></label>
                                        <input type="number" name="expenseAmount[]" placeholder="Amount" title="Amount of this expense" class="form-control expenseAmount" min="0.01" step="0.01" max="999999.99"  required=""/>
                                    </div>
                                    <div class="form-group col-xs-1">
                                        <label class="control-label">GST</label>
                                        <input type="number" name="expenseGST[]" placeholder="GST" title="GST of this expense" class="form-control expenseGST" min="0.01" step="0.01" value="0" max="999999.99"/>
                                    </div>
                                </div>
                            </fieldset>
                            <datalist id="typeOptions">
                                <?php
                                    $options = $function->getArrayOptions_All_Table('client_expenses', array('type type'));
                                    foreach ($options as $option) {
                                        echo "<option value='$option[type]'></option>";
                                    }
                                ?>
                            </datalist>
                            <hr>
                            <div class="row">
                                <div class="form-group col-xs-8">
                                    <center><b>TOTAL</b></center>
                                </div>
                                <div class="form-group col-xs-2">
                                    <input type="number" placeholder="Total Amount" title="Amount total of this Invoice/Challan" class="form-control totalAmount"  disabled="" />
                                </div>
                                <div class="form-group col-xs-1">
                                    <input type="number" placeholder="Total GST" title="GST total of this Invoice/Challan" class="form-control totalGST" disabled="" />
                                </div>
                                <div class="form-group col-sm-offset-8 col-xs-3">
                                    <input type="number" placeholder="Grand Total" title="Grand Total" class="form-control totalGrand" disabled="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addExpense">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save Data"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function calulateTotal(){
        var totalAmount=0, totalGST=0, totalGrand=0;
        $('.expenseAmount').each(function() {
            totalAmount += parseFloat(this.value, 10);
        });
        $('.expenseGST').each(function() {
            totalGST += parseFloat(this.value, 10);
        });
        totalGrand = totalAmount+totalGST;
        totalGrand = totalGrand.toFixed(2);
        $('.totalAmount').val(totalAmount);
        $('.totalGST').val(totalGST);
        $('.totalGrand').val(totalGrand);
    }
    $(function(){
        $('#content').on('click', '.delete-row', function(event) {
            $(this).closest('.row').remove();
            calulateTotal();
        });

        $('#content').on('click', '.add-row', function(event) {
            var form = $('#content fieldset');
            form.find('.chzn-select').chosen("destroy");
            var row = form.children().eq(0).html(),
                newRow = $('<div class="row"/>').html(row).append('<div class="form-group col-xs-1">'+
                                    '<label for="" class="control-label"> &nbsp;  </label><br>'+
                                    '<a href="#" title="Click Here to toggle" class="add-new-option-btn delete-row text-center"><i class="icon-trash"></i></a>'+
                                '</div>');
                newRow = form.append(newRow);
            newRow.find('.chzn-select').chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, not found!"
            }).trigger("chosen:updated");
        });

        $('#content').on('change', '.expenseAmount, .expenseGST', function(event) {
            calulateTotal();
        });
    });
</script>