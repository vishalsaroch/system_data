<?php
$level = $function->checkLogin();
if ($level < 2) {
    header('Location: /error/404');
    exit;
}
$title = "Welcome to ".CLIENT_TITLE.' Administration ';
PageHead($title);
    ?>
<body class="padTop53 " >
    <div id="wrap" >
        <?php
            PageTopBar();
            PageLeftNavBar(); ?>
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Admin Dashboard </h1>
                    </div>
                </div>
                <hr />
                <!--BLOCK SECTION -->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <tr>
                                <th>Order ID</th>
                                <th>User Id</th>
                                <th>Order</th>
                                <th>Items</th>
                                <th>Time</th>
                            </tr>
                            <?php
                                $orders = $function->getArray_sessionData();
                                foreach ($orders as $order) {
                                    echo '
                                    <tr>
                                        <td>'.$order['ul_id'].'</td>
                                        <td>'.$order['ul_user_id'].'</td>
                                        <td><pre>';print_r(json_decode($order['ul_order_json_array'], true));echo '</pre></td>
                                        <td><pre>';print_r(json_decode($order['ul_cart_json_array'], true));echo '</pre></td>
                                        <td>'.$order['ul_timestamp'].'</td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <!--END BLOCK SECTION -->
                <hr />
            </div>
        </div>
        <!-- END RIGHT STRIP  SECTION -->
    </div>
    <!--END MAIN WRAPPER -->
    <?php
        pageFooter();
        PageJsInclude();
    ?>
</body>
    <!-- END BODY -->
</html>
