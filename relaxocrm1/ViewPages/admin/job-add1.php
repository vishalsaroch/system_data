<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>

<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Register new Job</h5>
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
                    <form action="" class="ajax-form" method="post" role="form" id="form" enctype="multipart/form-data" >
                        <!-- text input -->
                        <div class="row">
                          <div class="col-xs-6 form-group">
                            <label>Complaint Ticket <span>*</span></label>
                            <select class="form-control chzn-select" name="form[complaint_id]" id="complaint" required>
                              <option value="">Select ...</option>
                              <?php $options = $function->getArray_openTickets();
                                foreach ($options as $option) {
                                  echo '
                                    <option value="'.$option['id'].'">'.$option['date'].' | '.$option['name'].' | '.$option['mobile'].' | '.$option['code'].' ('.$option['center'].')</option>
                                  ' ;
                                }
                              ?>
                            </select>
                          </div>
                          <div class="col-xs-6 form-group">
                            <label>Technician Name <span>*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Name & Contact" name="form[attender_name]" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6 form-group">
                            <label>Work / Job Done <span>*</span></label>
                            <textarea class="form-control" placeholder="Enter Details" name="form[status_brief_internal]" rows="5" required="" pattern="[a-zA-Z0-9,- .].{2,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete details, Don\'t use special characters or  / (Slashes))' : '');" required=""></textarea>
                          </div>
                          <div class="col-xs-6 form-group">
                            <label>Note For Customer</label>
                            <textarea class="form-control" placeholder="Enter Note/Status (It will Be displayed on website)" name="form[status_brief_customer]" rows="5" pattern="[a-zA-Z0-9,- .].{2,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete details, Don\'t use special characters or  / (Slashes))' : '');"></textarea>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-xs-4 form-group has-warning">
                            <label>Type <span>*</span></label>
                            <select class="form-control status" id="type" name="form[type]" required>
                              <option value="">Select ...</option>
                              <option value="Onsite">Onsite</option>
                              <option value="Service Center">Service Center</option>
                              <option value="Canceled">Cancel</option>
                              <?php if($_SESSION['SESS__azz_level'] > 7) echo '<option value="Closed by Admin">Admin Force Close</option>'; ?>
                            </select>
                          </div>
                          <section id="optionSection"></section>
                          <section id="tatSection"></section>
                        </div>
                        <div class="box-footer">
                          <input type="hidden" name="adminAjax" value="addJob">
                          <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                          <div class="col-xs-4">&nbsp;</div>
                          <div class="col-xs-4"> <button type="submit" id="processBtn" class="btn btn-success btn-flat btn-block">Save</button></div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        var redirect_from = '<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI']; ?>';
        redirect_from = ('http://www.indocrm.space/tickets-view/open' === redirect_from) ? redirect_from : '/jobs-new';
        $( ".status" ).change(function() {
          if ($(this).val() == '1') {
            $('.tat').attr('required', false);
            $('#tatReq').html('');
          }else{
            $('.tat').attr('required', true);
            $('#tatReq').html('*');
          }
        });
        $(function(){
          $(document).on('change', '#status' ,function(event) {
            var status = $(this).val();
            if (status === '0') {
              $('#tatSection').html('');
              $('#tatSection').append(
                ' <div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label>Next TAT <span id="tatReq"></span></label>'+
                    '<input type="date" class="form-control tat" name="purchase_date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+7 day", time())); ?>"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>Priority</label>'+
                    '<select class="form-control" name="form[complaint_priority]">'+
                      '<option value="">Select ...</option>'+
                      '<option value="High">High</option>'+
                      '<option value="Medium">Medium</option>'+
                      '<option value="Low">Low</option>'+
                    '</select>'+
                  '</div>');
            }else{
              $('#tatSection').html('');
            }
          });

          $(document).on('change', '#billWarranty' ,function(event) {
            var bill = $(this).val();
            bill = bill.toLowerCase();
            if (bill == 'stock') {
              $('#purchase_date').attr('required', false);
              $('#purchase_date_req').html('Purchase Date');
            }else{
              $('#purchase_date').attr('required', true);
              $('#purchase_date_req').html('Purchase Date <span>*</span>');
            }
          });

          $(document).on('change', '#km_run' ,function(event) {
            var km_run = $(this).val();
            if (km_run === '0') {
              $('#otp').attr('required', false);
              $('#otp_req').html('OTP');
            }else{
              $('#otp').attr('required', true);
              $('#otp_req').html('OTP <span>*</span>');
            }
          });

          $('#type').change(function(event) {
            var type = $(this).val();
            if (type === 'Onsite') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>KM Run <span>*</span></label>'+
                    '<input type="number" class="form-control" ID="km_run" name="form[km_run]" min="0" max="200" step="0.01" placeholder="KM Run" required=""/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label id="otp_req">OTP <span>*</span></label>'+
                    '<input type="text" class="form-control" id="otp" name="otp" maxlength="4" pattern="[0-9]{4}"  placeholder="Customer OTP" required="" />'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Write STOCK if this is a piece from stock">'+
                    '<label>Bill/Warranty <span>*</span></label>'+
                    '<input type="text" class="form-control" name="form[bill]" min="0" max="200" step="0.01" placeholder="Bill/Warranty Card Number" id="billWarranty"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label id="purchase_date_req">Purchase Date <span>*</span></label>'+
                    '<input type="date" class="form-control" name="purchase_date" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>" id="purchase_date"/>'+
                  '</div>'+
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<label>Resolved <span>*</span></label>'+
                    '<select class="form-control status" id="status" name="form[status]" required>'+
                      '<option value="">Select ...</option>'+
                      '<option value="1">Close Now</option>'+
                      '<option value="0">Still Need Work</option>'+
                    '</select>'+
                  '</div>');
            }else if (type === 'Closed by Admin') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>KM Run </label>'+
                    '<input type="text" class="form-control" name="form[km_run]" min="0" max="200" step="0.01" placeholder="KM Run" />'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Write Stock if this is a piece from stock">'+
                    '<label>Bill/Warranty</label>'+
                    '<input type="text" class="form-control" name="form[bill]" min="0" max="200" step="0.01" placeholder="Bill/Warranty Card Number" id="billWarranty"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround Time">'+
                    '<label>Purchase Date</label>'+
                    '<input type="date" class="form-control" name="purchase_date" min="2013-01-01" max="<?php echo date("Y-m-d"); ?>"/>'+
                  '</div>'+
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<label>Resolved <span>*</span></label>'+
                    '<select class="form-control status" id="status" name="form[status]" required>'+
                      '<option value="">Select ...</option>'+
                      '<option value="1">Close Now</option>'+
                      '<option value="0">Still Need Work</option>'+
                    '</select>'+
                  '</div>');
            }else if (type === 'Canceled') {
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#optionSection').append(
                  ' <div class="col-xs-4 form-group has-warning">'+
                    '<input type="hidden" value="2" class="form-control status" id="status" name="form[status]" required />'+
                  '</div>');
            }else if(type === 'Service Center'){
              $('#optionSection').html('');
              $('#tatSection').html('');
              $('#tatSection').append(
                ' <div class="col-xs-4 form-group has-warning" title="Time to Follow / Turn Arround TIme">'+
                    '<label>Next TAT <span id="tatReq"></span></label>'+
                    '<input type="date" class="form-control tat" name="tat" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+7 day", time())); ?>"/>'+
                  '</div>'+
                  '<div class="col-xs-4 form-group has-warning">'+
                    '<label>Priority</label>'+
                    '<select class="form-control" name="form[complaint_priority]">'+
                      '<option value="">Select ...</option>'+
                      '<option value="High">High</option>'+
                      '<option value="Medium">Medium</option>'+
                      '<option value="Low">Low</option>'+
                    '</select>'+
                  '</div>');
            }else{
              $('#optionSection').html('');
              $('#tatSection').html('');
            }
          });
        });
        $(function() {
          $("#form").submit(function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              data: $("#form").serialize(),
              beforeSend : function(){
                $('#overlay').css({
                    'background': '#000',
                    'width': '100%',
                    'height': '100%',
                    'position': 'absolute',
                    'top': 0,
                    'left': 0,
                    'opacity': .6,
                    'display': 'block',
                    'zIndex': '1001'
                  });
              }
            })
            .done(function(message) {
              console.log(message);
              message = JSON.parse(message);
              if (message.status == 'success') {
                $('#form')[0].reset();
                $('#responseMsg').html('<div class="alert alert-success"><center>'+message.message+'</center></div>');
                setTimeout(function() {
                  window.location = redirect_from;
                }, 2000);
              }else{
                $('#responseMsg').html('<div class="alert alert-danger"><center>'+message.message+'</center></div>');
              }
            })
            .fail(function(message) {
              $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to submit form, Please Wait and retry</center></div>');
            })
            .always(function() {
              $('#overlay').removeAttr('style');
              $('#overlay').css('display', 'none');
            });
          });
        });
        <?php
          if (isset($_GET['perform'])) {
            echo '$("#complaint").val("'.$_GET['perform'].'")';
          }
        ?>
      </script>
