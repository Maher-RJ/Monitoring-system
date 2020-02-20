<style>
    .group{
        background: linear-gradient(60deg, #242423, #00BCD4);!important;
        color:white
    }
</style>
<table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>node name</th>
        <th>value</th>
        <th>date of sample</th>
    </tr>
    </thead>
</table>
<script>
    var groupColumn = 0;
    $(document).ready(function() {
        $('#data').dataTable( {
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : "{{ route("table.data.".$link.".all") }}",
            "columnDefs": [{
                "visible":false,
                "targets": 0,
            }],
            "columns": [
                { "data": "node","name":"node" },
                { "data": "value","name":"value" },
                { "data": "time","name":"time" },
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
                            '<tr class="group"><td colspan="3">' + group + '</td></tr>'
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
