<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <h1> <?php echo $function->getData_designationByLevel($_SESSION['SESS__azz_level']); ?> Dashboard </h1>
        </div>
    </div>
    <hr />
    <!--BLOCK SECTION -->
    <div class="row sr-only">
        <div class="col-lg-12">
            <div style="text-align: center;">
                <a class="quick-btn" href="#">
                    <i class="icon-check icon-2x"></i>
                    <span> Products</span>
                    <span class="label label-danger">2</span>
                </a>

                <a class="quick-btn" href="#">
                    <i class="icon-envelope icon-2x"></i>
                    <span>Messages</span>
                    <span class="label label-success">456</span>
                </a>
                <a class="quick-btn" href="#">
                    <i class="icon-signal icon-2x"></i>
                    <span>Profit</span>
                    <span class="label label-warning">+25</span>
                </a>
                <a class="quick-btn" href="#">
                    <i class="icon-external-link icon-2x"></i>
                    <span>value</span>
                    <span class="label btn-metis-2">3.14159265</span>
                </a>
                <a class="quick-btn" href="#">
                    <i class="icon-lemon icon-2x"></i>
                    <span>tasks</span>
                    <span class="label btn-metis-4">107</span>
                </a>
                <a class="quick-btn" href="#">
                    <i class="icon-bolt icon-2x"></i>
                    <span>Tickets</span>
                    <span class="label label-default">20</span>
                </a>



            </div>
        </div>
    </div>
    <!--END BLOCK SECTION -->
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="box success data-table-box">
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
                                if ($orders = $function->getArray_pendingOrders()) {
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
    <div class="row">
        <div class="col-lg-12">
            <div class="box warning data-table-box">
                <header>
                    <div class="icons"><i class="icon-truck"></i></div>
                    <h5>Orders for Pickup</h5>
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
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-2">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-2" class="accordion-body collapse in body">
                    <table class="table table-bordered table-hover wide-table data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Items</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($orders = $function->getArray_pendingOrders()) {
                                    foreach ($orders as $order) {
                                        echo '
                                        <tr>
                                            <td>'.CLIENT_SHORT_NAME.$order['id'].'</td>
                                            <td id="'.$order['customer'].'">'.$order['customerName'].'</td>
                                            <td><center>'.$order['centerSku'].'<br>'.$order['productTitle'].'</center></td>
                                            <td>'.$order['quantity'].'</td>
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