<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$type = $_GET['type'];
if (isset($_GET['product'])) {
    $product =  (int) filter_data($_GET['product']);
    $where = " WHERE (chl.ul_product_id = :product) AND (chl.ul_type = 'In') ORDER BY chl.ul_challan_id DESC ";
    $whereArray = array(":product"=>$product);
}else{
    $where = " WHERE chl.ul_type = 'In' ORDER BY chl.ul_challan_id DESC  ";
    $whereArray = array();
}
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 2000;
?>
<style>
    .dropdown-form-menu{
        padding: 10px;
    }
</style>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>Product Store Inward Entries</h5>
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
                                <th>Challan/ Invoice</th>
                                <th>Brand</th>
                                <th>Product</th>
                                <th>Factory</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_inwardChallan($start, $results, $where, $whereArray)) {
                                    foreach ($results as $result) {
                                        echo "
                                        <tr class='entity-details' data-id='$result[id]' data-entity='inwardChallan'>
                                            <td>$result[code_type]<br>$result[code]</td>
                                            <td>$result[brand]</td>
                                            <td>$result[category], $result[name]<br>$result[model]($result[spec1], $result[spec2])</td>
                                            <td class='entity-details' data-id='$result[centerId]' data-entity='center'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[center]</a>
                                            </td>
                                            <td><b>$result[stock] pc</b><br> (".intval($result["stock"]/$result["unit"])." nag)</td>
                                            <td>$result[date]</td>
                                            <td>
                                                <a rel='tab' href='/BestWebs?module=inventory-store&mode=in-add&type=$result[id]&stock=fresh' class='btn btn-circle btn-line btn-warning' title='Edit Stock Entry'><i class='icon-edit'></i></a>
                                                <a href='javascript:void(0);' class='btn btn-circle btn-line btn-danger btn-action' data-action='delete' title='Delete Stock Entry'><i class='icon-trash'></i></a>
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