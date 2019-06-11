<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} $stock = $_GET['stock']; ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add <?php echo $stock; ?> Spare to Stock</h5>
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
                            <div class="form-group col-xs-5">
                                <?php
                                if ($_SESSION['SESS__azz_level'] > 5) {
                                    if ($stock === "old") {
                                        $options = $function->getArrayOptions_All_Table('partners_centers', array('center_id id', 'name name', 'code code', 'city city'), " WHERE ul_type = 'Center' ");
                                        echo '<label for="party" class="control-label">Center <sup>*</sup></label>
                                                <input type="hidden" name="stock" value="Old In"/>
                                                <select id="party" name="party"  class="form-control chzn-select" required="">
                                                    <option value="">Select...</option>';
                                    }else{
                                        $options = $function->getArrayOptions_All_Table('partners_centers', array('center_id id', 'name name', 'code code', 'city city'), " WHERE ul_type = 'Party' ");
                                        echo '<label for="party" class="control-label">Party <sup>*</sup></label>
                                                <input type="hidden" name="stock" value="In"/>
                                                <select id="party" name="party"  class="form-control chzn-select" required="">
                                                    <option value="">Select...</option>';
                                    }
                                    foreach ($options as $option) {
                                        echo '<option value="'.$option['id'].'">'.$option['name'].' - '.$option['city'].' ['.$option['code'].']</option>';
                                    }
                                }else{
                                    if ($stock === "old") {
                                        echo '<label for="party" class="control-label">Center <sup>*</sup></label>
                                                    <input type="hidden" name="stock" value="Old In"/>
                                                    <select id="party" name="party"  class="form-control" readonly="" required="">
                                                        <option value="1">'.CLIENT_COMPANY.'</option>';
                                    }else{
                                        echo '<label for="party" class="control-label">Center <sup>*</sup></label>
                                                    <input type="hidden" name="stock" value="In"/>
                                                    <select id="party" name="party"  class="form-control" readonly="" required="">
                                                        <option value="1">'.CLIENT_COMPANY.'</option>';
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-2">
                                <label for="date" class="control-label">Date <sup>*</sup></label>
                                <input type="date" id="date" name="date" placeholder="Inward Date" title="Inward Date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required=""/>
                            </div>
                            <div class="form-group col-xs-3">
                                <label for="code" class="control-label">Invoice/Challan <sup>*</sup></label>
                                <input type="text" minlength="1" maxlength="20" id="code" name="challan" placeholder="Challan/Invoice No." title="Manual Challan Number" class="form-control"  required=""/>
                            </div>
                            <div class="form-group col-xs-2" id="heading_select">
                                <label class="control-label">Type <sup>*</sup></label>
                                <select data-placeholder="Choose Category" name="type" class="form-control" required="">
                                    <option value="">Select...</option>
                                    <option value="Challan">Challan</option>
                                    <option value="Invoice">Invoice</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <a class="btn btn-block btn-info add-row">
                                    <i class="icon-plus"></i> Add One More Spare
                                </a>
                            </div>
                        </div>
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-xs-5" id="heading_select">
                                    <label class="control-label">Spare Part <sup>*</sup></label>
                                    <select data-placeholder="Choose Spare" name="spareName[]" class="form-control chzn-select" tabindex="5" required="">
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
                                    <input type="number" name="spareQuantity[]" placeholder="No." title="Quantity of this spare" class="form-control spareQuantity" min="1" step="1" max="65000"  required=""/>
                                </div>
                                <div class="form-group col-xs-2">
                                    <label class="control-label">Amount <sup>*</sup></label>
                                    <input type="number" name="spareAmount[]" placeholder="Amount" title="Amount of this spare" class="form-control spareAmount" min="0.01" step="0.01" max="99999.99"  required=""/>
                                </div>
                                <div class="form-group col-xs-2">
                                    <label class="control-label">GST <sup>*</sup></label>
                                    <input type="number" name="spareGST[]" placeholder="GST" title="GST of this spare" class="form-control spareGST" min="0.01" step="0.01" max="99999.99" required=""/>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="row">
                            <div class="form-group col-xs-5">
                                <center><b>TOTAL</b></center>
                            </div>
                            <div class="form-group col-xs-2">
                                <input type="number" placeholder="Total Quantity" title="Quantity total of this Invoice/Challan" class="form-control totalQuantity"  disabled="" />
                            </div>
                            <div class="form-group col-xs-2">
                                <input type="number" placeholder="Total Amount" title="Amount total of this Invoice/Challan" class="form-control totalAmount"  disabled="" />
                            </div>
                            <div class="form-group col-xs-2">
                                <input type="number" placeholder="Total GST" title="GST total of this Invoice/Challan" class="form-control totalGST" disabled="" />
                            </div>
                            <div class="form-group col-sm-offset-7 col-xs-4">
                                <input type="number" placeholder="Grand Total" title="Grand Total" class="form-control totalGrand" disabled="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addInChallan">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save Challan"/>
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
        var totalQuantity=0, totalAmount=0, totalGST=0, totalGrand=0;
        $('.spareQuantity').each(function() {
            totalQuantity += parseInt(this.value, 10);
        });
        $('.spareAmount').each(function() {
            totalAmount += parseFloat(this.value, 10);
        });
        $('.spareGST').each(function() {
            totalGST += parseFloat(this.value, 10);
        });
        totalGrand = totalAmount+totalGST;
        totalGrand = totalGrand.toFixed(2);
        $('.totalQuantity').val(totalQuantity);
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

        $('#content').on('change', '.spareQuantity, .spareAmount, .spareGST', function(event) {
            calulateTotal();
        });
    });
</script>