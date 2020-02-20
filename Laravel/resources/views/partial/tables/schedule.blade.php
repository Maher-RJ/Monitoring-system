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
        <th>node name</th>
        <th>next duration</th>
        <th>cycle</th>
        <th>node status</th>
        <th>last schedule calculation</th>
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
                { "data": "node","name":"node" },
                { "data": "duration","name":"duration" },
                { "data": "cycleTime","name":"cycleTime" },
                { "data": "status","name":"status" },
                { "data": "lastCalc","name":"lastCalc" },
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
                            '<tr class="group"><td colspan="7">' + group + '</td></tr>'
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