var dTable = $('.dt-responsive').dataTable({
    processing: true,
    serverSide: true,
    searching: true,
    ajax: {
        url: ajax_datatable,
        type: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: function (d) {
        }
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'role', name: 'role'},
        {data: 'image', name: 'image'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action'},
    ],
    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
        var oSettings = dTable.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
        return nRow;
    },
});

$(document).on("click", ".customSwitch1", function (e) {
    var status = $(this).attr('data');
    var id =  $(this).attr('id');
    $.ajax({
        type: "GET",
        url: ajax_status_change,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            status:status,
            id: id,
        },
        success: function (data, textStatus, xhr) {
            dTable.fnDraw();
        }
        , error: function (error) {
            console.log(error);
        }
    });
});

$(document).on("click", ".deleteuser", function (e) {
    var urlda = $(this).attr('data-href');
    swal({
        text: "Are you sure you want to delete User?",
        type: 'info',
        showCancelButton: true,
        confirmButtonClass: 'blue_button alert_btn mr-40',
        cancelButtonClass: 'blue_border_button alert_btn',
        confirmButtonText: 'Yes'
    }).then(function (isConfirm) {  
        if (isConfirm.value == true) {          
            $.ajax({
                type: "GET",
                url: urlda,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data, textStatus, xhr) {
                    dTable.fnDraw();
                }
                , error: function (error) {
                    console.log(error);
                }
            });
        }
    }); 
});