<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 200;
 ?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Store Spare Parts Stock</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                    <i class="icon-th-large"></i> Action
                                </a>
                                <ul class="dropdown-menu dropdown-form-menu">
                                    <form>
                                        <?php
                                            foreach ($_GET as $key=>$value) {
                                                echo "<input type='hidden' name='$key' value='$value'>";
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label>Results Start From</label>
                                            <input type="number" name="start" class="form-control" min="0" value="<?php echo $start; ?>" max="999999" placeholder="From" />
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Results</label>
                                            <input type="number" name="results" class="form-control" min="1" value="<?php echo $results; ?>" max="999999" placeholder="Results" />
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-ok"></i> Load Data</button>
                                    </form>
                                </ul>
                            </li>
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-1" class="accordion-body collapse in body table-responsive">
                    <table class="table table-bordered table-hover wide-table data-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Spec</th>
                                <th>Stock</th>
                                <th>Old Stock</th>
                                <th>Pricing</th>
                                <th>GST</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_spares()) {
                                    foreach ($results as $result) {
                                        $color = '"';
                                        if($result['status'] < 1) $color = 'warning" title="Spare Part is Blocked by Admin"';
                                        echo '
                                        <tr class="entity-details '.$color.' data-id="'.$result['id'].'" data-entity="spare">
                                            <td>'.$result['category'].'</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['name'].' '.$result['model'].'<br>['.$result['code'].']</a>
                                            </td>
                                            <td>'.$result['spec'].'</td>
                                            <td><b>'.$result['stock'].'</b></td>
                                            <td>'.$result['old_stock'].'</td>
                                            <td class="currency-sign">'.$result['price'].'</td>
                                            <td class="percent-sign">'.$result['gst'].'</td>
                                            <td>
                                                <a target="_blank" href="/BestWebs?module=inventory-store&mode=in-view&type=new&stock=fresh&spare='.$result['id'].'" class="btn btn-circle btn-line btn-info" title="View Stock Transactions"><i class="icon-align-justify"></i></a>
                                                <a target="_blank" href="/BestWebs?module=inventory-store&mode=out-view&type=new&stock=old&spare='.$result['id'].'" class="btn btn-circle btn-line btn-warning" title="Add Old Stock Transactions"><i class="icon-list"></i></a>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Load Payout Details in Popover
    $("#content").on('click', '.btn-popover' ,function(e) {
        e.preventDefault();
        $('#payoutDiv').remove();
        var el = $(this),
            price = el.attr('data-price'),
            action = el.attr('data-action'),
            entity_details = el.closest('.entity-details'),
            entity = entity_details.attr('data-entity'),
            id = entity_details.attr('data-id'),
            varsArray = {"adminAjax":action, "entity":entity, "id":id},
            payoutDiv = $('<div id="payoutDiv" />');
        performAjax(varsArray, " ", function(status, msg){
            if(status === "success"){
                if(msg.title) el.attr('title', msg.title);
                var content = $("<small id='payout-popover'/>").append("<p>Commission (<span id='referral-amount-1' class='currency-sign'>"+msg.content.charges1_value+"</span> <span id='referral-type-1'>"+msg.content.charges1_type+"</span>) : <span id='referral-total-1' class='currency-sign'></span></p>");
                content.append("<p>Closing Fee (<span id='referral-amount-2'  class='currency-sign'>"+msg.content.charges2_value+"</span> <span id='referral-type-2'>"+msg.content.charges2_type+"</span>) : <span id='referral-total-2' class='currency-sign'></span></p>");
                content.append("<p>Pack. Charge (<span id='referral-amount-3' class='currency-sign'>"+msg.content.charges3_value+"</span> <span id='referral-type-3'>"+msg.content.charges3_type+"</span>) : <span id='referral-total-3' class='currency-sign'></span></p>");
                content.append("<p class='sr-only' id='sample-price'>"+price+"</p>");
                content.append("<p>Final Payout : <b id='payout-total' class='currency-sign'></b></p>");
                payoutDiv.append(content);
                $('body').append(payoutDiv);
                updateReferalCharges();
                el.attr('data-content', payoutDiv.html());
                el.popover('show');
            }else{
                el.removeAttr('data-content title');
            }
        }, true);
    });
</script>