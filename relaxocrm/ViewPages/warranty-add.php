<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
if (isset($_GET['crn']) && ($crn = (int) filter_data($_GET['crn']))) {
    $customer = $function->getArrayOptions_All_Table('clients_customers', array('customer_id id', 'name name'), " WHERE ul_customer_id = :id OR ul_code = :id LIMIT 1 ", array(":id"=>$crn))[0];
}else{
    $customer = false;
}
?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Register Product Warranty & Customer</h5>
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
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Customer Details</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <?php
                                            if ($customer) {
                                                ?>
                                            <div class="row">
                                              <div class="col-xs-6 form-group">
                                                <label>Customer Name</label>
                                                <input type="text" class="form-control" value="<?php echo $customer['name']; ?>" id="name" pattern="[a-zA-Z0-9. ,-]{2,50}" readonly="" />
                                              </div>
                                              <div class="col-xs-6 form-group">
                                                <label>CRN</label>
                                                <input type="text" class="form-control" value="<?php echo $customer['id']; ?>" name="customer_id" id="name" readonly="" />
                                              </div>
                                            </div>
                                                <?php
                                            }else{
                                                ?>
                                            <div class="row">
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>Customer Name <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Enter Name of Customer" name="form[name]" id="name" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" required/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>Area Pin <sup>*</sup></label>
                                                <input type="tel" class="form-control" placeholder="Area pin Code" name="form[city_pin]" id="pin" pattern="[0-9]{6}" maxlength="6" onchange="this.setCustomValidity(this.validity.patternMismatch ? '6 Digit Area Pin Code' : '');" title="Please Enter Correct Area Pin Code, It will be used for contact" data-toggle="tooltip" required/>
                                              </div>
                                              <div class="col-sm-6 col-xs-12 form-group" id="locationField">
                                                <label>Address <sup>*</sup></label>
                                                <input class="form-control" placeholder="Address" name="form[address]" rows="1" id="address" onFocus="geolocate()" required>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-3 col-xs-6">
                                                <label>State  <sup>*</sup></label>
                                                <select class="form-control chzn-select" id="state"  minlength="2" required="">
                                                  <option value="">Select ...</option>
                                                  <OPTION VALUE="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</OPTION>
                                                  <OPTION VALUE="ANDHRA PRADESH">ANDHRA PRADESH</OPTION>
                                                  <OPTION VALUE="ARUNANCHAL PRADESH">ARUNANCHAL PRADESH</OPTION>
                                                  <OPTION VALUE="ASSAM">ASSAM</OPTION>
                                                  <OPTION VALUE="BIHAR">BIHAR</OPTION>
                                                  <OPTION VALUE="CHANDIGARH">CHANDIGARH</OPTION>
                                                  <OPTION VALUE="CHHATTISGARH">CHHATTISGARH</OPTION>
                                                  <OPTION VALUE="DADAR & NAGAR HAVELI">DADAR & NAGAR HAVELI</OPTION>
                                                  <OPTION VALUE="DAMAN & DIU">DAMAN & DIU</OPTION>
                                                  <OPTION VALUE="DELHI">DELHI</OPTION>
                                                  <OPTION VALUE="GOA">GOA</OPTION>
                                                  <OPTION VALUE="GUJRAT">GUJRAT</OPTION>
                                                  <OPTION VALUE="HARYANA">HARYANA</OPTION>
                                                  <OPTION VALUE="HIMACHAL PRADESH">HIMACHAL PRADESH</OPTION>
                                                  <OPTION VALUE="JAMMU & KASHMIR">JAMMU & KASHMIR</OPTION>
                                                  <OPTION VALUE="JHARKHAND">JHARKHAND</OPTION>
                                                  <OPTION VALUE="KARNATAKA">KARNATAKA</OPTION>
                                                  <OPTION VALUE="KERALA">KERALA</OPTION>
                                                  <OPTION VALUE="LAKSHADWEEP">LAKSHADWEEP</OPTION>
                                                  <OPTION VALUE="MADHYA PRADESH">MADHYA PRADESH</OPTION>
                                                  <OPTION VALUE="MAHARASHTRA">MAHARASHTRA</OPTION>
                                                  <OPTION VALUE="MANIPUR">MANIPUR</OPTION>
                                                  <OPTION VALUE="MEGHALAYA">MEGHALAYA</OPTION>
                                                  <OPTION VALUE="MIZORAM">MIZORAM</OPTION>
                                                  <OPTION VALUE="NAGALAND">NAGALAND</OPTION>
                                                  <OPTION VALUE="ODISHA">ODISHA</OPTION>
                                                  <OPTION VALUE="PONDICHERRY">PONDICHERRY</OPTION>
                                                  <OPTION VALUE="PUNJAB">PUNJAB</OPTION>
                                                  <OPTION VALUE="RAJASTHAN">RAJASTHAN</OPTION>
                                                  <OPTION VALUE="SIKKIM">SIKKIM</OPTION>
                                                  <OPTION VALUE="TAMIL NADU">TAMIL NADU</OPTION>
                                                  <OPTION VALUE="TELANGANA">TELANGANA</OPTION>
                                                  <OPTION VALUE="TRIPURA">TRIPURA</OPTION>
                                                  <OPTION VALUE="UTTAR PRADESH">UTTAR PRADESH</OPTION>
                                                  <OPTION VALUE="UTTARAKHAND">UTTARAKHAND</OPTION>
                                                  <OPTION VALUE="WEST BENGAL">WEST BENGAL</OPTION>
                                                </select>
                                              </div>
                                              <div class="col-sm-3 col-xs-6">
                                                <label>District  <sup>*</sup></label>
                                                <select class="form-control chzn-select" id="district" required="">
                                                  <option value="">Select State First</option>
                                                </select>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>City <sup>*</sup></label>
                                                <select class="form-control chzn-select" id="cities" name="city" required="">
                                                  <option value="">Select District First</option>
                                                </select>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>Land Mark</label>
                                                <input type="text" class="form-control" placeholder="Landmark" name="form[landmark]" id="landmark" pattern="[0-9a-zA-Z .,-]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter City, Minimum 2 & Maximum 100 and only - , . allowed' : '');" />
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>Mobile <sup>*</sup></label>
                                                <input type="tel" class="form-control" placeholder="Mobile Number" name="form[mobile]" id="mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip" required/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>Alternate Contact</label>
                                                <input type="tel" class="form-control" placeholder="Alternate Mobile Number" name="form[alternate_mobile]" id="alternate_mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip"/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group has-success">
                                                <label>Email</label>
                                                <input type="email" name="form[email]" id="email" class="form-control" placeholder="Email Address" maxlength="50"/>
                                              </div>
                                              <div class="col-sm-3 col-xs-6 form-group">
                                                <label>Customer Company</label>
                                                <input type="text" class="form-control" placeholder="Name of Customer Company" name="form[company]" id="name" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');"/>
                                              </div>
                                            </div>
                                                <?php
                                            }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Product Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                  <div class="col-xs-6 col-lg-3 form-group">
                                                    <label>Product Brand <sup>*</sup></label>
                                                    <select class="form-control chzn-selct" name="productBrand" id="productBrand" required="">
                                                      <option value="">Select ...</option>
                                                      <option value="Oxaler">Oxaler</option>
                                                      <option value="Relaxo">Relaxo</option>
                                                    </select>
                                                  </div>
                                                  <div class="col-xs-6 col-lg-3 form-group">
                                                    <label>Product Category <sup>*</sup></label>
                                                    <select class="form-control chzn-selct" name="productCat" id="productCat" required="">
                                                      <option value="">Select Brand First ...</option>
                                                    </select>
                                                  </div>
                                                  <div class="col-xs-6 col-lg-3 form-group">
                                                    <label>Product <sup>*</sup></label>
                                                    <select class="form-control chzn-select" name="productName" id="product" required="">
                                                      <option value="">Select Category First...</option>
                                                    </select>
                                                  </div>
                                                  <div class="col-xs-6 col-lg-3 form-group">
                                                    <label>Model <sup>*</sup></label>
                                                    <input type="hidden" name="productModel" id="productModelText" value="">
                                                    <select class="form-control chzn-select" name="product[product_id]" id="productModel" required>
                                                      <option value="">Select Product First ...</option>
                                                    </select>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-xs-6 col-lg-3 form-group">
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
                                                  <div class="col-xs-6 col-lg-3 form-group">
                                                    <label>Purchase Date</label>
                                                    <input type="date" class="form-control datepicker" name="product[purchase_date]" id="purchase_date" max="<?php echo date('Y-m-d'); ?>" placeholder="YYYY-MM-DD"/>
                                                  </div>
                                                  <div class="col-xs-4 col-lg-2 form-group">
                                                    <label>Quantity <sup>*</sup></label>
                                                    <input type="number" class="form-control" name="product[quantity]" id="purchase_date" min="1" max="250" value="1" placeholder="in Pcs."/>
                                                  </div>
                                                  <div class="col-xs-4 col-lg-2 form-group has-success">
                                                    <label>S/R No. (Code)</label>
                                                    <input type="text" class="form-control" id="productCode" name="product[code]" name="productcode" maxlength="20" placeholder="Code"/>
                                                  </div>
                                                  <div class="col-xs-4 col-lg-2 form-group has-success">
                                                    <label>Product Search</label>
                                                    <input type="text" class="form-control" id="productSearch" maxlength="20" placeholder="Search ..."/>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Dealer Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>Purchased From</label>
                                                    <select class="form-control chzn-select" name="product[purchased_from]" id="purchased_from">
                                                      <option value="">Select ...</option>
                                                      <option value="Wholesaler">Wholesaler</option>
                                                      <option value="Dealer">Dealer</option>
                                                      <option value="Online From Vendor">Online From Vendor</option>
                                                      <option value="Online From Company">Online From Company</option>
                                                      <option value="Directly From Company">Directly From Company</option>
                                                      <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>Name </label>
                                                    <input type="text" class="form-control" placeholder="Name of Dealer" name="product[dealer]" id="dealer" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');"/>
                                                  </div>
                                                <div class="col-sm-6 col-xs-12 form-group">
                                                    <label for="dealer_address">Address</label>
                                                    <textarea class="form-control" placeholder="Address" name="product[dealer_address]" id="dealer_address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="1"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>Area Pin</label>
                                                    <input type="tel" class="form-control" placeholder="Area pin Code" name="product[dealer_pin]" id="dealer_pin" pattern="[0-9]{6}" maxlength="6" onchange="this.setCustomValidity(this.validity.patternMismatch ? '6 Digit Area Pin Code' : '');" title="Please Enter Correct Area Pin Code, It will be used for contact" data-toggle="tooltip"/>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>State </label>
                                                    <select class="form-control chzn-select" id="dealer_state"  minlength="2">
                                                      <option value="">Select ...</option>
                                                      <OPTION VALUE="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</OPTION>
                                                      <OPTION VALUE="ANDHRA PRADESH">ANDHRA PRADESH</OPTION>
                                                      <OPTION VALUE="ARUNANCHAL PRADESH">ARUNANCHAL PRADESH</OPTION>
                                                      <OPTION VALUE="ASSAM">ASSAM</OPTION>
                                                      <OPTION VALUE="BIHAR">BIHAR</OPTION>
                                                      <OPTION VALUE="CHANDIGARH">CHANDIGARH</OPTION>
                                                      <OPTION VALUE="CHHATTISGARH">CHHATTISGARH</OPTION>
                                                      <OPTION VALUE="DADAR & NAGAR HAVELI">DADAR & NAGAR HAVELI</OPTION>
                                                      <OPTION VALUE="DAMAN & DIU">DAMAN & DIU</OPTION>
                                                      <OPTION VALUE="DELHI">DELHI</OPTION>
                                                      <OPTION VALUE="GOA">GOA</OPTION>
                                                      <OPTION VALUE="GUJRAT">GUJRAT</OPTION>
                                                      <OPTION VALUE="HARYANA">HARYANA</OPTION>
                                                      <OPTION VALUE="HIMACHAL PRADESH">HIMACHAL PRADESH</OPTION>
                                                      <OPTION VALUE="JAMMU & KASHMIR">JAMMU & KASHMIR</OPTION>
                                                      <OPTION VALUE="JHARKHAND">JHARKHAND</OPTION>
                                                      <OPTION VALUE="KARNATAKA">KARNATAKA</OPTION>
                                                      <OPTION VALUE="KERALA">KERALA</OPTION>
                                                      <OPTION VALUE="LAKSHADWEEP">LAKSHADWEEP</OPTION>
                                                      <OPTION VALUE="MADHYA PRADESH">MADHYA PRADESH</OPTION>
                                                      <OPTION VALUE="MAHARASHTRA">MAHARASHTRA</OPTION>
                                                      <OPTION VALUE="MANIPUR">MANIPUR</OPTION>
                                                      <OPTION VALUE="MEGHALAYA">MEGHALAYA</OPTION>
                                                      <OPTION VALUE="MIZORAM">MIZORAM</OPTION>
                                                      <OPTION VALUE="NAGALAND">NAGALAND</OPTION>
                                                      <OPTION VALUE="ODISHA">ODISHA</OPTION>
                                                      <OPTION VALUE="PONDICHERRY">PONDICHERRY</OPTION>
                                                      <OPTION VALUE="PUNJAB">PUNJAB</OPTION>
                                                      <OPTION VALUE="RAJASTHAN">RAJASTHAN</OPTION>
                                                      <OPTION VALUE="SIKKIM">SIKKIM</OPTION>
                                                      <OPTION VALUE="TAMIL NADU">TAMIL NADU</OPTION>
                                                      <OPTION VALUE="TELANGANA">TELANGANA</OPTION>
                                                      <OPTION VALUE="TRIPURA">TRIPURA</OPTION>
                                                      <OPTION VALUE="UTTAR PRADESH">UTTAR PRADESH</OPTION>
                                                      <OPTION VALUE="UTTARAKHAND">UTTARAKHAND</OPTION>
                                                      <OPTION VALUE="WEST BENGAL">WEST BENGAL</OPTION>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>District </label>
                                                    <select class="form-control chzn-select" id="dealer_district">
                                                      <option value="">Select State First</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label>City</label>
                                                    <select class="form-control chzn-select" id="dealer_cities" name="pin">
                                                      <option value="">Select District First</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addWarranty">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Register Product"/>
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
        // Load State, District, City On Pin CHange
        $("#pin").on("keyup", function(event){
            var id = $(this).val();
            if(id.length != 6) return;
            var action = "fetchDependentSelect",
                entity = "pin-StateDistrictCity",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Pincode <b>"+id+"</b> is not in our Database <a href='/BestWebs?module=pincode&mode=add&type=new' target='_blank'> Click Here to add </a> or Try another.", 10000);
                        $("#pin").val("");
                        return;
                    }

                    var citiesAdded = {};
                    $("#cities").html("");
                    $("#district").html("<option value='"+msg[0].district+"'>"+msg[0].district+"</option>").chosen().trigger('chosen:updated');
                    $("#state").val(msg[0].state).chosen().trigger('chosen:updated');
                    $.each(msg, function(index,data){
                        if (citiesAdded[data.cities] === undefined) {
                            citiesAdded[data.cities] = '';
                            $("#cities").append('<option value="'+id+'">'+data.cities+' ('+id+')</option>');
                        }
                    });
                    $("#cities").trigger("chosen:updated");
                }
            }, true);
        });

        // Load District on state CHange
        $("#state").chosen().on("change", function(event){
            var id = $(this).val();
            if(! id) return;
            var action = "fetchDependentSelect",
                entity = "state-DistrictCity",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    $("#cities").html("<option value=''>Select District First ...</option>").chosen().trigger('chosen:updated');
                    $("#district").html("<option value=''>Select ...</option>");
                    $("#pin").val("");
                    $.each(msg, function(index,data){
                        $("#district").append('<option value="'+data.district+'">'+data.district+'</option>');
                    });
                    $("#district").trigger("chosen:updated");
                }
            }, true);
        });

        // Load City On District CHange
        $("#district").chosen().on("change", function(event){
            var id = $(this).val();
            if(! id) return;
            var action = "fetchDependentSelect",
                entity = "district-CityPin",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                console.log(msg);
                if(status === "success"){
                    $("#cities").html("<option value=''>Select ...</option>");
                    $("#pin").val("");
                    $.each(msg, function(index,data){
                        $("#cities").append('<option value="'+data.pin+'">'+data.cities+' ('+data.pin+')</option>');
                    });
                    $("#cities").trigger("chosen:updated");
                }
            }, true);
        });

        // Load Pin on city CHange
        $('#cities').chosen().on("change", function(event){
            var id = $(this).val();
            $("#pin").val(id);
        });

        <?php
            echo 'var products = '.json_encode($function->getArrayOptions_All_Table('client_products', array('product_id id', 'category category', 'brand brand', 'name product', 'model model' , 'spec1 spec1' , 'spec2 spec2'))).';';
        ?>

        $("#productBrand").chosen().on("change", function(event) {
          var brand = $(this).val();
          $("#productCat").html('<option value="">Select ... </option>');
          $("#product").html('<option value="">Select ... </option>');
          $("#productModel").html('<option value="">Select ... </option>');
          var productCatAdded = {};
          $.each(products, function(key, value) {
              if ((value.brand === brand) && (productCatAdded[value.category] === undefined)) {
                productCatAdded[value.category] = '';
                $("#productCat").append('<option value="' + value.category + '">' + value.category + '</option>');
              }
          });
          $("#productCat").trigger("chosen:updated");
        });

        $("#productCat").chosen().on("change", function(event) {
            var cat = $(this).val();
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
            var product = $(this).val();
            $("#productModel").html('<option value="">Select ... </option>');
            var productModelAdded = {};
            $.each(products, function(key, value) {
                if ((value.product === product) && (productModelAdded[value.id] === undefined)) {
                  productModelAdded[value.id] = '';
                  $("#productModel").append('<option value="' + value.id + '">' + value.model + ', ' + value.spec1 + ', ' + value.spec2 + '</option>');
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

        $("#dealer_pin").on("keyup", function(event){
            var id = $(this).val();
            if(id.length != 6) return;
            var action = "fetchDependentSelect",
                entity = "pin-StateDistrictCity",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Pincode <b>"+id+"</b> is not in our Database <a href='/BestWebs?module=pincode&mode=add&type=new' target='_blank'> Click Here to add </a> or Try another.", 10000);
                        $("#dealer_pin").val("");
                        return;
                    }

                    var citiesAdded = {};
                    $("#dealer_cities").html("");
                    $("#dealer_district").html("<option value='"+msg[0].district+"'>"+msg[0].district+"</option>").chosen().trigger('chosen:updated');
                    $("#dealer_state").val(msg[0].state).chosen().trigger('chosen:updated');
                    $.each(msg, function(index,data){
                        if (citiesAdded[data.cities] === undefined) {
                            citiesAdded[data.cities] = '';
                            $("#dealer_cities").append('<option value="'+id+'">'+data.cities+' ('+id+')</option>');
                        }
                    });
                    $("#dealer_cities").trigger("chosen:updated");
                }
            }, true);
        });

        $("#dealer_state").chosen().on("change", function(event){
            var id = $(this).val();
            if(! id) return;
            var action = "fetchDependentSelect",
                entity = "state-DistrictCity",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    $("#dealer_cities").html("<option value=''>Select District First ...</option>").chosen().trigger('chosen:updated');
                    $("#dealer_district").html("<option value=''>Select ...</option>");
                    $("#dealer_pin").val("");
                    $.each(msg, function(index,data){
                        $("#dealer_district").append('<option value="'+data.district+'">'+data.district+'</option>');
                    });
                    $("#dealer_district").trigger("chosen:updated");
                }
            }, true);
        });

        $("#dealer_district").chosen().on("change", function(event){
            var id = $(this).val();
            if(! id) return;
            var action = "fetchDependentSelect",
                entity = "district-CityPin",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                console.log(msg);
                if(status === "success"){
                    $("#dealer_cities").html("<option value=''>Select ...</option>");
                    $("#dealer_pin").val("");
                    $.each(msg, function(index,data){
                        $("#dealer_cities").append('<option value="'+data.pin+'">'+data.cities+' ('+data.pin+')</option>');
                    });
                    $("#dealer_cities").trigger("chosen:updated");
                }
            }, true);
        });

        $('#dealer_cities').chosen().on("change", function(event){
            var id = $(this).val();
            $("#dealer_pin").val(id);
        });
    });
