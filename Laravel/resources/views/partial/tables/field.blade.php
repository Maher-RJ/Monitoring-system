<style>
    .group{
        background-color:#8e24aa!important;
        color:white
    }
</style>
<table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>region</th>
        <th>area name</th>
        <th>soil type</th>
        <th>crop name</th>
        <th>plant date</th>
        <th>expected harvest date</th>
        <th>current stage</th>
        <th>node name</th>
        <th>status</th>
    </tr>
    </thead>
</table>
<script>
    var groupColumn = 0;
    $(document).ready(function() {
        $('#data').dataTable( {
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : "{{ route("table.".$title.".all") }}",
            "columnDefs": [{
                "visible":false,
                "targets": 0,
            }],
            "columns": [
                { "data": "region","name":"region" },
                { "data": "area","name":"area" },
                { "data": "soil","name":"soil" },
                { "data": "crop","name":"crop" },
                { "data": "plantdate","name":"plantdate" },
                { "data": "harvestdate","name":"harvestdate" },
                { "data": "stage","name":"stage" },
                { "data": "node","name":"node" },
                { "data": "status","name":"status" },
            ],
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(groupColumn, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="8">' + group + '</td></tr>'
                        );

                        last = group;
                    }
                });
            }
        });
        $('#data tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            } else {
                table.order([groupColumn, 'asc']).draw();
            }
        });
    } );

</script>
