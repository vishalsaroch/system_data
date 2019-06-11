<?php
$level = $function->checkLogin();
if ($level < 1) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

$products = $function->get_products_array();
$centers = $function->getCenterOptions();

pageHeader('Welcome to Dashboard | '.CLIENT_TITLE, $page);
?>
  <style type="text/css">
    label{
      font-size: 12px;
    }
    .complaintCust{cursor: pointer;color: blue;}
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
    input[type=checkbox], input[type=radio] {
      margin: 0;
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
                      <div id="responseMsg"><?php echo $error = $function->getMessage(); ?></div>
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
                              <label>Alternate Contact</label>
                              <input type="tel" class="form-control input-sm" placeholder="Alternate Mobile Number" name="customer[alternate_mobile]" id="alternate_mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip"/>
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
                          <span id="loaderAnim"></span>
                          <p><a href="javascript:void(0);" id="clearPlotCustomer">Clear All</a></p>
                          <ol id="plotCustomer">
                            <li><label class="complaintCust" id="" address="" alternateMobile="" center="" company="" customer="" details="" email="" landmark="" mobile="" name="" pin="" productCode="" purchaseDate="" centerName="" centerCode="" warranty><input type="radio" name="customer_id" value="" checked="" required=""> &nbsp; &nbsp; &nbsp; New</label></li>
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
                          <label>City</label>
                          <select class="form-control input-sm" id="cities" name="city">
                            <option value="">Select District First</option>
                          </select>
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                          <label>Land Mark</label>
                          <input type="text" class="form-control input-sm" placeholder="Landmark" name="customer[landmark]" id="landmark" pattern="[0-9a-zA-Z .,-]{2,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter City, Minimum 2 & Maximum 100 and only - , . allowed' : '');" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 form-group">
                          <label>Address <span>*</span></label>
                          <textarea class="form-control input-sm" placeholder="Address" name="customer[address]" id="address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="3" required></textarea>
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
                              <input type="text" class="form-control input-sm" id="productCode" name="productcode" maxlength="20" placeholder="Code"/>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Purchase Date</label>
                              <input type="date" class="form-control input-sm" name="customer[purchase_date]" id="purchase_date"  placeholder="YYYY-MM-DD"/>
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
                              <label>Product Category </label>
                              <select class="form-control input-sm" name="productCat" id="productCat">
                                <option value="">Select ...</option>
                              </select>
                            </div>
                            <div class="col-xs-6 col-lg-4 form-group has-success">
                              <label>Product </label>
                              <select class="form-control input-sm" name="product" id="product">
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
                          <label>Center City </label>
                          <select class="form-control input-sm" id="centerCity" name="centerCity">
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
                          <input type="date" class="form-control input-sm" name="complaint[est_resolution_date]" id="erd" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 day', time())); ?>" value="<?php echo date('Y-m-d', strtotime('+2 day', time())); ?>" placeholder="YYYY-MM-DD" required/>
                        </div>
                        <div class="col-xs-6 col-lg-3 form-group has-warning">
                          <label>Complaint Code</label>
                          <input type="text" class="form-control input-sm" placeholder="Manual Complaint Code" name="complaint[code]" id="complaintCode" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" title="Leave Blank to Auto generate"/>
                        </div>
                      </div>
                      <div class="box-footer">
                        <input type="hidden" name="ajax" id="processName" value="addTicket">
                        <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                        <div class="col-xs-4">&nbsp;</div>
                        <div class="col-xs-4"> <button type="submit" id="processBtn" class="btn btn-success btn-flat btn-block">Save</button></div>
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
      $(function(){
        $('#clearPlotCustomer').click(function(event) {
          $('#plotCustomer').html('<li><label class="complaintCust" id="" address="" alternateMobile="" center="" company="" customer="" details="" email="" landmark="" mobile="" name="" pin="" productCode="" purchaseDate="" centerName="" centerCode="" warranty><input type="radio" name="customer_id" value="" checked="" required=""> &nbsp; &nbsp; &nbsp; New</label></li>');
          $('#form')[0].reset();
        });

        $(document).on('click', '.complaintCust' ,function(event) {
          var customer = $(this);
          $('#mobile').val(customer.attr('mobile'));
          $('#alternate_mobile').val(customer.attr('alternateMobile'));
          $('#email').val(customer.attr('email'));
          $('#pin').val(customer.attr('pin'));
          $('#landmark').val(customer.attr('landmark'));
          $('#address').val(customer.attr('address'));
          $('#name').val(customer.attr('name'));
          $('#details').val(customer.attr('details'));
          $('#company').val(customer.attr('company'));
          $('#purchase_date').val(customer.attr('purchaseDate'));
          $('#warranty_status').val(customer.attr('warranty'));
          $('#productCode').val(customer.attr('productCode'));
          $('#center').append('<option value="'+customer.attr('center')+'">'+customer.attr('centerName')+' ('+customer.attr('centerCode')+')</option>');
          $('#center').val(customer.attr('center'));
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
          $.each(complaints, function(key, value) {
            $('#plotCustomer').append('<li><label class="complaintCust" id="' + value.complain +
                                                                    '" address="' + value.address +
                                                                    '" alternateMobile="' + ((value.alternateMobile == null) ? '' : value.alternateMobile) +
                                                                    '" center="' + value.center +
                                                                    '" company="' + value.company +
                                                                    '" customer="' + value.customer +
                                                                    '" details="' + value.details +
                                                                    '" email="' + value.email +
                                                                    '" landmark="' + value.landmark +
                                                                    '" mobile="' + value.mobile +
                                                                    '" name="' + value.name +
                                                                    '" pin="' + value.pin +
                                                                    '" productCode="' + value.productCode +
                                                                    '" purchaseDate="' + value.purchaseDate +
                                                                    '" centerName="' + value.centerName +
                                                                    '" centerCode="' + value.centerCode +
                                                                    '" warranty="' + value.warranty +'">' +
                                                                    '<input type="radio" name="customer_id" class="customer" value="'+ value.customer +'"/> &nbsp; &nbsp; &nbsp; ' +
                                                                    value.name + ' | ' +
                                                                    '000000'.substring(0, 6 - value.complain.length) + value.complain + ' | ' +
                                                                    value.timestamp + ' | ' +
                                                                    ((value.status == -1) ? 'Active' : 'Closed') +
                                                                    ((value.km_run == null) ? '' : ' | '+value.km_run+' KM') +
                                                                    ' </label></li>');
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
                  $('#cities').append('<option value="' + value.pin + '" state="' + value.state + '" district="' + value.district + '">' + value.city + ' ('+value.pin+')</option>');
                });
              })
              .fail(function() {
                $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to Districts, Please change State and retry</center></div>');
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
              $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to Districts, Please change State and retry</center></div>');
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
                $('#cities').append('<option value="' + value.pin + '" state="' + value.state + '" district="' + value.district + '">' + value.city + ' ('+value.pin+')</option>');
              });
            })
            .fail(function() {
              $('#responseMsg').html('<div class="alert alert-danger"><center>Something wrong happened to Cities, Please change District and retry</center></div>');
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
            if (message.status == 'success') {
              $('#form')[0].reset();
              $('#plotCustomer').html();
              $('#plotProduct').html();
              $('#responseMsg').html('<div class="alert alert-success"><center>'+message.message+'</center></div>');
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

    </script>
    <?php
      $var2 = isset($_GET['var2']) ? $_GET['var2'] : '';
      if ($var2 == 'edit') {
        $id = (int) filter_data($_GET['var']);
        $ticketData = $function->getArray_tickeData($id);
        ?>
        <script type="text/javascript">
          $(function(){
              $('.resultBox').eq(0).remove();
              $('#mobile').val('<?php echo $ticketData['mobile']; ?>');
              $('#alternate_mobile').val('<?php echo $ticketData['alternateMobile']; ?>');
              $('#email').val('<?php echo $ticketData['email']; ?>');
              $('#pin').val('<?php echo $ticketData['pin']; ?>');
              $('#landmark').val('<?php echo $ticketData['landmark']; ?>');
              $('#address').val('<?php echo $ticketData['address']; ?>');
              $('#name').val('<?php echo $ticketData['name']; ?>');
              $('#details').val('<?php echo $ticketData['details']; ?>');
              $('#company').val('<?php echo $ticketData['company']; ?>');
              $('#purchase_date').val('<?php echo $ticketData['purchaseDate']; ?>');
              $('#warranty_status').val('<?php echo $ticketData['warranty']; ?>');
              $('#productCode').val('<?php echo $ticketData['productCode']; ?>');
              $('#center').append('<option value="'+'<?php echo $ticketData['center']; ?>'+'">'+'<?php echo $ticketData['centerName']; ?>'+' ('+'<?php echo $ticketData['centerCode']; ?>'+')</option>');
              $('#center').val('<?php echo $ticketData['center']; ?>');
              $('#processBtn').text('Update Ticket');
              $('#processName').val('updateTicket');
          });
        </script>
        <?php
      }
    ?>
  </body>
</html>