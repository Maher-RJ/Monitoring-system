<table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>mac</th>
        <th>status</th>
        <th>join</th>
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
                { "data": "mac","name":"mac" },
                { "data": "status","name":"status" },
                { "data": "created_at","name":"created_at" },
                {"mRender": function ( data, type, row ) {
                        return '<button class="btn btn-info"  onclick="edit(\''+row.id+'\',\''+row.name+'\',\''+row.status+'\')">Edit</button >';}
                }
            ]
        });
    } );
    function edit(id,name,status){
        $("#id").val(id);
        $("#name").val(name);
        if(status=='Active'){
            $("#status").prop( "checked", true );
        }else{
            $("#status").prop( "checked", false );
        }
        $('#name').attr("disabled", false);
        $('#status').attr("disabled", false);
        $('#submit').attr("disabled", false);
    }
</script>