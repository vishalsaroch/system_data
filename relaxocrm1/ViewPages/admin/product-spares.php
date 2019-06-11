<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$type = $_GET['type'];
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 2000;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>List Product Spares</h5>
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
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Color <br> Size</th>
                                <th>Spare Name<br>Code</th>
                                <th>Spare Model <br> Spec</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_productSpares($start, $results, " ORDER BY prd.ul_product_id DESC ")) {
                                    foreach ($results as $result) {
                                        $action = "<a href='javascript:void(0);' class='btn btn-danger btn-circle btn-line btn-action' data-action='delete' title='Delete'><i class='icon-trash'></i></a>";
                                        if(! $result['spr_model']) $action = "";
                                        echo "
                                        <tr class='entity-details' data-id='$result[prd_id]-$result[spr_id]' data-entity='product-spare'>
                                            <td>$result[prd_category]</td>
                                            <td class='entity-details' data-id='$result[prd_id]' data-entity='product'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[prd_name] $result[prd_model]<br>[$result[prd_code]]</a>
                                            </td>
                                            <td>$result[prd_spec1] <br> $result[prd_spec2]</td>
                                            <td class='entity-details' data-id='$result[spr_id]' data-entity='spare'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[spr_name] <br> [$result[spr_code]]</a>
                                            </td>
                                            <td>$result[spr_model] <br> $result[spr_spec]</td>
                                            <td>$result[spr_qty]</td>
                                            <td>
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