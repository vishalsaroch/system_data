<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$type = $_GET['type'];
$statusArray = [-1=>"Open", 0=>"Pending", 1=>"Closed", 2=>"Canceled", 3=>"Tagged", 4=>"Spare Replaced"];
if($type == "open"){
    $where = " WHERE job.ul_status = -1 ORDER BY job.ul_job_id DESC ";
}elseif($type == "closed"){
    $where = " WHERE job.ul_status = 1  ORDER BY job.ul_job_id DESC";
}elseif($type == "canceled"){
    $where = " WHERE job.ul_status = 2  ORDER BY job.ul_job_id DESC";
}else{
    $where = " WHERE job.ul_status = 0  ORDER BY job.ul_job_id DESC";
}
$whereArray = array();
$type = ucwords($type);
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 500;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>View Jobs</h5>
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
                <div id="box-1" class="accordion-body collapse in body">
                    <table class="table table-bordered table-hover wide-table data-table">
                        <thead>
                            <tr>
                                <th>#Job</th>
                                <th>#Complaint</th>
                                <th>Work Done</th>
                                <th>Type</th>
                                <th>Attender</th>
                                <th>Status <br> Time</th>
                                <th>KM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_jobs($start, $results, $where, $whereArray)) {
                                    foreach ($results as $result) {
                                        echo "
                                        <tr class='entity-details' data-id='$result[id]' data-entity='job'>
                                            <td>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>#$result[id]</a>
                                            </td>
                                            <td class='entity-details' data-id='$result[complaint_id]' data-entity='ticket'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[code]</a>
                                            </td>
                                            <td>$result[work_done] <br> <b>$result[replaced_spare]</b></td>
                                            <td><b>$result[type]</b> <br> $result[status]</td>
                                            <td>$result[attender]</td>
                                            <td><small>$result[job_time]</small> <br> <b>".$statusArray[$result["stts"]]."</b></td>
                                            <td>$result[km]</td>
                                            <td>
                                                <a href='javascript:void(0);' class='btn btn-danger btn-circle btn-line btn-action' data-action='delete' title='Delete'><i class='icon-trash'></i></a>
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