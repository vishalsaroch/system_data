<?php if($level < 8){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
if (isset($_GET['date'])) {
    $date =  filter_data($_GET['date']);
    $where = " AND (ul_timestamp BETWEEN :from AND :to) ";
    $whereArray = array(":from"=>"$date 00:00:00", ":to"=>"$date 23:59:59");
}else if (isset($_GET['number'])) {
    $number =  filter_data($_GET['number']);
    $where = " AND (ul_number = :number) ";
    $whereArray = array(":number"=>$number);
}else{
    $where = " ";
    $whereArray = array();
}
$type = isset($_GET['type']) ? $_GET['type'] : '';
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 200;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Pending Miss-Calls</h5>
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
                                <th>#Count</th>
                                <th>Number</th>
                                <th>Circle</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($type === "all") {
                                    if ($results = $function->getArray_missCalls("all", $start, $results, $where, $whereArray)) {
                                        foreach ($results as $result) {
                                            if ($result['status'] == '0') {
                                                $color = 'danger';
                                            }else{
                                                $color = '';
                                            }
                                            echo '
                                            <tr class="entity-details '.$color.'" data-id="'.$result['mobile'].'" data-misscall="'.$result['id'].'" data-entity="misscall">
                                                <td>'.$result['id'].'</td>
                                                <td class="contact"><a href="tel:'.$result['mobile'].'">'.$result['mobile'].'</a></td>
                                                <td>'.$result['circle'].'</td>
                                                <td>'.$result['time'].'</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn-action" data-action="tag-detail" title="Tag this Call">'.$result['name'].'<br>'.$result['callTime'].'</a>
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    }
                                }else{
                                    if ($results = $function->getArray_missCalls("new", $start, $results, $where, $whereArray)) {
                                        foreach ($results as $result) {
                                            echo '
                                            <tr class="entity-details" data-id="'.$result['mobile'].'" data-misscall="'.$result['id'].'" data-entity="misscall">
                                                <td>'.$result['id'].'</td>
                                                <td><a href="tel:'.$result['mobile'].'" class="contact">'.$result['mobile'].'</a></td>
                                                <td>'.$result['circle'].'</td>
                                                <td>'.$result['time'].'</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm btn-line btn-action" data-action="call" title="Tag this Call"><i class="icon-comments"></i></a>
                                                </td>
                                            </tr>
                                            ';
                                        }
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