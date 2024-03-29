let userTable = $('#user-table')
let dataTable = null

//datatable user
if (userTable.length) {
    dataTable  = userTable.DataTable({
        language: getDataTableLanguageSetting(),
        processing: true,
        serverSide: true,
        searching: false,
        deferLoading: totalFirstLoad,
        responsive   : true,
        ajax: getUrl(),
        columns: [
            { data: 'id', className: 'stt', orderable: false },
            { data: 'username' },
            { data: 'full_name' },
            { data: 'phone_number' },
            { data: 'center_name' },
            { data: 'role',orderable: false },
            {
                data: 'action',
                orderable: false,
                className: 'text-center',
            },
        ],
        fnRowCallback: function( nRow, aData, iDisplayIndex ) {
            var pageInfo = $('#user-table').DataTable().page.info();
            var index = pageInfo.start + iDisplayIndex + 1;
            $('td.stt',nRow).html(index);
            return nRow;
        }
    })
}

//show swal delete
var user_id;
$(document).on('click', '.delete', function(){
    user_id = $(this).attr('data-id');
    Swal.fire({
        title: 'dddd',
        text: 'delete',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d93535',
        confirmButtonText: 'Delete button',
        cancelButtonText: 'Close'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "user/delete/"+ user_id,
                type: 'delete',
                contentType:'application/json',
                data: {
                    "id": user_id,
                    '_token': '{{csrf_token()}}'
                },
                success:function(data)
                {
                    // $( ".card" ).load( "user .card > " );
                    // $( ".card-header" ).load( "user .card-header >" );
                    toastr.success(data.message);
                },
                error:function (data) {
                    toastr.error(data.responseJSON.message);
                }
            })

        }
    })
});


$(document).on('click', '.active-user', function(){
    user_id = $(this).attr('data-id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "user/restore/"+ user_id,
        type: 'post',
        contentType:'application/json',
        data: {
            "id": user_id,
            '_token': '{{csrf_token()}}'
        },
        success:function(data)
        {
            dataTable.ajax.reload();
            toastr.success(data.message);
        },
        error:function (data) {
            toastr.error(data.responseJSON.message);
        }
    })
});


$(document).ready(function() {
    $('thead tr td:last-child').append('<button type="button" id="grid_view_search_button" class="btn btn-primary"> Search </button>  <button type="button" id="grid_view_reset_button" class="btn btn-warning"> Reset </button>');
});

$(document).on('click','#grid_view_search_button',function (){
    $('#grid_view_filters_form').submit();
})
$(document).on('click','#grid_view_reset_button',function (){
    $('td input').val('')
})
