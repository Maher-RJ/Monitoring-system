<table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Area Id</th>
        <th>Stage Id</th>
        <th>Area Name</th>
        <th>Stage Name</th>
        <th>coefficient Value</th>
        <th>Duration</th>
        <th>Inserted date</th>
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
                { "data": "areaId","name":"areaId" },
                { "data": "stageId","name":"stageId" },
                { "data": "area","name":"area" },
                { "data": "stage","name":"stage" },
                { "data": "value","name":"value" },
                { "data": "duration","name":"duration" },
                { "data": "created_at","name":"created_at" },
                {"mRender": function ( data, type, row ) {
                        return '<button class="btn btn-info"  onclick="edit(\''+row.id+'\','+row.areaId+','+row.stageId+',\''+row.value+'\',\''+row.duration+'\')">Edit</button >';}
                }
            ],
            "columnDefs": [{
                "visible":false,
                "targets": 1,
            },{
                "visible":false,
                "targets": 2,
            }],
        });
    } );

    function edit(id,area,stage,value,duration){
        $("#area").prop("disabled", false);
        $("#stage").prop("disabled", false);
        $("#id").val(id);
        $("#value").val(value);
        $("#duration").val(duration);

        $('#area option:selected').attr("selected",false);

        $('#stage option:selected').attr("selected",false);

        $("#area").find('option[value="'+area+'"]').attr("selected",true);
        $("#stage").find('option[value="'+stage+'"]').attr("selected",true);
        $("#area").prop("disabled", true);
        $("#stage").prop("disabled", true);
    }
    $( "#form" ).submit(function( event ) {
        $("#area").prop("disabled", false);
        $("#stage").prop("disabled", false);
    });
    $( "#form" ).reset(function( event ) {
        $("#area").prop("disabled", true);
        $("#stage").prop("disabled", true);
    });
</script>