</script>
<script>
      var placeSearch, autocomplete;
      var componentForm = {
        sublocality_level_1: "address",
        sublocality_level_2: "area",
        street_number: "number",
        route: "road",
        administrative_area_level_2: "city",
      //  administrative_area_level_1: "state",
      //  locality: "district",
      //  country: "country",
      //  postal_code: "pin"
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
            {types: ['geocode'], componentRestrictions: {country: "in"}});
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace(),
            address = '',
            entity = {
              "pincode" : "",
              "area" : "-",
              "city" : "",
              "district" : "",
              "state" : "",
              "longitude" : place.geometry.location.lng(),
              "latitude" : place.geometry.location.lat()
            };
        console.log(place);
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            address += place.address_components[i]["long_name"]+", ";
          }else if (addressType == "postal_code") {
            entity.pincode = place.address_components[i]["long_name"];
          }else if (addressType == "administrative_area_level_1") {
            entity.state = place.address_components[i]["long_name"].toUpperCase();
          }else if (addressType == "administrative_area_level_2") {
            entity.city = place.address_components[i]["long_name"];
          }else if (addressType == "locality") {
            entity.district = place.address_components[i]["long_name"];
          }else if (addressType == "sublocality_level_2") {
            entity.area = place.address_components[i]["long_name"];
          }
        }
        if(entity.pincode.length == 6){
          var action = "addPincode",
              varsArray = {"adminAjax":action, "form":entity};
          performAjax(varsArray , " ", function(status, msg){
            showResponse(status, msg);
            if(status != "success"){
              showResponse("danger", "First add this Pincode <b>"+entity.pincode+"</b> in our Database <a href='/BestWebs?module=pincode&mode=add&type=new&pincode="+entity.pincode+"' target='_blank'> Click Here to add </a> or Try another.", 1000000);
            }
          });
        }
        $("#address").val(address);
        $("#pin").val(entity.pincode).trigger('keyup');
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtKAKXmVLLe9JHloGPecG2jWP9tXPtM4s&libraries=places&callback=initAutocomplete" async defer></script>