<script type="text/javascript">
    function plotCustomer(id, msg){
        $("#qstring").text(id);
        $("#customerList").html("");
        $.each(msg, function(index,data){
            $("#customerList").append('<tr>'+
                                          '<td><span class="add-new-option-btn name">'+data.name+'</span> <br>(#<span class="crn">'+data.crn+'</span>)</td>'+
                                          '<td><span class="mobile">'+data.mobile+'</span> <br><span class="alternate_mobile">'+data.alternate_mobile+'</span>'+' <br><span class="email">'+data.email+'</span></td>'+
                                          '<td class="address">'+data.address+', Near '+data.landmark+', '+data.city+', '+data.district+', '+data.state+' - '+data.pin+'</td>'+
                                          '<td><span class="product">'+data.brand+' '+data.model+' '+data.product+'</span><br> <span class="quantity">'+data.quantity+'</span></td>'+
                                          '<td><a target="_blank" href="/BestWebs?module=ticket&mode=view&type='+data.complaint+'">#'+data.complaint+'</td>'+
                                          '<td class="sr-only"><span class="district">'+data.district+'</span><span class="customer_product">'+data.customer_product+'</span><span class="purchase_date">'+data.purchase_date+'</span><span class="warranty">'+data.warranty+'</span> Months</td>'+
                                        '</tr>');
        });
        $("#customerModal").modal({show:true, backdrop:"static", keyboard:true}).children('.modal-dialog').css({'width': '90%', 'margin-left': 'auto', 'margin-right': 'auto', 'left': '5%'});
    }
    $(function() {
        <?php
            echo 'var products = '.json_encode($function->getArrayOptions_All_Table('client_products', array('product_id id', 'category category', 'name product', 'model model'))).',
                      centers = '.json_encode($function->getArrayOptions_All_Table('partners_centers', array('center_id id', 'city city', 'name center', 'phone1 phone'))).';';
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


        $("#content").on('click', '.add-new-option-btn', function(event) {
            event.preventDefault();
            var row = $(this).closest('tr'),
            months, plot_warranty_status,
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
            $("#customerModal").modal("hide");
        });
    });
</script>