<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5 id="pageTitle">Register Complaint Ticket</h5>
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
                            <div class="col-xs-12 panel-group" id="">
                                <div class="panel panel-primary customerPanel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Customer Details</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>CRN #</label>
                                                <input type="text" class="form-control" autocomplete="off" placeholder="Customer Relationship Number" name="form[customer_id]" id="crn" pattern="[0-9A-Za-z]{1,12}"/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>Mobile <sup>*</sup></label>
                                                <input type="tel" class="form-control" autocomplete="off" placeholder="Mobile Number" name="customer[mobile]" id="mobile" pattern="[0-9]{10}" maxlength="10" required/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>Alternate Contact</label>
                                                <input type="tel" class="form-control" autocomplete="off" placeholder="Alternate Mobile Number" name="customer[alternate_mobile]" id="alternate_mobile" pattern="[0-9]{10}" maxlength="10" />
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>Email</label>
                                                <input type="email" name="customer[email]" id="email" class="form-control" autocomplete="off" placeholder="Email Address" maxlength="50"/>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-3 col-xs-3 form-group">
                                                <input type="text" class="form-control" placeholder="Customer Name" name="sms[name]" id="name" required="" readonly="" />
                                              </div>
                                              <div class="col-sm-9 col-xs-9 form-group">
                                                <input type="text" class="form-control" placeholder="Address" name="sms[address]" id="address"  required="" readonly="" />
                                              </div>
                                            </div>
                                            <input type="number" name="form[customer_product_id]" id="customer_product_id" style="display:none;visibility: hidden;" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary complaintPanel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Ticket Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-8 ticketPlot">
                                                    <div class="customerProducts"></div>
                                                    <div class="row">
                                                          <div class="col-xs-6 col-lg-6 form-group">
                                                            <label>Quantity <sup>*</sup></label>
                                                            <input type="number" class="form-control" name="form[quantity]" id="quantity" min="1" max="250" value="1" placeholder="in Pcs."/>
                                                          </div>
                                                          <div class="col-xs-6 col-lg-6 form-group">
                                                            <label>Warranty Status <sup>*</sup></label>
                                                            <select class="form-control chzn-select" name="product[warranty_status]" id="warranty_status" required>
                                                              <option value="">Select ...</option>
                                                              <option value="Under Warranty">Under Warranty</option>
                                                              <option value="Out Of Warranty">Out Of Warranty</option>
                                                              <option value="Under AMC">Under AMC</option>
                                                              <option value="Stock Piece">Stock Piece</option>
                                                              <option value="Status Unknown">Status Unknown</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12 col-xs-12 form-group">
                                                        <label>Problem/Issues <sup>*</sup></label>
                                                        <input class="form-control" placeholder="Enter Details" name="form[details]" id="details" required="" pattern="[a-zA-Z0-9 ,.-]{10,}" list="issueSuggestions">
                                                        <datalist id="issueSuggestions">
                                                            <option value="Product Not Working">
                                                            <option value="Current Problem">
                                                            <option value="Heating Problem">
                                                            <option value="Dented Piece">
                                                            <option value="Assembly Problem">
                                                            <option value="Product Breakage">
                                                            <option value="Tank Leakage">
                                                            <option value="Cut-Out Problem">
                                                            <option value="Indicator Problem">
                                                            <option value="Sound Problem">
                                                        </datalist>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-xs-6 col-lg-4 form-group has-warning">
                                                        <label>Center City </label>
                                                        <select class="form-control chzn-select" id="centerCity" name="centerCity">
                                                          <option value="">Select ...</option>
                                                        </select>
                                                      </div>
                                                      <div class="col-xs-6 col-lg-4 form-group has-warning">
                                                        <label>Center <sup>*</sup></label>
                                                        <input type="hidden" name="sms[centerContact]" id="centerContact" value="" required="">
                                                        <select class="form-control chzn-select" name="form[center_id]" id="center" required>
                                                          <option value="">Select Center City First ...</option>
                                                        </select>
                                                      </div>
                                                      <div class="col-xs-12 col-lg-4 form-group has-warning">
                                                        <label>Estimated TAT <sup>*</sup></label>
                                                        <input type="date" class="form-control" name="form[est_resolution_date]" id="erd" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 day', time())); ?>" value="<?php echo date('Y-m-d', strtotime('+3 day', time())); ?>" placeholder="YYYY-MM-DD" required/>
                                                      </div>
                                                      <!-- <div class="col-xs-6 col-lg-3 form-group has-warning">
                                                        <label>Complaint Code</label>
                                                        <input type="text" class="form-control" placeholder="Manual Complaint Code" name="form[code]" id="complaintCode" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" title="Leave Blank to Auto generate"/>
                                                      </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 productPlot">
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th>Brand : </th>
                                                                <td><input name="sms[brand]" readonly="" id="plot_brand" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Product : </th>
                                                                <td><input name="sms[product]" readonly="" id="plot_product" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Quantity : </th>
                                                                <td><input readonly="" id="plot_quantity" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Warranty : </th>
                                                                <td><input readonly="" id="plot_warranty" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Purchased On : </th>
                                                                <td><input type="date" readonly="" id="plot_purchase" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Warranty Status : </th>
                                                                <td><input readonly="" id="plot_warranty_status" ></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addTicket">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Register Ticket"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#mobile, #alternate_mobile").on("keyup", function(event){
            var id = $(this).val();
            if(id.length != 10) return;
            var action = "fetchDependentSelect",
                entity = "mobile-CustomerProduct",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Customer with Mobile <b>"+id+"</b> is not in our Database <a href='/BestWebs?module=warranty&mode=add&type=new' target='_blank'> Click Here to add </a> or Try another.", 10000);
                        $(".ajax-form")[0].reset();
                        return;
                    }
                    plotCustomer(id, msg);
                }
            });
        });

        $("#crn").on("change", function(event){
            var id = $(this).val();
            var action = "fetchDependentSelect",
                entity = "crn-CustomerProduct",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Customer with CRN <b>#"+id+"</b> is not in our Database <a href='/BestWebs?module=warranty&mode=add&type=new' target='_blank'> Click Here to add New</a> or Try another.", 10000);
                        $(".ajax-form")[0].reset();
                        return;
                    }
                    plotCustomer(id, msg);
                }
            });
        });

        $("body").on('click', '.add-new-option-btn', function(event) {
            event.preventDefault();
            var row = $(this).closest('tr'),
                months,
                plot_warranty_status,
                today = new Date(),
                warranty = row.find('.warranty').text(),
                purchase = new Date(row.find('.purchase_date').text()),
                quantity = row.find('.quantity').text();
            $("#customer_product_id").val(row.find('.customer_product').text());
            $("#mobile").val(row.find('.mobile').text());
            $("#alternate_mobile").val(row.find('.alternate_mobile').text());
            $("#name").val(row.find('.name').text());
            $("#crn").val(row.find('.crn').text());
            $("#address").val(row.find('.address').text());
            $("#email").val(row.find('.email').text());
            $("#quantity").attr('max', quantity);
            $("#plot_purchase").val(row.find('.purchase_date').text());
            $("#plot_warranty").val(warranty+" Months");
            $("#plot_product").val(row.find('.product').text());
            $("#plot_brand").val(row.find('.brand').text());
            $("#plot_quantity").val(quantity);
            $("#centerCity").val(row.find('.district').text()).chosen().trigger('chosen:updated');
            $("#centerCity").chosen().trigger('change');

            months = (today.getFullYear() - purchase.getFullYear()) * 12;
            months -= purchase.getMonth() + 1;
            months += today.getMonth();
            months = months <= 0 ? 0 : months;
            plot_warranty_status = warranty-months;
            if(plot_warranty_status > 0){
                $("#warranty_status").val("Under Warranty").chosen().trigger('chosen:updated');
                $("#plot_warranty_status").val(plot_warranty_status+" Months Left");
            }else{
                plot_warranty_status = plot_warranty_status*1;
                $("#warranty_status").val("Out Of Warranty").chosen().trigger('chosen:updated');
                $("#plot_warranty_status").val(plot_warranty_status+" Months Exceed");
            }
            $("#modal").modal("hide");
        });

        <?php
            echo 'var products = '.json_encode($function->getArrayOptions_All_Table('client_products', array('product_id id', 'category category', 'name product', 'model model'))).',
                      centers = '.json_encode($function->getArrayOptions_All_Table('partners_centers', array('center_id id', 'city city', 'name center', 'phone1 phone'), 'WHERE ul_status > 0')).';';
            if(isset($_GET["mobile"])){
                echo '$("#mobile").val("'.$_GET["mobile"].'").trigger("keyup")';
            }elseif(isset($_GET["crn"])){
                echo '$("#crn").val("'.$_GET["crn"].'").trigger("change")';
            }
        ?>

        var productCatAdded = {};
        $.each(products, function(key, value) {
            if (productCatAdded[value.category] === undefined) {
              productCatAdded[value.category] = '';
              $("#productCat").append('<option value="' + value.category + '">' + value.category + '</option>');
            }
        });
        $("#productCat").trigger("chosen:updated");

        $("#productCat").chosen().on("change", function(event) {
            cat = $(this).val();
            $("#product").html('<option value="">Select ... </option>');
            $("#productModel").html('<option value="">Select ... </option>');
            var productAdded = {};
            $.each(products, function(key, value) {
                if ((value.category === cat) && (productAdded[value.product] === undefined)) {
                  productAdded[value.product] = '';
                  $("#product").append('<option value="' + value.product + '">' + value.product + '</option>');
                }
            });
            $("#product").trigger("chosen:updated");
        });

        $("#product").chosen().on("change", function(event) {
            product = $(this).val();
            $("#productModel").html('<option value="">Select ... </option>');
            var productModelAdded = {};
            $.each(products, function(key, value) {
                if ((value.product === product) && (productModelAdded[value.id] === undefined)) {
                  productModelAdded[value.id] = '';
                  $("#productModel").append('<option value="' + value.id + '">' + value.model + '</option>');
                }
            });
            $("#productModel").trigger("chosen:updated");
        });

        $("#productModel").chosen().on("change", function(event) {
            var productId = $(this).val(),
                productModelText = $( "#productModel option:selected" ).text();
            $("#productModelText").val(productModel);
            product = products.filter(function (product) { return product.id === productId });
            plotProduct(product[0]);
            $('#productSearch').val(productId);
        });

        var centerCityAdded = {};
        $.each(centers, function(key, value) {
            if (centerCityAdded[value.city] === undefined) {
              centerCityAdded[value.city] = '';
              $("#centerCity").append('<option value="' + value.city + '">' + value.city + '</option>');
            }
        });
        $("#centerCity").trigger("chosen:updated");

        $("#centerCity").chosen().on("change", function(event) {
            city = $(this).val();
            $("#center").html('<option value="">Select Center ... </option>');
            var centerAdded = {};
            $.each(centers, function(key, value) {
                if ((value.city === city) && (centerAdded[value.id] === undefined)) {
                  centerAdded[value.id] = '';
                  $("#center").append('<option data-phone="' + value.phone + '" value="' + value.id + '">' + value.center + '</option>');
                }
            });
            $("#center").trigger("chosen:updated");
        });

        $("#center").chosen().on("change", function(event) {
            centerContact = $( "#center option:selected" ).attr("data-phone");
            $("#centerContact").val(centerContact);
        });

        <?php
            $type = $_GET["type"];
            if ($type != "new" && $level >= 8) {
                $id = (int) $type;
                $ticket = $function->getDetail_ticket($id);
                echo "var id = $id,
                      details = ".json_encode($ticket).",
                      customer_products = ".json_encode($function->getArray_customersProduct(0,1000, " WHERE cus.ul_code = :id ", array(":id"=>$ticket["crn"]))).";";
                    ?>
                    if(details){
                        if(details.status >= 0) showResponse("info", "<b>Inventory & Billing will not be affected by editing closed ticket details.</b>");
                        $('.complaintPanel').append('<input type="hidden" name="form[complaint_id]" value="'+id+'">');
                        $(".customerPanel").remove();
                        $(".productPlot").remove();
                        $(".ticketPlot").attr("class", "col-xs-12");

                        var customerProducts = '<div class="row">'+
                                                      '<div class="col-xs-8 col-lg-8 form-group">'+
                                                        '<label>Customer Products <sup>*</sup></label>'+
                                                        '<select class="form-control" name="form[customer_product_id]" id="customer_product_id" required>'+
                                                            '<option value="">Select Product ...</option>';
                        $.each(customer_products, function(index, el) {
                            customerProducts += '<option quantity="'+el.quantity+'" value="'+el.customer_product_id+'">'+el.brand+' '+el.product+' '+el.model+' [Purchase: '+el.purchase_date+', '+el.quantity+' pc, '+el.warranty+']</option>';
                        });
                        customerProducts += '</select>'+
                                        '</div>'+
                                        '<div class="col-xs-4 col-lg-4 form-group">'+
                                            '<label>Customer <sup>*</sup></label>'+
                                            '<select class="form-control" name="form[customer_id]" id="customer_id" readonly="" required>'+
                                            '<option value="'+details.crn+'">'+details.customer+' ['+details.crn+']</option>'+
                                        '</div>'+
                                    '</div>';
                        $(".customerProducts").html(customerProducts);
                        $("body").on('change', '#customer_product_id', function(event) {
                            event.preventDefault();
                            var maxQuantity = $("option:selected", this).attr("quantity");
                            $("#quantity").attr('max', maxQuantity);
                        });
                        $("#customer_product_id").val(details.customer_product_id).change();
                        $("#quantity").val(details.quantity);
                        $("#warranty_status").val(details.warranty).trigger('chosen:updated');
                        $("#details").val(details.productCat);
                        $("#erd").removeAttr('min max');
                        $("#details").val(details.details);
                        $("#centerCity").val(details.centerCity).trigger('chosen:updated').change();
                        $("#center").val(details.center_id).trigger('chosen:updated').change();

                        $('#pageTitle').html('Edit Complaint #'+details.code);
                        $('#submit').val("Update Complaint");
                        if(details.erd) $("#erd").val(details.erd.split('/').reverse().join('-'));
                    }
                    <?php
            }
        ?>
    });
</script>