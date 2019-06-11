<?php if($level < 1){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-xs-8">
            <h4><br> <?php echo "Welcome $_SESSION[SESS__name]" ?> </h4>
        </div>
        <?php
            $centerId = $_SESSION['SESS__center_id'];
            if($level >= 8){
            ?>
            <div class="col-xs-4 form-group">
                <label>&nbsp;</label>
                <select class="form-control" id="selectedCenter" onchange="window.location = '/BestWebs?module=home&mode=dashboard&type=login&center='+this.value">
                    <?php
                        $centers = $function->getArrayOptions_All_Table('partners_centers', array('center_id id', 'city city', 'name center'), " WHERE ul_status > 0 ");
                        foreach($centers as $center){
                            echo "<option value='$center[id]'>$center[center] - $center[city]</option>";
                        }
                    ?>
                </select>
            </div>
            <?php
                if(isset($_GET['center'])) $centerId = filter_data($_GET['center']);
            }
            $dashboard = $function->getData_dashboard($centerId);
        ?>
        <!-- <div class="clearfix"></div>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <b>We are Upgrading Our Server to serve you better, Some features may not work properly. Sorry for the Inconvenience.</b>
        </div> -->
    </div>
    <?php
        if($level >= 5){
    ?>
    <hr />
    <!--BLOCK SECTION -->
    <div class="row">
        <div class="col-xs-4 has-success form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-phone"></i></span>
                <input type="text" id="mobile" class="form-control" placeholder="Customer Mobile Search">
            </div>
        </div>
        <div class="col-xs-4 has-success form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" id="crn" class="form-control" placeholder="Customer CRN Search">
            </div>
        </div>
        <div class="col-xs-4 has-success form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-credit-card"></i></span>
                <input type="text" id="ticket" class="form-control" placeholder="Customer Ticket Search">
            </div>
        </div>
    </div>
    <!--END BLOCK SECTION -->
    <?php
        }
    ?>
    <hr />
    <div class="row">
        <center>
            <div class="col-md-2 col-xs-4 col-xxs-6">
                <a rel="tab" class="quick-btn" href="/BestWebs?module=customer&mode=product-view&type=all&date=<?php echo $today = date('Y-m-d'); ?>">
                    <i class="icon-check icon-2x"></i>
                    <span> Today's Products </span>
                    <span class="label btn-metis-2"><?php echo $dashboard["todayProduct"]; ?></span>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 col-xxs-6">
                <a rel="tab" class="quick-btn" href="/BestWebs?module=ticket&mode=view&type=open&date=<?php echo $today; ?>">
                    <i class="icon-envelope icon-2x"></i>
                    <span> Today's Ticket </span>
                    <span class="label btn-metis-4"><?php echo $dashboard["todayTicket"]; ?></span>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 col-xxs-6">
                <a rel="tab" class="quick-btn" href="/BestWebs?module=job&mode=view&type=all&date=<?php echo $today; ?>">
                    <i class="icon-signal icon-2x"></i>
                    <span>Today's Updated</span>
                    <span class="label label-warning"><?php echo $dashboard["todayUpdated"]; ?></span>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 col-xxs-6">
                <a rel="tab" class="quick-btn" href="/BestWebs?module=ticket&mode=view&type=open&est_resolution_date=<?php echo $today; ?>">
                    <i class="icon-external-link icon-2x"></i>
                    <span>Today's Completion</span>
                    <span class="label label-danger"><?php echo $dashboard["todayCompletion"]; ?></span>
                </a>
            </div>
            <div class="col-md-2 col-xs-4 col-xxs-6">
                <a rel="tab" class="quick-btn" href="/BestWebs?module=ticket&mode=view&type=open">
                    <i class="icon-lemon icon-2x"></i>
                    <span>Total Pending</span>
                    <span class="label label-danger"><?php echo $dashboard["totalPending"]; ?></span>
                </a>
            </div>
        </center>
    </div>
    <!--END BLOCK SECTION -->
    <hr />
    <!--  STACKING CHART  SECTION   -->
    <div class="row">
        <?php if($_SESSION['SESS__azz_level'] > 4){ ?>
        <div class="col-lg-5">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-text-width"></i></div>
                    <h5>Ticket Stats</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    <div class="demo-container" style="margin: 0;">
                        <div id="placeholder" class="demo-placeholder"></div>
                    </div>
                    <center><p>
                        <span style="color:#a2cd5a;margin:0 10px;padding:5px;background-color: rgba(0,0,0,0.6);">Closed : <?php echo $dashboard["totalClosed"]; ?></span>
                        <span style="color:#eead0e;margin:0 10px;padding:5px;background-color: rgba(0,0,0,0.6);">Canceled : <?php echo $dashboard["totalCanceled"]; ?></span>
                        <span style="color:#ff7256;margin:0 10px;padding:5px;background-color: rgba(0,0,0,0.6);">Pending : <?php echo $dashboard["totalPending"]; ?></span>
                    </p></center>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-mobile-phone"></i></div>
                    <h5>Missed Calls</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown entity-details" entity="misscall">
                                <a data-toggle="dropdown" class="btn-action" data-action="refresh-misscall" href="javascript:void(0);">
                                    <i class="icon-refresh"></i>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <form name="form" action="" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                        <label for="uploadExcel" style="margin:0;">
                                            <i class="icon-list-alt"></i> Upload Excel
                                            <input type="file" id="uploadExcel" name="uploadExcel" onchange="uploadExcelf(this.form);">
                                        </label>
                                        <input type="hidden" name="adminProcess" value="uploadExcel">
                                    </form>
                                </a>
                            </li> -->
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-2">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="div-2" class="accordion-body collapse in body">
                    <table class="table table-bordered table-hover wide-table ">
                        <thead>
                            <tr>
                                <th>#Count</th>
                                <th>Number</th>
                                <th>Circle</th>
                                <th>Time</th>
                                <th><a href="/BestWebs?module=call&mode=view&type=all" target="_blank">Action</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_missCalls("new", 0, 10)) {
                                    foreach ($results as $result) {
                                        echo '
                                        <tr class="entity-details" data-id="'.$result['mobile'].'" data-misscall="'.$result['id'].'" data-entity="misscall">
                                            <td>'.$result['id'].'</td>
                                            <td class="contact"><a href="tel:'.$result['mobile'].'">'.$result['mobile'].'</a></td>
                                            <td>'.$result['circle'].'</td>
                                            <td>'.$result['time'].'</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm btn-line btn-action" data-action="call" title="Tag this Call"><i class="icon-comments"></i></a>
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
        <?php }else{ ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Ticket Stacking</div>
                <div class="panel-body">
                    <div class="demo-container" style="margin: 0;">
                        <div id="placeholder" class="demo-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!--END STACKING CHART SCETION  -->
</div>
<?php
    echo '
        <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/flot/jquery.flot.js?BestWebs"></script>
        <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/flot/jquery.flot.resize.js?BestWebs"></script>
        <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/flot/jquery.flot.pie.js?BestWebs"></script>';
?>
<script type="text/javascript">
    $(function () {

        $("#mobile").on("change", function(event){
            var id = $(this).val();
            if(id.length != 10) return;
            var action = "fetchDependentSelect",
                entity = "mobile-CustomerProduct",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Customer with Mobile <b>"+id+"</b> is not in our Database <a href='/BestWebs?module=warranty&mode=add&type=new' target='_blank'> Click Here to add </a> or Try another.", 10000);
                        $(".ajax-form")[0].reset();
                        return;
                    }
                    plotCustomer(id, msg);
                }
            });
        });

        $("#crn").on("change", function(event){
            var id = $(this).val();
            var action = "fetchDependentSelect",
                entity = "crn-CustomerProduct",
                varsArray = {"adminAjax":action, "entity":entity, "id":id};
            performAjax(varsArray, " ", function(status, msg){
                if(status === "success"){
                    if(! msg) {
                        showResponse("danger", "Customer with CRN <b>#"+id+"</b> is not in our Database <a href='/BestWebs?module=warranty&mode=add&type=new' target='_blank'> Click Here to add New</a> or Try another.", 10000);
                        $(".ajax-form")[0].reset();
                        return;
                    }
                    plotCustomer(id, msg);
                }
            });
        });

        $("#ticket").on('change', function(event) {
            event.preventDefault();
            var ticket = $(this).val();
            window.open("/BestWebs?module=ticket&mode=view&type=all&ticket="+ticket, "_blank");
        });

        $("body").on('click', '.add-new-option-btn', function(event) {
            event.preventDefault();
            var crn = $(this).parent().find('.crn').text();
            window.open("/BestWebs?module=ticket&mode=add&type=new&crn="+crn, "_blank");
            $("#modal").modal("hide");
        });

        $("#selectedCenter").val('<?php echo $centerId; ?>');
        var data = [
            {
                label: "Closed",
                color:"#a2cd5a",
                data: <?php echo $dashboard["totalClosed"]; ?>
            },
            {
                label: "Canceled",
                color:"#eead0e",
                data: <?php echo $dashboard["totalCanceled"]; ?>
            },
            {
                label: "Pending",
                color:"#ff7256",
                data: <?php echo $dashboard["totalPending"]; ?>
            }
        ];
        var placeholder = $("#placeholder");
        placeholder.unbind();
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });
        setCode([
            "$.plot('#placeholder', data, {",
            "    series: {",
            "        pie: { ",
            "            show: true,",
            "            radius: 1,",
            "            label: {",
            "                show: true,",
            "                radius: 3/4,",
            "                formatter: labelFormatter,",
            "                background: { ",
            "                    opacity: 0.5,",
            "                    color: '#000'",
            "                }",
            "            }",
            "        }",
            "    },",
            "    legend: {",
            "        show: false",
            "    }",
            "});"
        ]);
    });
    function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" +
                    label +
                    "<br/>" +
                    Math.round(series.percent) +
                "%</div>";
    }
    function setCode(lines) {
        $("#code").text(lines.join("\n"));
    }
</script>