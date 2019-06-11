<?php
$level = $function->checkLogin();
if ($level < 5) {
    header('Location: /');
    exit;
}
$userId = (int) $_SESSION['SESS__user'];
$centerId = (int) $_SESSION['SESS__center_id'];

$products = $function->get_products_array();
$centers = $function->getCenterOptions();

$varVal  = isset($_GET['var']) ? $_GET['var'] : '';
$varName  = isset($_GET['var2']) ? $_GET['var2'] : '';
if (($varName == 'resendSMSCus') && ($level > 5)) {
  $id = (int) filter_data($varVal);
  $complaint = $function->getComplainSMS($id, 'Customer');
  if ($complaint) {
    require_once MODEL_DIRECTORY.'/sms.php';
    $complaint['id'] = str_pad($complaint['id'], 6, 0, STR_PAD_LEFT);
    $responce1 = sendRegSMS($complaint['mobile'], $complaint['id'], $complaint['otp']);
    $responce1 = $responce1 ? array('success', 'Message sent again to Customer '.$complaint['mobile'].' for complain #'.$complaint['id']) : array('danger', 'Message could not be send again to Customer '.$complaint['mobile'].' for complain #'.$complaint['id']);
    $_SESSION['MSG'] = $responce1;
  }else{
    $_SESSION['MSG'] = array('danger', 'Customer Message not sent for complain #'.$id);
  }
  echo '<script>window.location = "/tickets-view";</script>';
  header('Location: /tickets-view');
  exit;
}elseif (($varName == 'resendSMSCen') && ($level > 5)) {
  $id = (int) filter_data($varVal);
  $complaint = $function->getComplainSMS($id, 'Center');
  if ($complaint) {
    require_once MODEL_DIRECTORY.'/sms.php';
    $complaint['id'] = str_pad($complaint['id'], 6, 0, STR_PAD_LEFT);
    $responce1 = sendPartnerSMS($complaint['mobile'], $complaint['id'], $complaint['name'], $complaint['custMobile'], $complaint['altMobile'], $complaint['address'], $complaint['issue'], $complaint['product'].' '.complaint['model']);
    $responce1 = $responce1 ? array('success', 'Message sent again to Center '.$complaint['mobile'].' for complain #'.$complaint['id']) : array('danger', 'Message could not be send again to Center '.$complaint['mobile'].' for complain #'.$complaint['id']);
    $_SESSION['MSG'] = $responce1;
  }else{
    $_SESSION['MSG'] = array('danger', 'Center Message not sent for complain #'.$id);
  }
  echo '<script>window.location = "/tickets-view";</script>';
  header('Location: /tickets-view');
  exit;
}

