<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-xxs-12 col-sm-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-wrench"></i></div>
                    <h5>Register new Job</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                  <form action="" class="ajax-form" method="post" role="form" id="add-job-form" enctype="multipart/form-data" >
                      <!-- text input -->
                      <div class="row">
                        <div class="col-xxs-12 col-xs-12 col-sm-6 form-group">
                          <label>Complaint Ticket <span>*</span></label>
                          <select class="form-control chzn-select" name="form[complaint_id]" id="complaint" required>
                            <option value="">Select ...</option>
                            <?php $options = $function->getArray_openTickets();
                              foreach ($options as $option) {
                                echo "
                                  <option value='$option[id]'>$option[code] | $option[date] | $option[mobile] | $option[name]</option>
                                " ;
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-xxs-6 col-xs-6 col-sm-3 form-group">
                          <label>Job Type <span>*</span></label>
                          <select class="form-control status chzn-select" id="type" name="form[type]" required>
                            <option value="">Select ...</option>
                            <option value="Outside">Outside</option>
                            <option value="Local">Local</option>
                            <option value="Canceled">Cancel Ticket</option>
                            <?php if($_SESSION['SESS__azz_level'] > 7) echo '<option value="Closed by Admin">Admin Force Close</option>'; ?>
                          </select>
                        </div>
                        <div class="col-xxs-6 col-xs-6 col-sm-3 form-group">
                          <label>Technician </label>
                          <input type="text" id="technician" class="form-control" disabled="" placeholder="Not Assigned">
                        </div>
                      </div>
                      <div class="row">
                        <section id="optionSection"></section>
                        <section id="otpSection"></section>
                        <section id="tagSection"></section>
                        <section id="tatSection"></section>
                      </div>
                      <div class="row">
                        <div class="col-xxs-12 col-xs-12 col-sm-12 form-group">
                          <input type="hidden" name="form[status]" id="status" value="" required="">
                          <input type="hidden" name="adminAjax" value="addJob">
                          <button type="reset" class="btn btn-danger btn-flat pull-left">Reset</button>
                          <button type="submit" id="processBtn" class="btn btn-success btn-flat pull-right">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</button>
                        </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<template type="text/template" id="OutsideTemp">
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Work / Job Done <span>*</span></label>
    <input type="text" class="form-control" placeholder="Description of Repair" name="form[status_brief_internal]" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 Characters and Only - , . Allowed' : '');"/>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Note For Customer <span>*</span></label>
    <select class="form-control" name="form[status_brief_customer]" id="status_brief_customer" required="">
      <option value="">Select ...</option>
      <option data-status="1" value="Complaint Ticket Successfully Closed, No spare replaced">Complaint Ticket Successfully Closed, No spare replaced</option>
      <option data-status="4" value="Complaint Ticket Successfully Closed, Spare replaced">Complaint Ticket Successfully Closed, Spare replaced</option>
      <option data-status="1" value="Close Customer Denied or Not Available for Service">Close Customer Denied or Not Available for Service</option>
      <option data-status="1" value="Close - Address Mismatch - Phone not Reachable">Close - Address Mismatch - Phone not Reachable</option>
      <option data-status="3" value="Close - Tag Issued - Product To be Replaced">Close - Tag Issued - Product To be Replaced</option>
      <option data-status="0" value="Pending Due to Spare not Available">Pending Due to Spare not Available</option>
      <option data-status="0" value="Pending Customer not Available">Pending Customer not Available</option>
    </select>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group">
    <label>KM Run <span>*</span></label>
    <input type="number" class="form-control" id="km_run" name="form[km_run]" min="0" max="500" step="0.01" placeholder="KM Run" required=""/>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Part Replaced</label>
    <select class="form-control" name="partReplace[]" id="partReplace" disabled="" data-placeholder="only Select If Replaced" multiple="">
    </select>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning">
    <label>Attender Name </label>
    <input type="text" class="form-control" placeholder="Enter Name & Contact" name="form[attender_name]" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" />
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Bill/Warranty </label>
    <input type="text" class="form-control" name="complaint[bill]" placeholder="Bill/Warranty Card Number" id="billWarranty"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Product S/N </label>
    <input type="text" class="form-control" name="complaint[serial_no]" placeholder="Product Serial Number" id="productSerial"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Time to Follow / Turn Arround TIme">
    <label id="purchase_date_req">Purchase Date <span>*</span></label>
    <input type="date" class="form-control" name="complaint[purchase_date]" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>" id="purchase_date" required=""/>
  </div>
</template>
<template type="text/template" id="LocalTemp">
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Work / Job Done <span>*</span></label>
    <input type="text" class="form-control" placeholder="Description of Repair" name="form[status_brief_internal]" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 Characters and Only - , . Allowed' : '');"/>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Note For Customer <span>*</span></label>
    <select class="form-control" name="form[status_brief_customer]" id="status_brief_customer" required="">
      <option value="">Select ...</option>
      <option data-status="1" value="Complaint Ticket Successfully Closed, No spare replaced">Complaint Ticket Successfully Closed, No spare replaced</option>
      <option data-status="4" value="Complaint Ticket Successfully Closed, Spare replaced">Complaint Ticket Successfully Closed, Spare replaced</option>
      <option data-status="1" value="Close Customer Denied or Not Available for Service">Close Customer Denied or Not Available for Service</option>
      <option data-status="1" value="Close - Address Mismatch - Phone not Reachable">Close - Address Mismatch - Phone not Reachable</option>
      <option data-status="3" value="Close - Tag Issued - Product To be Replaced">Close - Tag Issued - Product To be Replaced</option>
      <option data-status="0" value="Pending Due to Spare not Available">Pending Due to Spare not Available</option>
      <option data-status="0" value="Pending Customer not Available">Pending Customer not Available</option>
    </select>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Part Replaced</label>
    <select class="form-control" name="partReplace[]" id="partReplace" disabled="" data-placeholder="only Select If Replaced" multiple="">
    </select>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning">
    <label>Attender Name </label>
    <input type="text" class="form-control" placeholder="Enter Name & Contact" name="form[attender_name]" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" />
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Bill/Warranty </label>
    <input type="text" class="form-control" name="complaint[bill]" placeholder="Bill/Warranty Card Number" id="billWarranty"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Product S/N </label>
    <input type="text" class="form-control" name="complaint[serial_no]" placeholder="Product Serial Number" id="productSerial"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Time to Follow / Turn Arround TIme">
    <label id="purchase_date_req">Purchase Date <span>*</span></label>
    <input type="date" class="form-control" name="complaint[purchase_date]" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>" id="purchase_date" required=""/>
  </div>
</template>
<template type="text/template" id="CanceledTemp">
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Work / Job Done <span>*</span></label>
    <input type="text" class="form-control" placeholder="Description of Repair" name="form[status_brief_internal]" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 Characters and Only - , . Allowed' : '');"/>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Note For Customer <span>*</span></label>
    <select class="form-control" name="form[status_brief_customer]" id="status_brief_customer" required="">
      <option value="">Select ...</option>
      <option data-status="2" value="Complaint Ticket Canceled - Unable to contact Customer">Complaint Ticket Canceled - Unable to contact Customer</option>
      <option data-status="2" value="Canceled - Customer Denied or Not Available for Service">Canceled - Customer Denied or Not Available for Service</option>
      <option data-status="2" value="Canceled - Out of Service Area">Canceled - Out of Service Area</option>
    </select>
  </div>
</template>
<template type="text/template" id="AdminCloseTemp">
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Work / Job Done <span>*</span></label>
    <input type="text" class="form-control" placeholder="Description of Repair" name="form[status_brief_internal]" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 Characters and Only - , . Allowed' : '');"/>
  </div>
  <div class="col-xxs-12 col-xs-6 col-sm-6 form-group">
    <label>Note For Customer <span>*</span></label>
    <select class="form-control" name="form[status_brief_customer]" id="status_brief_customer" required="">
      <option value="">Select ...</option>
      <option data-status="1" value="Complaint Ticket Successfully Closed, No spare replaced">Complaint Ticket Successfully Closed, No spare replaced</option>
      <option data-status="4" value="Complaint Ticket Successfully Closed, Spare replaced">Complaint Ticket Successfully Closed, Spare replaced</option>
      <option data-status="1" value="Close Customer Denied or Not Available for Service">Close Customer Denied or Not Available for Service</option>
      <option data-status="1" value="Close - Address Mismatch - Phone not Reachable">Close - Address Mismatch - Phone not Reachable</option>
      <option data-status="3" value="Close - Tag Issued - Product To be Replaced">Close - Tag Issued - Product To be Replaced</option>
      <option data-status="0" value="Pending Due to Spare not Available">Pending Due to Spare not Available</option>
      <option data-status="0" value="Pending Customer not Available">Pending Customer not Available</option>
    </select>
  </div>
  <div class="col-xxs-12 col-xs-3 col-sm-3 form-group">
    <label>Attender Name </label>
    <input type="text" class="form-control" placeholder="Enter Name & Contact" name="form[attender_name]" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" />
  </div>
  <div class="col-xxs-12 col-xs-9 col-sm-9 form-group has-warning">
    <label>Part Replaced</label>
    <select class="form-control" name="partReplace[]" id="partReplace" disabled="" title="Select Parts" multiple="">
    </select>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Bill/Warranty </label>
    <input type="text" class="form-control" name="complaint[bill]" placeholder="Bill/Warranty Card Number" id="billWarranty"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Write STOCK if this is a piece from stock">
    <label>Product S/N </label>
    <input type="text" class="form-control" name="complaint[serial_no]" placeholder="Product Serial Number" id="productSerial"/>
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Time to Follow / Turn Arround TIme">
    <label id="purchase_date_req">Purchase Date</label>
    <input type="date" class="form-control" name="complaint[purchase_date]" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>" id="purchase_date" />
  </div>
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning">
    <label>KM Run</label>
    <input type="number" class="form-control" ID="km_run" value="0" name="form[km_run]" min="0" max="200" step="0.01" placeholder="KM Run"/>
  </div>
</template>
<template type="text/template" id="tatTemp">
  <div class="col-xxs-6 col-xs-4 col-sm-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">
    <label>Next TAT <sup>*</sup></label>
    <input type="date" class="form-control tat" name="complaint[est_resolution_date]" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d", strtotime("+2 day", time())); ?>" max="<?php echo date("Y-m-d", strtotime("+7 day", time())); ?>" required=""/>
  </div>
  <div class="col-xxs-6 col-xs-4 col-sm-4 form-group has-warning">
    <label>Priority</label>
    <select class="form-control" name="complaint[complaint_priority]">
      <option value="Medium">Medium</option>
      <option value="High">High</option>
      <option value="Low">Low</option>
    </select>
  </div>
</template>
<template type="text/template" id="tagTemp">
  <div class="col-xxs-6 col-xs-4 col-sm-4 form-group has-warning" title="Tag Number">
    <label>Tag Number <sup>*</sup></label>
    <input type="text" class="form-control tat" placeholder="Enter Tag ID" name="complaint[tag]" minlength="9" maxlength="9" required=""/>
  </div>
</template>
<template type="text/template" id="otpTemp">
  <div class="col-xxs-6 col-xs-3 col-sm-3 form-group has-warning" title="Time to Follow / Turn Arround TIme">
    <label id="otp_req">OTP <span>*</span></label>
    <input type="text" class="form-control" id="otp" name="complaint[otp]" maxlength="4" pattern="[0-9]{4}"  placeholder="Customer OTP"  <?php echo IS_TICKET_OTP ? 'required=""' : 'disabled=""'?> />
  </div>
</template>
<template type="text/template" id="blankTemp">
</template>
<script type="text/javascript">
        $(function(){
          var complaint, status, type;
          $("#complaint").chosen().on("change", function(event) {
            $('#type').val('').trigger('chosen:updated');
            $('#optionSection').html('');
            $('#tatSection').html('');
            $('#tagSection').html('');
            $('#otpSection').html('');
            $("#status").val('');
          });

          $('#type').on("change", function(event) {
            var temp,
                id = $("#complaint").val();
            type = $(this).val();
            if(!id){
              alert("Select Complaint Ticket First !");
              return;
            }
            if (type === 'Outside') {
              temp = $("#OutsideTemp");
            }else if (type === 'Closed by Admin') {
              temp = $("#AdminCloseTemp");
            }else if (type === 'Canceled') {
              temp = $("#CanceledTemp");
            }else if(type === 'Local'){
              temp = $("#LocalTemp");
            }else{
              temp = $("#blankTemp");
            }
            temp = temp.html();
            $('#tatSection').html('');
            $('#optionSection').html('');
            var entity = "ticket",
                action = "jobTicket",
                varsArray = {"adminAjax":entity, "action":action, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                  if(msg[0].technician){
                    $("#technician").val(msg[0].technician);
                  }else if(type === 'Outside' || type === 'Local'){
                    alert("Technician Not Assigned, Assign First then perform Job.")
                    return;
                  }
                  $('#optionSection').append(temp);
                  $("#partReplace").html('');
                  $.each(msg, function(index, el) {
                    $("#partReplace").append('<option value="'+el.spare+'">'+el.spareCategory+', '+el.spareName+', '+el.spareModel+'</option>');
                  });
                  $("#partReplace").chosen({
                      disable_search_threshold: 10,
                      no_results_text: "Oops, not found!"
                  });
                }else{
                  setShowModal(msg, status);
                }
            });
          });

          $("#content").on("change", "#status_brief_customer", function(event) {
            status = $('option:selected', this).attr('data-status');
            $("form #status").val(status);
            $('form #partReplace').attr('disabled', true).trigger("chosen:updated");
            $('form #otpSection').html($("#otpTemp").html());
            $('form #tatSection').html('');
            $('form #tagSection').html('');
            if (status === '0') {              // Pending
              $('form #tatSection').html($("#tatTemp").html());
            }else if (status === '1') {        // Closed
            }else if (status === '2') {        // Canceled
              $('form #otpSection').html('');
            }else if (status === '3') {        // Tagged
              $('form #tagSection').html($("#tagTemp").html());
            }else if (status === '4') {        // Part Replaced
              $('form #partReplace').removeAttr('disabled').trigger("chosen:updated");
            }
            if(type == "Closed by Admin"){
              $('form #otpSection').html('');
            }
            return;
          });

          $("#content").on('change', '#billWarranty' ,function(event) {
            var bill = $(this).val();
            bill = bill.toLowerCase();
            if (bill == 'stock') {
              $('form #purchase_date').attr('required', false);
              $('form #purchase_date_req').html('Purchase Date');
            }else{
              $('form #purchase_date').attr('required', true);
              $('form #purchase_date_req').html('Purchase Date <span>*</span>');
            }
          });
        });
        <?php
          if (isset($_GET['ticket'])) {
            echo '$("#complaint").val("'.$_GET['ticket'].'").trigger("chosen:updated")';
          }
        ?>
      </script>