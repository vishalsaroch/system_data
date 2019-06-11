<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;}
$statusArray = [-1=>"Open", 0=>"Pending", 1=>"Closed", 2=>"Canceled", 3=>"Tagged", 4=>"SpareReplaced"];
$fromDate = isset($_GET['fromDate']) ? filter_data($_GET['fromDate']) : date("Y-m-01");
$toDate = isset($_GET['toDate']) ? filter_data($_GET['toDate']) : date("Y-m-d");
$where = " WHERE com.ul_timestamp > :fromDate AND com.ul_timestamp < :toDate ";
$whereArray = array(":fromDate"=>"$fromDate 00:00:00", ":toDate"=>"$toDate 00:00:00");
 ?>
<div class="inner" style="min-height: 700px;">
    <form class="row" style="margin-top: 25px;">
        <?php
            foreach ($_GET as $key=>$value) {
                echo "<input type='hidden' name='$key' value='$value'>";
            }
        ?>
        <div class="col-xxs-6 col-xs-5 col-sm-5 has-success form-group" title="Report from Date">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-signin"></i></span>
                <input type="date" name="fromDate" id="fromDate" class="form-control" min="2017-12-01" value="<?php echo $fromDate; ?>" max="<?php echo date("Y-m-d"); ?>" required>
            </div>
        </div>
        <div class="col-xxs-6 col-xs-5 col-sm-5 has-success form-group" title="Report upto Date">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-signout"></i></span>
                <input type="date" name="toDate" id="toDate" class="form-control" min="2017-12-01" value="<?php echo $toDate; ?>" max="<?php echo date("Y-m-d"); ?>" required>
            </div>
        </div>
        <div class="col-xxs-12 col-xs-2 col-sm-2 has-success form-group">
            <input type="submit" value="Show Results" class="btn btn-success btn-block">
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>List All Centers Report</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-1" class="accordion-body collapse in body">
                    <table class="table table-bordered table-hover wide-table report-data-table">
                        <thead>
                            <tr>
                                <th>Center</th>
                                <th>Type</th>
                                <th>Complaints</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_centersReports($where, $whereArray)) {
                                    foreach ($results as $result) {
                                        echo "
                                        <tr class='entity-details' data-id='$result[id]' data-entity='centers-reports'>
                                            <td class='entity-details' data-id='$result[id]' data-entity='center'>
                                                <a href='javascript:void(0);' class='btn-action' data-action='details'>$result[centerName]<br>[$result[center]]</a>
                                                <a href='/BestWebs?module=report&mode=center-detail&type=all&fromDate=$fromDate&toDate=$toDate&center=$result[id]&centerName=$result[centerName]' target='_blank' class='btn btn-primary btn-circle btn-line pull-right' title='Center Report'><i class='icon-list'></i></a>
                                            </td>
                                            <td>".$statusArray[$result['status']]."</td>
                                            <td>$result[complaints]</td>
                                            <td>$result[quantity]</td>
                                        </tr>
                                        ";
                                    }
                                }
                                // var_dump($results);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var dataTabel = $('.report-data-table').DataTable({
            "dom": 'Brtip',
            "pageLength": 1000,
            responsive: true,
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            select: true,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;

                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                        );
                        last = group;
                    }
                } );
            },
            "columnDefs": [
                { "visible": false, "targets": 0 }
            ],
        });
    dataTabel.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    $('.data-table-box .data-table-filter').on("keyup", function(){
        var Tabel = $('.data-table-box .data-table-filter').index($(this));
        dataTabel.tables(Tabel).search($(this).val()).draw();
    });
</script>