pageHeader('Welcome to Dashboard | '.CLIENT_TITLE, $page);
?>
  <style type="text/css">
    label{
      font-size: 12px;
    }
    .complaintCust,.newproductLabel{cursor: pointer;color: blue;}
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
  <style type="text/css">
      .glyphicon-lock{color: #f3a23a;}
      .glyphicon-trash{color: red;}
      .glyphicon-edit{color: green;}
      .printHeader{
        display: none;
      }
      .modal-footer{text-align: left;}
      /*td,th{text-align: center;}*/
      .modal-content{min-height: 200px;}
      @media print{
        .noprint { display: none;}
        .print {display: absolute; position: relative;max-width: 100%;}
        .print tr th:first-child{width: 20%;}
        .printHeader{display: block;}
        .modal-dialog{width: 1200px;}
        .modal-dialog th, .modal-dialog td{font-size: 16px;}
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
          <h1 id="pageTitle">
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
          <form action="" method="post" role="form" name="form" id="form" enctype="multipart/form-data" autocomplete="off" class='row'>
            <div class='col-xs-12'>
              <div class="nav-tabs-custom">
                <section id="new">
                  <div class="box-body" >
                    <p style="margin: 0;">
                      <a href="/tickets-view/closed" class="btn bg-olive btn-flat btn-sm ">View Closed Tickets</a>
                      <a href="/tickets-view/open" class="btn bg-olive btn-flat btn-sm ">View Open Tickets</a>
                      <div id="responseMsg"><?php echo $error = $function->getMessage(); ?></div>
                    </p>
                    <div style="border:1px solid orange; padding:2% 5% 0 5%; margin-top:10px;"><!-- autocomplete="off" -->
                      <!-- text input -->
                      <fieldset>
                        <legend>Customer Information</legend>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Customer Name <span>*</span></label>
                            <input type="text" class="form-control input-sm" placeholder="Enter Name of Customer" name="customer[name]" id="name" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" required/>
                          </div>
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Address <span>*</span></label>
                            <textarea class="form-control input-sm" placeholder="Address" name="customer[address]" id="address" pattern="[a-zA-Z0-9,- .].{10,100}" maxlength="100" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete address, Minimum 10 & Maximum 100 Characters (only - , . allowed)' : '');" rows="1" required></textarea>
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
                          <div class="col-sm-3 col-xs-6 form-group has-success">
                            <label>Mobile <span>*</span></label>
                            <input type="tel" class="form-control input-sm" placeholder="Mobile Number" name="customer[mobile]" id="mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip" required/>
                          </div>
                          <div class="col-sm-3 col-xs-6 form-group has-success">
                            <label>Alternate Contact</label>
                            <input type="tel" class="form-control input-sm" placeholder="Alternate Mobile Number" name="customer[alternate_mobile]" id="alternate_mobile" pattern="[0-9]{10}" maxlength="10" onchange="this.setCustomValidity(this.validity.patternMismatch ? '10 Digit Mobile No, without leading +91 or 0' : '');" title="Please Enter Correct Mobile Number, It will be used for contact" data-toggle="tooltip"/>
                          </div>
                          <div class="col-sm-3 col-xs-6 form-group has-success">
                            <label>Area Pin <span>*</span></label>
                            <input type="tel" class="form-control input-sm" placeholder="Area pin Number" name="customer[pin]" id="pin" pattern="[0-9]{6}" maxlength="6" onchange="this.setCustomValidity(this.validity.patternMismatch ? '6 Digit Area Pin Code' : '');" title="Please Enter Correct Area Pin Code, It will be used for contact" data-toggle="tooltip" required/>
                          </div>
                          <div class="col-sm-3 col-xs-6 form-group has-success">
                            <label>Email</label>
                            <input type="email" name="customer[email]" id="email" class="form-control input-sm" placeholder="Email Address" maxlength="50"/>
                          </div>
                        </div>
                      </fieldset>
                      <fieldset>
                        <legend>Product Information</legend>
                        <div class="row">
                          <div class="col-xs-8">
                            <div class="row">
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Product Category </label>
                                <select class="form-control input-sm" name="productCat" id="productCat">
                                  <option value="">Select ...</option>
                                </select>
                              </div>
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Product </label>
                                <select class="form-control input-sm" name="productName" id="product">
                                  <option value="">Select ...</option>
                                </select>
                              </div>
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Model <span>*</span></label>
                                <input type="hidden" name="productModel" id="productModelText" value="">
                                <select class="form-control input-sm" name="product[product_id]" id="productModel" required>
                                  <option value="">Select ...</option>
                                </select>
                              </div>
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Purchase Date</label>
                                <input type="date" class="form-control input-sm" name="product[purchase_date]" id="purchase_date" max="<?php echo date('Y-m-d'); ?>" placeholder="YYYY-MM-DD"/>
                              </div>
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Warranty Status <span>*</span></label>
                                <select class="form-control input-sm" name="product[warranty_status]" id="warranty_status" required>
                                  <option value="">Select ...</option>
                                  <option value="Under Warranty">Under Warranty</option>
                                  <option value="Out Of Warranty">Out Of Warranty</option>
                                  <option value="Under AMC">Under AMC</option>
                                  <option value="Stock Piece">Stock Piece</option>
                                  <option value="Status Unknown">Status Unknown</option>
                                </select>
                              </div>
                              <div class="col-xs-6 col-lg-4 form-group has-info">
                                <label>Product ID</label>
                                <input type="text" class="form-control input-sm" id="productCode" name="productcode" maxlength="20" placeholder="Code"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-4 resultBox" id="plotProduct">
                          </div>
                        </div>
                      </fieldset>
                      <fieldset>
                        <legend>Ticket Information</legend>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Problem/Issues <span>*</span></label>
                            <textarea class="form-control input-sm" placeholder="Enter Details" name="complaint[details]" id="details" rows="1" required="" pattern="[a-zA-Z0-9,- .].{10,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter complete Details (only - , . allowed in special characters)' : '');"></textarea>
                          </div>
                          <div class="col-sm-6 col-xs-12 form-group">
                            <label>Quantity <span>*</span></label>
                            <input type="number" class="form-control input-sm" placeholder="Enter Number of Product Pieces" name="complaint[qty]" id="company" min="1" max="98" required="" />
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
                            <input type="hidden" name="centerContact" id="centerContact" value="">
                            <select class="form-control input-sm" name="complaint[center_id]" id="center" required>
                              <option value="">Select ...</option>
                            </select>
                          </div>
                          <div class="col-xs-6 col-lg-3 form-group has-warning">
                            <label>Estimated TAT</label>
                            <input type="date" class="form-control input-sm" name="complaint[est_resolution_date]" id="erd" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 day', time())); ?>" value="<?php echo date('Y-m-d', strtotime('+3 day', time())); ?>" placeholder="YYYY-MM-DD" required/>
                          </div>
                          <div class="col-xs-6 col-lg-3 form-group has-warning">
                            <label>Complaint Code</label>
                            <input type="text" class="form-control input-sm" placeholder="Manual Complaint Code" name="complaint[code]" id="complaintCode" pattern="[a-zA-Z0-9. ,-]{2,50}" maxlength="50" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimum 2 & Maximum 50 Characters and Only - , . Allowed' : '');" title="Leave Blank to Auto generate"/>
                          </div>
                        </div>
                      </fieldset>
                      <div class="box-footer">
                        <input type="hidden" name="ajax" id="processName" value="addTicket">
                        <div class="col-xs-4"><button type="reset" class="btn btn-danger btn-flat">Reset</button></div>
                        <div class="col-xs-4">&nbsp;</div>
                        <div class="col-xs-4"> <button type="submit" id="processBtn" class="btn btn-success btn-flat btn-block">Save</button></div>
                      </div>
                    </div>
                  </div>
                </section>
              </div><!-- /.nav-tabs-custom -->
              <div class="nav-tabs-custom">
                <section id="old">
                  <div class="box-body">
                    <table style="border:1px solid orange; padding:1%;" class="table table-hover nodataTable">
                      <fieldset>
                        <legend>Previous Complaints <button id="clearPlotCustomer" type="button" class="btn bg-maroon btn-flat btn-xs">Clear</button></legend>
                        <thead>
                          <tr>
                            <th>Customer</th>
                            <th>#Complaint</th>
                            <th>#Product</th>
                            <th>Time</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="plotCustomer">
                          <tr>
                            <td><label class="complaintCust" id="" address="" alternateMobile="" center="" company="" customer="" details="" email=""     landmark="" mobile="" name="" pin="" productCode="" productName="" productModel="" purchaseDate="" centerName=""       centerCode="" warranty="">
                                  <input type="radio" name="customer_id" id="customer_id" value=",," checked="" required=""> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Customer
                                </label>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </fieldset>
                    </table>
                  </div>
                </section>
              </div>
            </div><!-- /.col -->
          </form><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php pageFooter(); ?>
    </div><!-- ./wrapper -->
    <div class="modal print" id="ticketDetailModal">
      <div class="modal-dialog">
        <div class="modal-content" id="ticketDetails">
          <center class="noprint"><b>Unable to fetch details</b></center>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="modal print" id="ticketJobDetailModal">
      <div class="modal-dialog">
        <div class="modal-content" id="ticketJobDetails">
          <center class="noprint"><b>Unable to fetch details</b></center>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <?php pageJsInclude($page);?>
    <script type="text/javascript">
      $(function(){
        $('#clearPlotCustomer').click(function(event) {
          $('#plotCustomer').html('<tr><td><label class="complaintCust" id="" address="" alternateMobile="" center="" company="" customer="" details="" email=""     landmark="" mobile="" name="" pin="" productCode="" productName="" productModel="" purchaseDate="" centerName=""       centerCode="" warranty="">      <input type="radio" name="customer_id" id="customer_id" value=",," checked="" required=""> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Customer    </label></td><td></td><td></td><td></td><td></td>  </tr>');
          $('#form')[0].reset();
        });
      });

      function plotProduct(product){
        $('#plotProduct').html('<table>'+
                                  '<tr>'+
                                    '<th>Code : </th>'+
                                    '<td> '+ product.code +' (#'+ product.id +') </td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Warranty : </th>'+
                                    '<td> '+ product.warranty +' Months</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Description : </th>'+
                                    '<td> &nbsp; '+ product.description +' </td>'+
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
          var xxx = 0;
          $.each(complaints, function(key, value) {
            if(xxx === 0){
              $('#plotCustomer').append('<tr><td><label class="complaintCust" id="' + value.complain +
                                                                    '" address="' + value.address +
                                                                    '" alternateMobile="' + ((value.alternateMobile == null) ? '' : value.alternateMobile) +
                                                                    '" center="' + value.center +
                                                                    '" company="' + '' +
                                                                    '" customer="' + value.customer +
                                                                    '" details="' + '' +
                                                                    '" email="' + value.email +
                                                                    '" landmark="' + value.landmark +
                                                                    '" mobile="' + value.mobile +
                                                                    '" name="' + value.name +
                                                                    '" pin="' + value.pin +
                                                                    '" productCode="' + '' +
                                                                    '" productName="' + '' +
                                                                    '" productModel="' + '' +
                                                                    '" purchaseDate="' + '' +
                                                                    '" centerName="' + value.centerName +
                                                                    '" centerCode="' + value.centerCode +
                                                                    '" centerContact="' + value.centerContact +
                                                                    '" warranty="' + '' +'">' +
                                                                    '<input type="radio" name="customer_id" class="customer" value="'+ value.customer +',,"/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' +
                                                                    value.name +'</label></td>'+
                                                                    '<td><a href="javascript:void();" class="ticketsId"></a></td>'+
                                                                    '<td><label class="newproductLabel">New Product</lable></td>'+
                                                                    '<td><a href="javascript:void();" class="jobTocketsId"></a></td>'+
                                                                    '<td></td>');
            }
            xxx++;
            $('#plotCustomer').append('<tr><td><label class="complaintCust" id="' + value.complain +
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
                                                                    '" productCode="' + value.product +
                                                                    '" productName="' + value.productName +
                                                                    '" productModel="' + value.productModel +
                                                                    '" purchaseDate="' + value.purchaseDate +
                                                                    '" centerName="' + value.centerName +
                                                                    '" centerCode="' + value.centerCode +
                                                                    '" centerContact="' + value.centerContact +
                                                                    '" warranty="' + value.warranty +'">' +
                                                                    '<input type="radio" name="customer_id" class="customer" value="'+ value.customer +','+ value.customer_product +','+ value.product +'"/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' +
                                                                    value.name +'</label></td>'+
                                                                    '<td><a href="javascript:void();" class="ticketsId" id="'+value.complain+'">'+'000000'.substring(0, 6 - value.complain.length) + value.complain+'</a></td>'+
                                                                    '<td>'+ value.productName +' '+ value.productModel +' (#'+ value.product+')</td>'+
                                                                    '<td><a href="javascript:void();" class="jobTocketsId" id="'+value.complain+'">'+value.timestamp+'</a></td>'+
                                                                    '<td>'+((value.status == -1) ? 'Active' : ((value.status == 2) ? 'Canceled' : 'Closed'))+'</td>');
          });
          $('#loaderAnim').remove();
        })
        .fail(function() {
          $('#loaderAnim').html('<h5><img src="/assets/images/error.png">Unable to fetch Customer Complain details</h5>');
        });
      }

      $(function() {
          var products = <?php echo json_encode($products); ?>;
          var productCatAdded = {};
          $.each(products, function(key, value) {
            if (productCatAdded[value.category] === undefined) {
              productCatAdded[value.category] = '';
              $("#productCat").append('<option value="' + value.category + '">' + value.category + '</option>');
            }
          });

          var centers = <?php echo json_encode($centers); ?>;
          var centerCityAdded = {};
          $.each(centers, function(key, value) {
            if (centerCityAdded[value.city] === undefined) {
              centerCityAdded[value.city] = '';
              $("#centerCity").append('<option value="' + value.city + '">' + value.city + '</option>');
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

          $('#email').keyup(function(){
            var qstring = $(this).val();
            if (qstring.length > 10) {
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

          $('#cities').change(function(event) {
            var qstring = $(this).val();
            $("#pin").val(qstring);
            $('#state').val($('option:selected', this).attr('state'));
            var district = $('option:selected', this).attr('district');

            $('#district').val(district);
            $('#centerCity').val(district);
            center = centers.filter(function (center) { return center.city === district });
            $("#center").html('');
            $.each(center, function(key, value) {
              $("#center").append('<option value="' + value.id + '" contact="' + value.contact + '">' + value.center + '(' + value.code + ')</option>');
            });
          });

          $("#productCode").keyup(function(event) {
            id = $(this).val().toUpperCase();
            product = products.filter(function (product) { return product.id === id });
            product = product[0];
            if (product) {
              $("#productCat").val(product.category);
              $("#product").html('<option value="' + product.product + '">' + product.product + '</option>');
              $("#productModel").html('<option value="' + product.id + '">' + product.variant + '</option>');
              plotProduct(product);
            }
          });

          $("#productCat").change(function(event) {
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
          });

          $("#product").change(function(event) {
            product = $(this).val();
            $("#productModel").html('<option value="">Select ... </option>');
            var productModelAdded = {};
            $.each(products, function(key, value) {
                if ((value.product === product) && (productModelAdded[value.id] === undefined)) {
                  productModelAdded[value.id] = '';
                  $("#productModel").append('<option value="' + value.id + '">' + value.variant + '</option>');
                }
            });
          });

          $("#productModel").change(function(event) {
            productId = $(this).val();
            product = products.filter(function (product) { return product.id === productId });
            product = product[0];
            plotProduct(product);
            $('#productCode').val(productId);
          });

          $("#centerCity").change(function(event) {
            centerCity = $(this).val();
            center = centers.filter(function (center) { return center.city === centerCity });
            $("#center").html('<option value="">Select ...</option>');
            $.each(center, function(key, value) {
              $("#center").append('<option value="' + value.id + '" centerContact="' + value.contact + '">' + value.center + '(' + value.code + ')</option>');
            });
          });
      });

      $(function(){
        $(document).on('click', '.complaintCust' ,function(event) {
          var customer = $(this);
          $('#alternate_mobile').val(customer.attr('alternateMobile'));
          $('#email').val(customer.attr('email'));
          $('#pin').val(customer.attr('pin'));
          $('#landmark').val(customer.attr('landmark'));
          $('#address').val(customer.attr('address'));
          $('#name').val(customer.attr('name'));
          $('#details').val(customer.attr('details'));
          $('#company').val(customer.attr('company'));
          $('#pin').keyup();
          $('#cities').val(customer.attr('pin'));
          $('#purchase_date').val(customer.attr('purchaseDate'));
          $('#warranty_status').val(customer.attr('warranty'));
          $('#productCode').val(customer.attr('productCode'));
          $('#productName').val(customer.attr('productName'));
          $('#productModel').val(customer.attr('productModel'));
          $('#productCode').val(customer.attr('productCode'));
          $('#productCode').keyup();
          $('#center').html('<option value="'+customer.attr('center')+'" centerContact="'+customer.attr('centerContact')+'">'+customer.attr('centerName')+' ('+customer.attr('centerCode')+')</option>');
          $('#center').val(customer.attr('center'));
        });

        $(document).on('click', '.ticketsId' ,function() {
          var id = $(this).attr('id');
          $.ajax({
            type: 'post',
            data: {
              'tid': id,
              'ajax':'ticketDetails'
            },
            beforeSend : function(){
              $('#ticketDetails').html('<center><span style ="margin-top:100px;"><img style="margin-top:200px;" src="/assets/images/loader.svg" alt="Validating ..."></span></center>');
            },
            success: function(data, status) {
              $('#ticketDetails').html(data);
              $('#ticketDetailModal').modal('show');
            },
            error: function(xhr, desc, err) {
              $('#ticketDetails').html('<center><span style ="margin-top:100px;">Unable to fetch Details, Please try later</span></center>');
            }
          });
        });

        $(document).on('click', '.jobTocketsId', function() {
          var id = $(this).attr('id');
          $.ajax({
            type: 'post',
            data: {
              'tid': id,
              'ajax': 'ticketJobDetails'
            },
            beforeSend : function(){
              $('#ticketDetails').html('<center><span style ="margin-top:100px;"><img style="margin-top:200px;" src="/assets/images/loader.svg" alt="Validating ..."></span></center>');
            },
            success: function(data, status) {
              $('#ticketJobDetails').html(data);
              $('#ticketJobDetailModal').modal('show');
            },
            error: function(xhr, desc, err) {
              $('#ticketJobDetails').html('<center><span style ="margin-top:100px;">Unable to fetch Details, Please try later</span></center>');
            }
          });
        });
      });

      $(function() {
        $("#form").submit(function(e) {
          e.preventDefault();
          $('#centerContact').val($('option:selected', '#center').attr('centerContact'));
          $('#productModelText').val($('option:selected', '#productModel').html());
          console.log($('#centerContact').val());
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
            if(message.search('Updated,') != -1){
              setTimeout(function() {
                  window.location = '/';
                }, 6000);
            }
            try {
              message = JSON.parse(message);
            } catch (e) {
              var status = message.search('{"status":');
              if( status != -1){
                message = message.substring(status, message.indexOf(' "}')+3);
                try{
                  message = JSON.parse(message);
                }catch(e){
                  message = {"status": "danger", "message": "Unknown Status : <b>Please Check Manually before Re-submit by searching Mobile/Name <a href='/tickets-view/open' target='_blank' style='color:yellow;'>(Click here)</a> if Ticket is Raised/Updated or not, Check SMS also. <a href='/tickets-new' target='_blank' style='color:yellow;'>Refresh</a> if already Raised/Updated</b>"};
                }
              }else{
                message = {"status": "danger", "message": "Unknown Status : <b>Please Check Manually before Re-submit by searching Mobile/Name <a href='/tickets-view/open' target='_blank' style='color:yellow;'>(Click here)</a> if Ticket is Raised/Updated or not, Check SMS also. <a href='/tickets-new' target='_blank' style='color:yellow;'>Refresh</a> if already Raised/Updated</b>"};
              }
            }
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
              //$('.resultBox').eq(0).remove();
              $('#old').html('');
              $('#pageTitle').text('Update Ticket # <?php echo $ticketData['complain']; ?>');
              $("#form").append('<input type="hidden" value="<?php echo $ticketData['complain']; ?>" name="complaint_id">');
              $("#form").append('<input type="hidden" value="<?php echo $ticketData['customer'].','.$ticketData['customer_product'].','.$ticketData['productId']; ?>" name="customer_id">');
              $('#mobile').val('<?php echo $ticketData['mobile']; ?>');
              $('#alternate_mobile').val('<?php echo $ticketData['alternateMobile']; ?>');
              $('#email').val('<?php echo $ticketData['email']; ?>');
              $('#pin').val('<?php echo $ticketData['pin']; ?>');
              $('#pin').keyup();
              $('#cities').val('<?php echo $ticketData['pin']; ?>');
              $('#landmark').val('<?php echo $ticketData['landmark']; ?>');
              $('#address').val('<?php echo $ticketData['address']; ?>');
              $('#name').val('<?php echo $ticketData['name']; ?>');
              $('#details').val('<?php echo $ticketData['details']; ?>');
              $('#company').val('<?php echo $ticketData['company']; ?>');
              $('#purchase_date').val('<?php echo $ticketData['purchaseDate']; ?>');
              $('#warranty_status').val('<?php echo $ticketData['warranty']; ?>');
              $('#productCode').val('<?php echo $ticketData['productId']; ?>');
              $('#productCode').keyup();
              $('#center').append('<?php echo '<option centerContact="'.$ticketData['center'].'" value="'.$ticketData['center'].'">'.$ticketData['centerName'].'('.$ticketData['centerCode'].')</option>'; ?>');
              $('#center').val('<?php echo $ticketData['center']; ?>');
              $('#processBtn').text('Update Ticket');
              $('#processName').val('updateTicket');
              $('#complaintCode').attr('disabled', 'disabled');
          });
        </script>
        <?php
      }
    ?>
  </body>
</html>