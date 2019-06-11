<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];
$dateText = date('Y-m-d');
$date = date_create($dateText);
$products = $function->get_products_array();
$centers = $function->getCenterOptions();

pageHeader('Welcome to Dashboard | '.CLIENT_TITLE, $page);
?>
  <style type="text/css">
    label{
      font-size: 12px;
    }
    .resultBox{
      height: 140px;
      overflow-y: scroll;
      overflow-x: hidden;
      border: 1px solid #00a65a;
      padding: 10px;
    }
    @media (max-width:767px) {
      .resultBox{
        height: 280px;
      }
    }
  </style>
  <body class="skin-yellow sidebar-mini" id="tooltip">
    <div class="wrapper">
      <?php pageTopBar();?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php pageSideBar($page);?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            New Ticket
          </h1>
          <ol class="breadcrumb">
            <li><i class="glyphicon glyphicon-compressed"></i> Tickets</li>
            <li class="active">Register New</li>
          </ol>
        </section>
        <section class="content-header">
          <div class="col-md-offset-3 col-md-6"></div>
        </section>

        <!-- Main content -->
        <div id="overlay" style="display: none;"><img style="margin:20% auto;display: block;" src="/assets/images/loader.svg" alt="Validating ..."></div>
        <section class="content">
          <div class='row'>
            <div class='col-xs-12'>
              <div class="nav-tabs-custom">
                <section id="new">
                  <div class="box-body" >
                    <p style="margin: 0;">
                      <a href="/tickets-view/closed" class="btn bg-olive btn-flat btn-sm ">View Closed Tickets</a>
                      <a href="/tickets-view/open" class="btn bg-olive btn-flat btn-sm ">View Open Tickets</a>
                      <div id="responseMsg"><?php echo $error = $function->getMessage(); ?>
                        <div class="alert alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                        </div>
                      </div>
                    </p>
                    <form action="" method="post" role="form" name="form" id="form" style="border:1px solid orange; padding:5% 5% 0 5%; margin-top:10px;" enctype="multipart/form-data" autocomplete="off"><!-- autocomplete="off" -->
                      <!-- text input -->
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="row">
                            <div class="col-sm-6 col-xs-12 form-group has-success">
                              <label>Mobile <span>*</span></label>
                              <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="customer[mobile]" id="mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip" required/>
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group has-success">
                              <label>Alternate Contact <span>*</span></label>
                              <input type="tel" class="form-control input-sm" placeholder="Alternate Mobile Number" name="customer[alternate_mobile]" id="alternate_mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip" required/>
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group has-success">
                              <label>Area Pin <span>*</span></label>
                              <input type="tel" class="form-control input-sm" placeholder="Area pin Number" name="customer[pin]" id="pin" pattern="[0-9]{6}" maxlength="6" onchange="this.setCustomValidity(this.validity.patternMismatch ? '6 Digit Area Pin Code' : '');" title="Please Enter Correct Area Pin Code, It will be used for contact" data-toggle="tooltip" required/>
                            </div>
                            <div class="col-sm-6 col-xs-12 form-group has-success">
                              <label>Email</label>
                              <input type="email" name="customer[email]" id="email" class="form-control input-sm" placeholder="Email Address" maxlength="50"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-6 resultBox">
                          <input type="hidden" name="customer_id" id="customer">
                          <span id="loaderAnim"></span>
                          <ol id="plotCustomer">

                          </ol>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-6">
                          <label>State </label>
                          <select class="form-control input-sm" id="state"  minlength="2">
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
                          <select class="form-control input-sm" id="district">
                            <option value="">Select State First</option>
                          </select>
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                          <label>City <span>*</span></label>
                          <select class="form-control input-sm" id="cities" name="city" required="">
                            <option value="">Select District First</option>
                          </select>
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                          <label>Land Mark</label>
                          <input type="text" class="form-control input-sm" placeholder="Landmark" name="customer[landmark]" id="landmark" pattern="[0-9a-zA-Z .,-]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter City, Minimum 2 & Maximum 100 and only - , . allowed' : '');"  required/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Address</label>
                          <textarea class="form-control input-sm" placeholder="Address" name="customer[address]" id="customer[address]" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Problem/Issues <span>*</span></label>
                          <textarea class="form-control input-sm" placeholder="Enter Details" name="complaint[details]" id="details" rows="3" required="" pattern="[a-zA-Z0-9,- .].{10,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete Details (only - , . allowed in special characters)' : '');"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Customer Name <span>*</span></label>
                          <input type="text" class="form-control input-sm" placeholder="Enter Name of Customer" name="customer[name]" id="name" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" required/>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Company Name </label>
                          <input type="text" class="form-control input-sm" placeholder="Enter Name of Customer Company" name="customer[company]" id="company" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');"/>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xs-8">
                          <div class="row">
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Product Code</label>
                              <input type="text" class="form-control input-sm" id="productCode" name="productcode" id="code" maxlength="20" placeholder="Code" required/>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Purchase Date</label>
                              <input type="date" class="form-control input-sm" name="customer[purchase_date]" id="purchase_date" maxlength="10" pattern="(20[12][0-9])-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD" required/>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Warranty Status <span>*</span></label>
                              <select class="form-control input-sm" name="complaint[warranty_status]" id="warranty_status" required>
                                <option value="">Select ...</option>
                                <option value="Under Warranty">Under Warranty</option>
                                <option value="Out Of Warranty">Out Of Warranty</option>
                                <option value="Under AMC">Under AMC</option>
                                <option value="Status Unknown">Status Unknown</option>
                              </select>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Product Category <span>*</span></label>
                              <select class="form-control input-sm" name="productCat" id="productCat" required>
                                <option value="">Select ...</option>
                              </select>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Product <span>*</span></label>
                              <select class="form-control input-sm" name="product" id="product" required>
                                <option value="">Select ...</option>
                              </select>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Model <span>*</span></label>
                              <select class="form-control input-sm" name="customer[product_id]" id="productModel" required>
                                <option value="">Select ...</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-4 resultBox" id="plotProduct">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-lg-3 form-group has-warning">
                          <label>Center City <span>*</span></label>
                          <select class="form-control input-sm" id="centerCity" name="centerCity" required>
                            <option value="">Select ...</option>
                          </select>
                        </div>
                        <div class="col-xs-6 col-lg-3 form-group has-warning">
                          <label>Center <span>*</span></label>
                          <select class="form-control input-sm" name="complaint[center_id]" id="center" required>
                            <option value="">Select ...</option>
                          </select>
                        </div>
                        <div class="col-xs-6 col-lg-3 form-group has-warning">
                          <label>Estimated TAT</label>
                          <input type="date" class="form-control input-sm" name="complaint[est_resolution_date]" id="erd" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 day', time())); ?>" value="<?php echo date('Y-m-d', strtotime('+1 day', time())); ?>" placeholder="YYYY-MM-DD" required/>
                        </div>
                        <div class="col-xs-6 col-lg-3 form-group has-warning">
                          <label>Complaint Code</label>
                          <input type="text" class="form-control input-sm" placeholder="Manual Complaint Code" name="complaint[code]" id="complaintCode" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" title="Leave Blank to Auto generate"/>
                        </div>
                      </div>
                      <div class="box-footer">
                        <input type="hidden" name="ajax" value="addTicket">
                        <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                        <div class="col-xs-4">&nbsp;</div>
                        <div class="col-xs-4"> <button type="submit" class="btn btn-success btn-flat btn-block">Save</button></div>
                      </div>
                    </form>
                  </div>
                </section>
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php pageFooter(); ?>
    </div><!-- ./wrapper -->
    <?php pageJsInclude($page);?>
    <script type="text/javascript">
      $("[name=ERMaccess]").val("");
    </script>
    <script type="text/javascript">
      $(function(){
        $(document).on('click', '.complaintCust' ,function(event) {
          var complain = $(this).attr('id');
          var customers = localStorage.getItem('customer');
          console.log(customers);
          var customer = customers.filter(function (customer) { return customer.complain == complain });
          $('#customer').val(customer.customer);
          $('#mobile').val(customer.mobile);
          $('#alternate_mobile').val(customer.alternateMobile);
          $('#email').val(customer.email);
          $('#pin').val(customer.pin);
          $('#city').val(customer.city);
          $('#landmark').val(customer.landmark);
          $('#address').val(customer.address);
          $('#name').val(customer.name);
          $('#details').val(customer.details);
          $('#company').val(customer.company);
          $('#purchase_date').val(customer.purchaseDate);
          $('#code').val(customer.productCode);
          $('#warranty_status').val(customer.warranty);
          $('#mobile').val(customer.productCode);
          $('#productCat').val(customer.category);
          $('#product').val(customer.product);
          $('#productModel').val(customer.productModel);
        });
      });

      function plotProduct(product){
        $('#plotProduct').html('<table>'+
                                  '<tr>'+
                                    '<th>Code : </th>'+
                                    '<td> '+ product.code +' </td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Warranty : </th>'+
                                    '<td> '+ product.warranty +' Months</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Description : </th>'+
                                    '<td> '+ product.description +' </td>'+
                                  '</tr>'+
                                '</table>');
      }

      function plotComplaints(phrase){
        $.ajax({
          type:'POST',
          data:{
              'phrase' : phrase,
              'ajax' : 'findTicket'
          },
          beforeSend : function(){
              $('#loaderAnim').html('<img src="/assets/images/loader.svg"> Searching ...');
          }
        })
        .done(function(complaints) {
          complaints = JSON.parse(complaints);
          localStorage.removeItem("customer");
          localStorage.setItem("customer", complaints);
          $.each(complaints, function(key, value) {
            $('#plotCustomer').append('<li><a href="#" class="complaintCust" id="' + value.complain + '">' + value.name + '</a></li>');
          });
          $('#loaderAnim').remove();
        })
        .fail(function() {
          $('#loaderAnim').html('<h5><img src="/assets/images/error.png">Unable to fetch Customer Complain details</h5>');
        });
      }

      $(function() {
         var products = <?php echo json_encode($products); ?>

          $.each(products, function(key, value) {
              $("#productCat").append('<option value="' + value.category + '">' + value.category + '</option>');
          });

          $("#productCat").change(function(event) {
            cat = $(this).val();
            $("#product").val();
            $("#productModel").val();
            $.each(products, function(key, value) {
                if (value.category == cat) {
                  $("#product").append('<option value="' + value.product + '">' + value.product + '</option>');
                }
            });
          });

          $("#product").change(function(event) {
            product = $(this).val();
            $("#productModel").val();
            $.each(products, function(key, value) {
                if (value.product == product) {
                  $("#productModel").append('<option value="' + value.id + '">' + value.variant + '</option>');
                }
            });
          });

          $("#productModel").change(function(event) {
            productId = $(this).val();
            product = products.filter(function (product) { return product.id == productId });
            product = product[0];
            plotProduct(product);
          });

          $("#productCode").keyup(function(event) {
            code = $(this).val().toUpperCase();
            product = products.filter(function (product) { return product.code == code });
            product = product[0];
            if (product) {
              $("#productCat").val(product.category);
              $("#product").html('<option value="' + product.product + '">' + product.product + '</option>');
              $("#productModel").html('<option value="' + product.id + '">' + product.variant + '</option>');
              plotProduct(product);
            }
          });

          $('#mobile').keyup(function(){
            var qstring = $(this).val();
            if (qstring.length == 10) {
              plotComplaints(qstring);
            }
          });

          $('#alternate_mobile').keyup(function(){
            var qstring = $(this).val();
            if (qstring.length == 10) {
              plotComplaints(qstring);
            }
          });

          $('#pin').keyup(function(){
            var qstring = $(this).val();
            if (qstring.length == 6) {
              var value = true;
              $.ajax({
                type:'POST',
                async: false,
                data:{
                    'pin' : qstring,
                    'ajax' : 'findCity'
                },
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
              .done(function(cities) {
                cities = JSON.parse(cities);
                $('#cities').html('<option value="">Select City ...</option>');
                $.each(cities, function(key, value) {
                  $('#state').val(value.state);
                  $('#district').html('<option value="' + value.district + '">' + value.district + '</option>');
                  $('#cities').append('<option value="' + value.pin + '" state="' + value.state + '" district="' + value.district + '">' + value.city + '</option>');
                });
              })
              .fail(function() {
                responseMsgText.addClass('alert-danger');
                responseMsgText.append('<center>Something wrong happened to Districts, Please change State and retry</center>');
              }).always(function(){
                $('#overlay').removeAttr('style');
                $('#overlay').css('display', 'none');
              });
            }
          });

          $('#state').change(function(){
            var qstring = $(this).val();
            $.ajax({
              type:'POST',
              data:{
                  'state' : qstring,
                  'ajax' : 'findDistrict'
              },
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
            .done(function(districts) {
              districts = JSON.parse(districts);
              $('#district').html('<option value="">Select District ...</option>');
              $.each(districts, function(key, value) {
                $('#district').append('<option value="' + value.district + '">' + value.district + '</option>');
              });
            })
            .fail(function() {
              responseMsgText.addClass('alert-danger');
              responseMsgText.append('<center>Something wrong happened to Districts, Please change State and retry</center>');
            }).always(function(){
              $('#overlay').removeAttr('style');
              $('#overlay').css('display', 'none');
            });
          });

          $('#cities').change(function(event) {
            var qstring = $(this).val();
            $("#pin").val(qstring);
            $('#state').val($('option:selected', this).attr('state'));
            $('#district').val($('option:selected', this).attr('district'));
            $('#centerCity').val($('option:selected', this).attr('district'));
          });

          $('#district').change(function(){
            var qstring = $(this).val();
            $("#centerCity").val(qstring);
            $.ajax({
              type:'POST',
              data:{
                  'district' : qstring,
                  'ajax' : 'findPin'
              },
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
            .done(function(cities) {
              cities = JSON.parse(cities);
              $('#cities').html('<option value="">Select City ...</option>');
              $.each(cities, function(key, value) {
                $('#cities').append('<option value="' + value.pin + '" state="' + value.state + '" district="' + value.district + '">' + value.city + '</option>');
              });
            })
            .fail(function() {
              responseMsgText.addClass('alert-danger');
              responseMsgText.append('<center>Something wrong happened to Cities, Please change District and retry</center>');
            }).always(function(){
              $('#overlay').removeAttr('style');
              $('#overlay').css('display', 'none');
            });
          });

          $('#email').keyup(function(){
            var qstring = $(this).val();
            if (qstring.length > 10) {
              plotComplaints(qstring);
            }
          });
      });

      $(function(){
        var centers = <?php echo json_encode($centers); ?>

        $.each(centers, function(key, value) {
            $("#centerCity").append('<option value="' + value.city + '">' + value.city + '</option>');
        });

        $("#centerCity").change(function(event) {
          centerCity = $(this).val();
          center = centers.filter(function (center) { return center.city == centerCity });
          $("#center").html('<option value="">Select ...</option>');
          $.each(center, function(key, value) {
            $("#center").append('<option value="' + value.id + '">' + value.center + '(' + value.code + ')</option>');
          });
        });
      });

      $(function() {
        $("#form").submit(function(e) {
          e.preventDefault();
          var responseMsgVar = $('#responseMsg');
          var responseMsgText = responseMsgVar.children().eq(0);
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
            message = JSON.parse(message);
            responseMsgVar.show();
            if (message.status == 'success') {
              $('#form')[0].reset();
              $('#plotCustomer').html();
              $('#plotProduct').html();
              responseMsgText.addClass('alert-success');
              responseMsgText.append('<center>'+message.message+'</center>');
            }else{
              responseMsgText.addClass('alert-danger');
              responseMsgText.append('<center>'+message.message+'</center>');
            }
          })
          .fail(function(message) {
            responseMsgText.addClass('alert-danger');
            responseMsgText.append('<center>Something wrong happened to submit form, Please Wait and retry</center>');
          })
          .always(function() {
            $('#overlay').removeAttr('style');
            $('#overlay').css('display', 'none');
          });
        });
      });

    </script>
  </body>
</html>