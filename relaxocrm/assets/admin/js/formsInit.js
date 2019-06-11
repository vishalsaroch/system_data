function formInit() {
    "use strict";

    /*----------- BEGIN DataTables CODE -------------------------*/
    dataTabel = $('.data-table').DataTable({
        "dom": 'Blrtip',
        "pageLength": 10,
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
        select: true
    });
    dataTabel.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    $('.data-table-box .data-table-filter').on("keyup", function(){
        var Tabel = $('.data-table-box .data-table-filter').index($(this));
        dataTabel.tables(Tabel).search($(this).val()).draw();
    });
    /*----------- END DataTables CODE -------------------------*/

    /*----------- BEGIN chosen CODE -------------------------*/
    $('.chzn-select').each(function(index) {
        $(this).chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, not found!"
        });
        this.setAttribute('style','display:inline; position:absolute; clip:rect(0,0,0,0)');
    });
    $(".chzn-select-nosearch").chosen();
    $(".chzn-select-deselect").chosen({
        allow_single_deselect: true
    });
    /*----------- END chosen CODE -------------------------*/

    // tooltip demo
    $("[data-toggle=tooltip]").tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]").popover();

    // $('.datepicker').datepicker({
    //     autoclose: true,
    //     format: 'yyyy-mm-dd'
    // }).on('changeDate', function(e){
    //     $(this).datepicker('hide');
    // });

    $('.with-tooltip').tooltip({
        selector: ".input-tooltip"
    });

    /*----------- BEGIN autosize CODE -------------------------*/
    $('#autosize').autosize();
    /*----------- END autosize CODE -------------------------*/

    /*----------- BEGIN uniform CODE -------------------------*/
    $('.uniform').uniform();
    /*----------- END uniform CODE -------------------------*/
}