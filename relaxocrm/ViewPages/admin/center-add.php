<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Party/Center</h5>
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
                    <form class="ajax-form" method="post" enctype="multipart/form-data" onsubmit="this.password.value = login_hash(this.password.value);this.cpassword.value = login_hash(this.cpassword.value);">
                        <div class="row">
                            <div class="col-xs-12 panel-group" id="accordion">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Party/Center Details</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
						                        <div class="col-xs-6 form-group">
						                          <label>Entity Name <sup>*</sup></label>
						                          <input type="text" class="form-control" placeholder="Center Name" name="form[name]" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" required/>
						                        </div>
						                        <div class="col-xs-3 form-group">
						                          <label>Type<sup>*</sup></label>
						                          <select class="form-control" name="form[type]" required="">
						                          	 <option value="">Select Type ...</option>
                                         <option value="Center">Center</option>
                                         <option value="Party">Party</option>
                                         <option value="Other">Other</option>
						                          </select>
						                        </div>
						                        <div class="col-xs-3 form-group">
						                          <label>Code <small>(Optional)</small></label>
						                          <input type="text" class="form-control" placeholder="Center Code" name="form[code]" pattern="[a-zA-Z0-9]{2,20}" maxlength="20" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Unique Code For Center (Only Alphabets and Numbers), Minimum 2 & Maximum 20 and no special Characters' : '');"/>
						                        </div>
						                      </div>
						                      <div class="row">
						                        <div class="col-xs-4 form-group">
						                          <label>Phone 1 <sup>*</sup></label>
						                          <input type="tel" class="form-control" placeholder="Contact Number 1" name="form[phone1]" pattern="[0-9]{8,15}" maxlength="15" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only Digits/Numbers, Without leading +91 or 0' : '');" required=""/>
						                        </div>
												<div class="col-xs-4 form-group">
						                          <label>Phone 2</label>
						                          <input type="tel" class="form-control" placeholder="Contact Number 2" name="form[phone2]" pattern="[0-9]{8,15}" maxlength="15" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only Digits/Numbers, Without leading +91 or 0' : '');" />
						                        </div>
						                        <div class="col-xs-4 form-group">
						                          <label>Email</label>
						                          <input type="email" name="form[email]" class="form-control" placeholder="Email Address" maxlength="50"/>
						                        </div>
						                      </div>
						                      <div class="row">
						                        <div class="col-xs-4 form-group">
						                            <label>Date Of Join </label>
						                            <input type="date" class="form-control datepicker" name="form[doj]" maxlength="10" pattern="(1[89][0-9][0-9]|20[01][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD" max="<?php echo $today = date('Y-m-d'); ?>" value="<?php echo $today; ?>"/>
						                        </div>
						                        <div class="col-xs-4 form-group">
						                            <label>Date Of Expiry </label>
						                            <input type="date" class="form-control datepicker" name="form[expiry]" maxlength="10" pattern="(201[89]|20[2-9][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD" min="<?php echo $today; ?>" value="2020-12-31"/>
						                        </div>
						                        <div class="col-xs-4 form-group">
						                          <label>GST no.</label>
						                          <input type="text" title="Enter GST number" class="form-control" pattern="[0-9a-zA-Z -_,.]{4,20}" maxlength="20" minlength="4" name="form[gstin]" placeholder="GST Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct GST Number' : '');"/>
						                        </div>
						                      </div>
						                      <div class="row">
						                        <div class="col-xs-6 form-group">
						                          <label>Address </label>
						                          <textarea class="form-control" placeholder="Address" name="form[address]" pattern="[a-zA-Z0-9,- .].{10,200}" maxlength="200" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 200 Characters (only - , . allowed)' : '');" rows="4"></textarea>
						                        </div>
						                        <div class="col-xs-6">
													<div class="row">
                                                        <div class="col-sm-6 col-xs-6 form-group">
                                                            <label>Pin <sup>*</sup></label>
                                                            <input type="text" class="form-control" placeholder="Pin Code" pattern="[0-9]{6}" maxlength="6" id="pin" name="form[city_pin]" required="" />
                                                        </div>
                                                        <div class="col-sm-6 col-xs-6 form-group">
                                                            <label>City</label>
                                                            <select class="form-control chzn-select" id="cities" tabindex="7">
                                                              <option value="">Select District First</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-6">
                                                            <label>District <sup>*</sup></label>
                                                            <select class="form-control chzn-select" id="district" tabindex="6" name="form[city]" required="">
                                                              <option value="">Select State First</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 col-xs-6">
                                                            <label>State </label>
                                                            <select class="form-control chzn-select" id="state" tabindex="1">
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
								                    </div>
						                        </div>
						                      </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">User Details </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body">
											<div class="row">
							                    <div class="col-xs-6 form-group">
							                          <label>Name <sup>*</sup></label>
							                          <input type="text" class="form-control" placeholder="Name of User" name="personal[name]" pattern="[a-zA-Z0-9. ]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter Full Name (Only Alphabets), Minimum 2 & Maximum 100 and no special Characters' : '');" required/>
							                    </div>
							                    <div class="col-xs-6 form-group">
						                          <label>Mobile <small>(Username)</small> <sup>*</sup></label>
						                          <input type="tel" class="form-control" placeholder="Contact Number" name="personal[mobile]" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Only 10 Digit numbers, Without leading +91 or 0' : '');" title="Please Enter Correct 10 Digit Mobile Number, with STD code and without - or +" data-toggle="tooltip" required/>
						                        </div>
							                </div>
						                    <div class="row">
						                        <div class="col-xs-6 form-group">
						                          <label>AADHAR</label>
						                          <input type="text" title="Enter AADHAR number" class="form-control numberInput" pattern="[0-9 ]{14}" maxlength="14"  name="personal[aadhar]" placeholder="Aadhar Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
						                        </div>
						                        <div class="col-xs-6 form-group">
						                          <label>PAN</label>
						                          <input type="text" title="Enter PAN number" class="form-control" pattern="[0-9a-zA-Z]{10}" maxlength="10" minlength="10" name="personal[pan]" placeholder="Pan Number" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter Correct Aadhar Number' : '');"/>
						                        </div>
						                    </div>
						                      <div class="row">
						                        <div class="col-xs-6 form-group has-success">
						                          <label>Password <sup>*</sup></label>
						                          <input type="password" class="form-control" id="reg_password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter' : ''); if(this.checkValidity()) form.cpassword.pattern=this.value;" placeholder="Password*" required="" />
						                        </div>
						                        <div class="col-xs-6 form-group has-success">
						                          <label>Confirm Password <sup>*</sup></label>
						                          <input type="password" class="form-control" id="reg_confirm-password" name="cpassword" pattern="(?=.*\d)(?=.*[A-Z]).{6,128}" minlength="6" required="" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" placeholder="Confirm Password*" required="" />
						                        </div>
						                      </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addCenterCumUser">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save Party/Center"/>
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
        $('.numberInput').on("keyup", function() {
            this.value = this.value.replace(/ /g,"");
            this.value = this.value.replace(/\B(?=(\d{4})+(?!\d))/g, " ");
        });
    });

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
</script>