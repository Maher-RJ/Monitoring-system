<table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
</table>
<script>
    $(document).ready(function() {
        $('#data').dataTable( {
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : "{{ route("form.".$title.".all") }}",
            "columns": [
                { "data": "id","name":"id" },
                { "data": "name","name":"name" },
                {"mRender": function ( data, type, row ) {
                        return '<button class="btn btn-info"  onclick="edit(\''+row.id+'\',\''+row.name+'\')">Edit</button >';}
                }
            ]
        });
    } );
    function edit(id,name){
        $("#id").val(id);
        $("#name").val(name);
    }
</script>