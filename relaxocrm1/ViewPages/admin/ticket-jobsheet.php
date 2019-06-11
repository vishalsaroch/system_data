<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$ticketId = (int) $_GET['type'];
$ticket = $function->getDetail_ticket($ticketId);
?>
<link rel="stylesheet" href="/assets/admin/css/print.css">
<section class="col-xs-12">
  <div class="jobsheet">
    <section class="brandSection border">
      <br>
      <div class="col-xs-12 border header">
          <div class="col-xs-7 headerLeft">
              <img src="/assets/images/<?php echo $ticket['brand']; ?>-logo.png" alt="<?php echo CLIENT_TITLE; ?>">
          </div>
          <div class="col-xs-5 headerRight">
              <?php
                echo "<h4 style='line-height:0.5;'>".CLIENT_COMPANY."</h4>
                <p style='line-height:0.5;'>".LOGIN_URL."</p>
                <p style='line-height:0.5;'>".COMPLAINT_EMAIL."</p>
                <p style='line-height:0.5;'>".COMPLAINT_PHONE." (miss-call)</p>";
              ?>
          </div>
      </div>
    </section>
    <section class="complaintSection">
      <hr>
      <div class="col-xs-7 content">
          <h4>Complaint Ticket<strong> <?php echo $ticket['code']; ?></strong></h4>
          <p><b>Time</b> : <?php echo $ticket['open_time']; ?></p>
      </div>
      <div class="col-xs-5 content">
          <p>&nbsp;</p>
          <p><b>Job-sheet : </b> <?php echo date('d/m/Y h:i A'); ?></p>
      </div>
      <div class="clearfix"></div>
    </section>
    <section class="customerSection">
      <div class="col-xs-6 panelPart">
        <div class="panel panel-default">
            <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-12">
                      <?php
                        if($ticket['company']) $ticket['customer'] .= " ($ticket[company])";
                        echo "
                          <h4>$ticket[customer]</h4>
                          <p>$ticket[address], $ticket[city], $ticket[district], $ticket[state] - $ticket[city_pin] ($ticket[landmark])</p>
                          <p>$ticket[mobile], $ticket[alternate_mobile], $ticket[email]</p>
                          ";
                        ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-xs-6 panelPart">
          <div class="panel panel-default">
              <div class="panel-footer">
                  <div class="row">
                      <div class="col-xs-12">
                        <?php
                          echo "
                            <h4>$ticket[centerName] ($ticket[center])</h4>
                            <p><b>Technician</b> : $ticket[technician] ($ticket[technicianMobile])</p>
                            ";
                        ?>
                        <p>
                          <b> Date & Time </b> : ______________________ <br>
                          <b> Job No. &nbsp; &nbsp; &nbsp; &nbsp;</b> : ______________________
                        </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="clearfix"></div>
    </section>
    <section class="jobSection">
        <div class="col-xs-12 panelPart">
          <div class="panel panel-default">
              <div class="panel-footer">
                <div class="row">
                  <?php
                    echo "
                      <div class='col-xs-5'><b>Product :<br></b>$ticket[category] - $ticket[product] <br> $ticket[model] ($ticket[spec1] & $ticket[spec2])</div>
                      <div class='col-xs-2'><b>Quantity :<br></b>$ticket[quantity]</div>
                      <div class='col-xs-5'><b>Problem :<br></b>$ticket[details]</div>
                      ";
                  ?>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-4">D.O.P. :           ____/____/20___</div>
                  <div class="col-xs-4">SR No. :           _______________</div>
                  <div class="col-xs-4">TAG (if any) :     _______________</div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-12"><p>Description of Repair : _____________________________________________________________________</p></div>
                  <div class="col-xs-12"><p>Action Taken : ____________________________________________________________________________</p></div>
                  <div class="col-xs-12"><p>Pending Reason : _________________________________________________________________________</p></div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-xs-12 tableSection">
          <table class="table text-center table-bordered">
            <thead>
              <tr class="tableHead">
                <th style="width:30px;">Sl.</th>
                <th>Replacement Part Name</th>
                <th style="width:100px;">Quantity</th>
                <th style="width:100px;">Unit Price</th>
                <th style="width:100px;text-align:center;">TOTAL</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>2</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>3</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>4</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>5</td>
                <td colspan="3">Tax</td>
                <td></td>
              </tr>
              <tr>
                <td>6</td>
                <td colspan="3">Service Charge</td>
                <td></td>
              </tr>
              <tr>
                <td colspan="4"><b><center>Total</center></b></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-xs-12 ">
            <div class="row">
                <div class="col-xs-6 Sectionleft">
                    <center><p><i>Customer Signature<br><br><br>__________________________</i></p></center>
                </div>
                <div class="col-xs-6 Sectionleft">
                    <center><p><i>Technician Signature<br><br><br>__________________________</i></p></center>
                </div>
            </div>
        </div>
    </section>
  </div>
</section>
<script type="text/javascript">
  $(function(){
    $("body").css('padding-top', '0');
    // $("#top").remove();
    // $("#left").remove();
    // $("#right").remove();
    // $("#footer").remove();
    //$("#content").removeAttr('id');
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
  });
</script>