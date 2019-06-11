<?php if($level < 4){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$type = $_GET['type'];
$statusArray = [-1=>"Open", 0=>"Pending", 1=>"Closed", 2=>"Canceled", 3=>"Tagged", 4=>"Spare Replaced"];
if($type == "left"){
    $status = " (com.ul_status = 1 OR com.ul_status = 4) AND fdb.ul_user_id IS NULL ";
}else{
    $type = "done";
    $status = " (com.ul_status = 1 OR com.ul_status = 4) AND fdb.ul_user_id IS NOT NULL " ;
}
if (isset($_GET['date'])) {
    $date =  filter_data($_GET['date']);
    $where = " WHERE $status AND com.ul_timestamp BETWEEN :from AND :to  ";
    $whereArray = array(":from"=>"$date 00:00:00", ":to"=>"$date 23:59:59");
}else if (isset($_GET['est_resolution_date'])) {
    $date =  filter_data($_GET['est_resolution_date']);
    $where = " WHERE $status AND com.ul_est_resolution_date <= :date  ";
    $whereArray = array(":date"=>$date);
}else if (isset($_GET['ticket'])) {
    $code =  filter_data($_GET['ticket']);
    $where = " WHERE com.ul_code = :code OR com.ul_complaint_id = :code ";
    $whereArray = array(":code"=>$code);
}else{
    $where = " WHERE $status ";
    $whereArray = array();
}
if ($level < 8) {
    $action = '';
}else{
    $action = "<a href='javascript:void(0);' class='btn btn-danger btn-circle btn-line btn-action' data-action='delete'  title='Delete'><i class='icon-trash'></i></a>";
}
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 500;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Tickets with Feedback <?php echo ucwords($type); ?></h5>
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
                <script>
                    $('.dropdown-menu').on('click', function(e) {
                        if($(this).hasClass('dropdown-form-menu')) {
                            e.stopPropagation();
                        }
                    });
                </script>
                <div id="box-1" class="accordion-body collapse in body">
                    <table class="table table-bordered table-hover wide-table data-table">
                        <thead>
                            <tr>
                                <th>#Code</th>
                                <th>Customer</th>
                                <th>Brand</th>
                                <th>Product</th>
                                <th>Center/Address</th>
                                <th>In</th>
                                <th>Closed</th>
                                <th>Call User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_ticketFeedbacks($start, $results, $where, $whereArray)) {
                                    foreach ($results as $result) {
                                        echo "
                                        <tr class='entity-details' data-id='$result[id]' data-entity='ticket'>
                                            <td>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[code]</a>
                                            </td>
                                            <td>
                                                $result[customer] <br> $result[mobile]
                                            </td>
                                            <td>$result[brand]</td>
                                            <td>Qty : $result[quantity] <br> $result[product] <br> $result[model]</td>
                                            <td>$result[centerName] [$result[center]] <br> $result[city]</td>
                                            <td>$result[open_time]</td>
                                            <td>
                                                <a href='javascript:void(0);' class='btn-action' data-action='jobdetails'>$result[close_time] <br> ".$statusArray[$result["status"]]."</a>
                                            </td>
                                            <td>$result[user]</td>
                                            <td>
                                                <a href='javascript:void(0);' class='btn btn-default btn-circle btn-line btn-action' data-action='feedback'  title='Add Feedback'><i class='icon-comments'></i></a>
                                                <span class='entity-details' data-id='$result[feedback_idn]' data-entity='feedback'>
                                                    $action
                                                </span>
                                            </td>
                                        </tr>
                                        ";
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
    $(function(){
        $("body").on('click', '#ticketFeedback' ,function(e) {
            e.preventDefault();
            $("#modal").modal("hide");
            var rating = $('[name="rating"]').val(),
                review = $('[name="review"]').val();
                if(!review){
                    $("#reviewMsg").html("<span style='color:red;'>Required *</span>");
                    return;
                }else if(!rating){
                    $("#ratingMsg").html("<span style='color:red;'>Required *</span>");
                    return;
                }
                action = "ticketFeedback",
                entity = $(this).attr("data-id"),
                entity_details = $("tr[data-id="+entity+"]"),
                varsArray = {"adminAjax":action, "entity":entity, "id":{"review":review, "rating":rating}};
            performAjax(varsArray, " ", function(status, msg){
                showResponse(status, msg);
                if(status === "success"){
                    dataTabel.row( entity_details ).remove().draw();
                }
            }, true);
        });
    });
</script>