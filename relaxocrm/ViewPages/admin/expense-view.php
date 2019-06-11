<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
if (isset($_GET['date'])) {
    $date =  filter_data($_GET['date']);
    $where = " WHERE exp.ul_date BETWEEN :from AND :to ";
    $whereArray = array(":from"=>"$date 00:00:00", ":to"=>"$date 23:59:59");
}else{
    $where = '';
    $whereArray = array();
}
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 200;
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 200;

?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Expenses/Income Details</h5>
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
                                <th>Type<br>Invoice/Challan</th>
                                <th>Detail</th>
                                <th>Date</th>
                                <th>Amount<br>GST</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_expenses($start, $results, $where, $whereArray)) {
                                    foreach ($results as $result) {
                                        $type = ($result['amount'] > 0) ? 'success' : '';
                                        echo '
                                        <tr class="entity-details '.$type.'" data-id="'.$result['id'].'" data-entity="customer_oersonal">
                                            <td>
                                                <a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['type'].'<br> '.$result['code'].'</a>
                                            </td>
                                            <td>'.$result['description'].'</td>
                                            <td>'.$result['date'].'</td>
                                            <td>'.$result['amount'].'<br>'.$result['gst'].'</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-line btn-action" data-action="edit" title="Edit"><i class="icon-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-circle btn-line btn-action" data-action="block" title="Block"><i class="icon-ban-circle"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-success btn-circle btn-line btn-action" data-action="unblock" title="Unblock"><i class="icon-ok"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-line btn-action" data-action="delete" title="Delete"><i class="icon-trash"></i></a>
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