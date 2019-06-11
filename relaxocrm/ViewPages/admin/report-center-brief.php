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
$results = $center ? $function->getArray_centersReportsBrief($where, $whereArray) : false;
// print_r($results);
$output = array();
foreach($results as $item) {
    if(!isset($output[$item['time']])) {
        $output[$item['time']] = array();
    }
    $catName = $item['time'];
    unset($item['time']);
    $output[$catName][] = $item;
}
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
                    <h5>Center Bill Brief</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <!-- <li><input class="data-table-filter" type="text" placeholder="Search ..."></li> -->
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-1" class="accordion-body collapse in body">
                    <table class="table table-hover tab-responsive">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Tickets</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($output as $key=>$value) {
                                    echo "<tr><th colspan='3'>$key</th> </tr>";
                                    foreach ($value as $type) {
                                        echo "<tr>
                                            <td>".$statusArray[$type["status"]]."</td>
                                            <td>$type[complaints]</td>
                                            <td>$type[quantity]</td>
                                            <td>$type[rate]</td>
                                            <td>".($type['quantity']*$type['rate'])."</td>
                                        </tr>";
                                    }
                                }
                            ?>
                            <?php

                                // var_dump($results);
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>

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