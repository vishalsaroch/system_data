<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Service (Calling) User</h5>
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
                    <form class="ajax-form" action="" method="post" enctype="multipart/form-data" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);">
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                <label>Center <sup>*</sup></label>
                                <select name="form[center_id]" class="form-control" id="center" required="" readonly="">
                                    <option value="1" selected=""><?php echo CLIENT_TITLE; ?></option>
                                </select>
                            </div>
                            <div class="col-xs-6 form-group">
                                  <label>Name <sup>*</sup></label>
                                  <input type="text" class="form-control" placeholder="Name of User" name="form[name]" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" required=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                  <label>Father's Name</label>
                                  <input type="text" class="form-control" placeholder="Name of Father" name="form[father]" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" />
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" placeholder="Address" name="form[address]" id="address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <label>State </label>
                                <select class="form-control chzn-select" id="state" tabindex="1" name="form[state]">
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
                                <label>District </label>
                                <select class="form-control chzn-select" id="district" tabindex="6" name="form[district]">
                                  <option value="">Select State First</option>
                                </select>
                            </div>
                            <div class="col-sm-3 col-xs-6 form-group">
                                <label>City</label>
                                <select class="form-control chzn-select" id="cities" tabindex="7" name="form[city]">
                                  <option value="">Select District First</option>
                                </select>
                            </div>
                            <div class="col-sm-3 col-xs-6 form-group">
                                <label>Pin</label>
                                <input type="text" class="form-control" placeholder="Pin Code" pattern="[0-9]{6}" maxlength="6" id="pin" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 form-group">
                              <label>Mobile <small>(Username)</small> <sup>*</sup></label>
                              <input type="tel" class="form-control" placeholder="Contact Number" name="form[mobile]" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only 10 Digit numbers, Without leading +91 or 0' : '');" title="Please Enter Correct 10 Digit Mobile Number, with STD code and without - or +" data-toggle="tooltip" required/>
                            </div>
                            <div class="col-xs-4 form-group">
                                  <label>Email <small>(Username)</small></label>
                                  <input type="email" class="form-control" placeholder="Email Id" name="form[email]" maxlength="100" />
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>Date of Joining</label>
                              <input type="date" class="form-control datepicker" max="<?php echo date('Y-m-d'); ?>" min="1930-01-01" name="form[doj]" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 form-group">
                              <label>AADHAR</label>
                              <input type="text" title="Enter AADHAR number" class="form-control numberInput" pattern="[0-9 ]{14}" maxlength="14"  name="form[aadhar]" placeholder="Aadhar Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>PAN</label>
                              <input type="text" title="Enter PAN number" class="form-control" pattern="[0-9a-zA-Z]{10}" maxlength="10" minlength="10" name="form[pan]" placeholder="Pan Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>Date of Birth </label>
                              <input type="date" class="form-control datepicker" max="2000-01-01" min="1930-01-01" name="form[dob]" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 form-group has-success">
                              <label>Password <sup>*</sup></label>
                              <input type="password" class="form-control" id="reg_password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter' : ''); if(this.checkValidity()) form.cpassword.pattern=this.value;" placeholder="Password*" required="" />
                            </div>
                            <div class="col-xs-4 form-group has-success">
                              <label>Confirm Password <sup>*</sup></label>
                              <input type="password" class="form-control" id="reg_confirm-password" name="cpassword" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" placeholder="Confirm Password*" required="" />
                            </div>
                            <div class="col-xs-4 form-group">
                              <label>Designation</label>
                              <input type="text" class="form-control" value="<?php echo $levels[6]; ?>" readonly="" name="designation" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="level" value="6">
                                <input type="hidden" name="adminAjax" value="addUser">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save User"/>
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
            var row = form.children().eq(0).html(),
                newRow = $('<div class="row"/>').html(row).append('<div class="form-group col-xs-2">'+
                                    '<label for="" class="control-label"> &nbsp;  </label><br>'+
                                    '<a href="#" title="Click Here to toggle" class="add-new-option-btn delete-row text-center"><i class="icon-trash"></i></a>'+
                                '</div>');
                newRow = form.append(newRow);
            newRow.find('.chzn-select').chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, not found!"
            }).trigger("chosen:updated");
        });
    });
</script>
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
    });
    $(function(){
        <?php
            echo 'var options = '.json_encode($function->getArrayOptions_All_Table('client_products', array('category category', 'name product', 'hsn hsn'))).';';
        ?>
        var categoryOptions = [],
            productOptions = [],
            brandOptions = [];
            hsnOptions = [];
        $.each(options, function() {
            if(categoryOptions.includes()){}
            carsOption = "<option value=\"" + this.id + "\">" + this.name + "</option>";
            $('#carList').append(carsOption);
        });
        // console.log(options);
        $.each(options, function( item ) {
            if(! categoryOptions.includes(item.category)){
                categoryOptions.push(item.category);
                $('#categoryOptions').append('<option value="'+item.category+'">');
            }
            if(! productOptions.includes(item.product)){
                productOptions.push(item.product);
                $('#productOptions').append('<option value="'+item.product+'">');
            }
            if(! brandOptions.includes(item.brand)){
                brandOptions.push(item.brand);
                $('#brandOptions').append('<option value="'+item.brand+'">');
            }
            if(! hsnOptions.includes(item.brand)){
                hsnOptions.push(item.brand);
                $('#hsnOptions').append('<option value="'+item.brand+'">');
            }
        });

        $('.numberInput').on("keyup", function() {
            this.value = this.value.replace(/ /g,"");
            this.value = this.value.replace(/\B(?=(\d{4})+(?!\d))/g, " ");
        });
    });
</script>