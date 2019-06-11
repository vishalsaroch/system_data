<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box data-table-box">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Pending Orders</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Action
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">#</a></li>
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
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($orders = $function->getArray_center_orders('pending')) {
                                    foreach ($orders as $order) {
                                        echo '
                                        <tr>
                                            <td>'.CLIENT_SHORT_NAME.$order['id'].'</td>
                                            <td id="'.$order['customer'].'">'.$order['customerName'].'</td>
                                            <td><center>'.$order['centerSku'].'<br>'.$order['productTitle'].'</center></td>
                                            <td>'.$order['quantity'].'</td>
                                            <td>'.$order['timestamp'].'</td>
                                            <td>
                                                <div class="btn-group">
                                                  <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle">Deny <span class="caret"></span></button>
                                                  <ul class="dropdown-menu" id="'.$order['id'].'">
                                                    <li><a class="denyBtn" href="#">Out Of Stock</a></li>
                                                    <li class="divider"></li>
                                                    <li><a class="denyBtn" href="#">Out Of Reach</a></li>
                                                    <li class="divider"></li>
                                                    <li><a class="denyBtn" href="#">Wrong Order</a></li>
                                                  </ul>
                                                </div>
                                                <div class="btn-group">
                                                  <button data-toggle="dropdown" class="btn btn-success btn-sm packedBtn" id="'.$order['id'].'"> Packed </button>
                                                </div>
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
<script type="text/javascript">
    $(function(){
        $('.packedBtn').on('click', function(event) {
            var id = $(this).attr('id'),
                varsArray = {"ajax":"changeOrderStatus", "status":"packed", "cause":"", "id":id};
            performAjax(varsArray);
        });
        $('.denyBtn').on('click', function(event) {
            var id = $(this).parent().attr('id'),
                cause = $(this).text(),
                varsArray = {"ajax":"changeOrderStatus", "status":"deny", "cause":cause, "id":id};
            performAjax(varsArray);
        });
    });
    //console.log(dataTabel);
</script>