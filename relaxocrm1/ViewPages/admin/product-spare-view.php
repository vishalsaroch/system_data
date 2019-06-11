<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 2000;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>List Spare Parts</h5>
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
                                <th>Category<br>HSN</th>
                                <th>Name<br>Code</th>
                                <th>Model</th>
                                <th>Spec</th>
                                <th>Brand</th>
                                <th>Warranty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_spares($start, $results, false)) {
                                    foreach ($results as $result) {
                                        if($result['status'] < 1){
                                            $color = "warning";
                                            $action = "<a href='javascript:void(0);' class='btn btn-success btn-circle btn-line btn-action' data-action='unblock' title='Unblock'><i class='icon-ok'></i></a>";
                                        }else{
                                            $color = "";
                                            $action = "<a href='javascript:void(0);' class='btn btn-warning btn-circle btn-line btn-action' data-action='block' title='Block'><i class='icon-ban-circle'></i></a>";
                                        }
                                        echo
                                        "<tr class='entity-details $color' data-id='$result[id]' data-entity='spare'>
                                            <td>$result[category]<br>$result[hsn]</td>
                                            <td>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[name]<br>[$result[code]]</a>
                                            </td>
                                            <td>$result[model]</td>
                                            <td>$result[spec]</td>
                                            <td>$result[brand]</td>
                                            <td>$result[warranty] Months</td>
                                            <td>
                                                <a rel='tab' href='/BestWebs?module=product-spare&mode=add&type=$result[id]' class='btn btn-primary btn-circle btn-line' title='Edit'><i class='icon-edit'></i></a>
                                                <a href='javascript:void(0);' class='btn btn-danger btn-circle btn-line btn-action' data-action='delete' title='Delete'><i class='icon-trash'></i></a>
                                                $action
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