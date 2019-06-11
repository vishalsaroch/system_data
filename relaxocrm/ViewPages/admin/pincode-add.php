<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add Pin-Code</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Masters
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">#</a></li>
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
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>PinCode <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Pin Code" name="form[pincode]" pattern="[0-9]{6}" maxlength="6" id="pin" required="" />
                            </div>
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>Area <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Area" name="form[area]" pattern="[a-zA-Z0-9. ]{2,50}" maxlength="50" required="" />
                            </div>
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>City <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="City" name="form[city]" pattern="[a-zA-Z0-9. ]{2,50}" maxlength="50" required="" />
                            </div>
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>District <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="District" name="form[district]" pattern="[a-zA-Z0-9. ]{2,50}" maxlength="50" required="" />
                            </div>
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>State  <sup>*</sup></label>
                                <select class="form-control chzn-select" id="state" tabindex="1" name="form[state]" required="">
                                  <option value="">Select ...</option>
                                  <OPTION VALUE="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</OPTION>
                                  <OPTION VALUE="ANDHRA PRADESH">ANDHRA PRADESH</OPTION>
                                  <OPTION VALUE="ARUNANCHAL PRADESH">ARUNANCHAL PRADESH</OPTION>
                                  <OPTION VALUE="ASSAM">ASSAM</OPTION>
                                  <OPTION VALUE="BIHAR">BIHAR</OPTION>
                                  <OPTION VALUE="CHANDIGARH">CHANDIGARH</OPTION>
                                  <OPTION VALUE="CHHATTISGARH">CHHATTISGARH</OPTION>
                                  <OPTION VALUE="DADRA & NAGAR HAVELI">DADRA & NAGAR HAVELI</OPTION>
                                  <OPTION VALUE="DAMAN & DIU">DAMAN & DIU</OPTION>
                                  <OPTION VALUE="DELHI">DELHI</OPTION>
                                  <OPTION VALUE="GOA">GOA</OPTION>
                                  <OPTION VALUE="GUJARAT">GUJARAT</OPTION>
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
                            <div class="col-sm-4 col-xs-6 form-group">
                                <label>Service Area ? <sup>*</sup></label>
                                <select class="form-control chzn-select" id="service" name="form[service]">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                  <label>Longitude </label>
                                  <input type="number" class="form-control" placeholder="Longitude" name="form[longitude]" step="0.000001" max="180" min="-180" />
                            </div>
                            <div class="col-xs-6 form-group">
                                  <label>Latitude </label>
                                  <input type="number" class="form-control" placeholder="Latitude" name="form[latitude]" step="0.000001" max="90" min="-90" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <input type="hidden" name="adminAjax" value="addPincode">
                                <label for="submit" class="control-label"></label>
                                <center><code>
                                    Have You Confirmed <br>All Details ?
                                </code></center>
                                <input type="submit"  id="submit" class="btn btn-success btn-block"  value="Save PinCode"/>
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
                    if( msg) {
                        showResponse("danger", "Pincode <b>"+id+"</b> already in our Database.", 10000);
                        $("#pin").val("");
                        return;
                    }
                }
            }, true);
        });
    });
</script>