<?php if($level < 3){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$statusArray = [-1=>"Open", 0=>"Pending", 1=>"Closed", 2=>"Canceled", 3=>"Tagged", 4=>"SpareReplaced"];
$fromDate = isset($_GET['fromDate']) ? filter_data($_GET['fromDate']) : date("Y-m-01");
$toDate = isset($_GET['toDate']) ? filter_data($_GET['toDate']) : date("Y-m-d");
if ($_SESSION["SESS__center_id"] == 1) {
    $centers = $function->getArrayOptions_All_Table('partners_centers', array('center_id center', 'name centerName'));
    if(isset($_GET['center'])){
        $center = filter_data($_GET['center']);
    }else{
        $center = false;
    }
}else{
    $centers = [["center"=>$_SESSION["SESS__center_id"], "centerName"=>$_SESSION["SESS__center"]]];
    $center = $_SESSION["SESS__center_id"];
}
$where = " WHERE com.ul_center_id = :center AND com.ul_timestamp > :fromDate AND com.ul_timestamp < :toDate ";
$whereArray = array(":center"=>(int)$center, ":fromDate"=>"$fromDate 00:00:00", ":toDate"=>"$toDate 00:00:00");
$results = $center ? $function->getArray_centerReportDetail($where, $whereArray) : false;
$totalPayKM = 0;
$totalPayComplaints24 = 0;
$totalPayComplaintQties24 = 0;
$totalPayComplaints48 = 0;
$totalPayComplaintQties48 = 0;
$totalPayComplaints72 = 0;
$totalPayComplaintQties72 = 0;
$totalPayComplaints = 0;
$totalPayComplaintQties = 0;
// $output = array();
// foreach($results as $item) {
//     if(!isset($output[$item['time']])) {
//         $output[$item['time']] = array();
//     }
//     $catName = $item['time'];
//     unset($item['time']);
//     $output[$catName][] = $item;
// }
?>
<div class="inner" style="min-height: 700px;">
    <form class="row" style="margin-top: 25px;">
        <?php
            foreach ($_GET as $key=>$value) {
                echo "<input type='hidden' name='$key' value='$value'>";
            }
            if ($_SESSION["SESS__center_id"] == 1) {
                echo "<div class='col-xxs-6 col-xs-6 col-sm-4  has-success form-group' title='Report for Center'>
                        <div class='input-group'>
                            <span class='input-group-addon'><i class='icon-user'></i></span>
                            <select name='center' id='center' class='form-control' required>
                                <option value=''>Select Center ...</option>";
                        foreach ($centers as $centerr) {
                            echo "<option value='$centerr[center]'>$centerr[centerName]</option>";
                        }
                        echo "</select>
                        </div>
                    </div>";
            }
        ?>
            <div class="col-xxs-6 col-xs-6 col-sm-3  has-success form-group" title="Report from Date">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-signin"></i></span>
                <input type="date" name="fromDate" id="fromDate" class="form-control" min="2017-12-01" value="<?php echo $fromDate; ?>" max="<?php echo date("Y-m-d"); ?>" required>
            </div>
        </div>
        <div class="col-xxs-6 col-xs-6 col-sm-3  has-success form-group" title="Report upto Date">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-signout"></i></span>
                <input type="date" name="toDate" id="toDate" class="form-control" min="2017-12-01" value="<?php echo $toDate; ?>" max="<?php echo date("Y-m-d"); ?>" required>
            </div>
        </div>
        <div class="col-xxs-6 col-xs-6 col-sm-2  has-success form-group">
            <input type="submit" value="Show Results" class="btn btn-success btn-block">
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Center Jobs Report</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-1" class="accordion-body collapse in body">
                    <table class="table table-hover table-bordered wide-table data-table report-data-table">
                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>KM</th>
                                <th>Job Status</th>
                                <th>Action Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results) {
                                    $tickets = [];
                                    foreach ($results as $result) {
                                        if ($result['status'] == 1 || $result['status'] == 4) {
                                            if (! in_array($result['complaint'], $tickets)) {
                                                if ($result['time'] <= 24 ) {
                                                    $totalPayComplaints24++;
                                                    $totalPayComplaintQties24 += $result['quantity'];
                                                }elseif ($result['time'] > 24 && $result['time'] <= 48) {
                                                    $totalPayComplaints48++;
                                                    $totalPayComplaintQties48 += $result['quantity'];
                                                }elseif ($result['time'] > 48 && $result['time'] <= 72) {
                                                    $totalPayComplaints72++;
                                                    $totalPayComplaintQties72 += $result['quantity'];
                                                }else {
                                                    $totalPayComplaints++;
                                                    $totalPayComplaintQties += $result['quantity'];
                                                }
                                                $tickets[] = $result['complaint'];
                                            }
                                            if($result['km'] > THRESHOLD_KM) $totalPayKM += $result['km'];
                                        }
                                        echo "
                                        <tr class='entity-details' data-id='$center' data-entity='centers-reports'>
                                            <td class='entity-details' data-id='$result[complaint]' data-entity='ticket'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[code] <br> $result[open_time]</a>
                                            </td>
                                            <td class='entity-details' data-id='$result[customer_id]' data-entity='customer'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[customer] <br> [$result[crn]]</a>
                                            </td>
                                            <td class='entity-details' data-id='$result[product_id]' data-entity='product'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'> $result[brand] <br> $result[product] $result[model]</a>
                                            </td>
                                            <td>$result[quantity]</td>
                                            <td>$result[km]</td>
                                            <td class='entity-details' data-id='$result[job_id]' data-entity='job'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>".$statusArray[$result['status']]."</a>
                                            </td>
                                            <td>$result[time] Hrs</td>
                                        </tr>
                                        ";
                                    }
                                }
                                // var_dump($results);
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" title="Action Hours Between 0 to 72 Hours">Total Payable Ticket Quantities</th>
                                <th title="Only Closed Tickets Jobs Counted"><?php echo $totalPayComplaintQties24+$totalPayComplaintQties48+$totalPayComplaintQties72; ?></th>
                                <th title="Minimum Threshold Limit is <?php echo THRESHOLD_KM; ?>"><?php echo $totalPayKM; ?></th>
                                <th>Closed Only</th>
                                <th>upto 72 hours </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("[name=center]").val('<?php echo $center; ?>');
    });
</script>