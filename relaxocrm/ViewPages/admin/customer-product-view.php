<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
if (isset($_GET['date'])) {
    $date =  filter_data($_GET['date']);
    $where = " WHERE cusPrd.ul_timestamp BETWEEN :from AND :to ORDER BY cusPrd.ul_customer_product_id DESC ";
    $whereArray = array(":from"=>"$date 00:00:00", ":to"=>"$date 23:59:59");
}else{
    $where = ' ORDER BY cusPrd.ul_customer_product_id DESC ';
    $whereArray = array();
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
                    <h5>Customer Products Details</h5>
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
                                <th>Customer<br>#CRN</th>
                                <th>Brand</th>
                                <th>Product</th>
                                <th>Purchase</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_customersProduct($start, $results, $where, $whereArray)) {
                                    foreach ($results as $result) {
                                        echo "
                                        <tr class='entity-details' data-id='$result[customer_product_id]' data-entity='customer-product'>
                                            <td class='entity-details' data-id='$result[id]' data-entity='customer-personal'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[customer]<br> $result[code]</a>
                                            </td>
                                            <td>$result[brand]</td>
                                            <td class='entity-details' data-id='$result[product_id]' data-entity='product'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[quantity] pc <br> $result[product] <br> $result[model]</a>
                                            </td>
                                            <td><a href='javascript:void(0);' class='btn-action' data-action='details'>$result[purchase_date]<br>$result[warranty]</a></td>
                                            <td>
                                                <a href='/BestWebs?module=warranty&mode=add&type=new&crn=$result[id]' target='_blank' class='btn btn-info btn-circle btn-line' title='Add More Product'><i class='icon-plus'></i></a>
                                                <a href='/BestWebs?module=warranty&mode=add&type=$result[customer_product_id]&entity=customer-product' target='_blank' class='btn btn-primary btn-circle btn-line' title='Edit Customer Product Details'><i class='icon-edit'></i></a>
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