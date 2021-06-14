let tableList = $('#list')
let dataTable = null

if (tableList.length) {
    dataTable = tableList.DataTable({
        language: getDataTableLanguageSetting(),
        processing: true,
        serverSide: true,
        searching: isAdmin,
        deferLoading: totalFirstLoad,
        ajax: basePath + '/files',
        order: [[ 2, "desc" ]], // order by upload time
        columns: [
            { data: 'no', orderable: false },
            { data: 'username', "visible": isAdmin },
            { data: 'uploadTime' },
            { data: 'status' },
            {
                data: 'analyzeError',
                orderable: false,
                "visible": isAdmin,
                className: 'text-info'
            },
            {
                data: 'downloadOriginal',
                orderable: false,
                className: 'text-center',
            },
            {
                data: 'downloadAnalyze',
                orderable: false,
                className: 'text-center',
            },
            {
                data: 'deleteButton',
                orderable: false,
                className: 'text-center',
            },
        ],
        fnInitComplete: function(){
            $(".dataTables_length label").append('<button class="btn btn-sm btn-primary float-sm-right btn-refresh"> <i class="fas fa-sync-alt"></i> ' + getMessage('Refresh') + '</button>');
        }
    })
}

// show analyze error modal
$(document).on('click', '.error-modal', function () {
    let msg = $(this).data('msg')
    Swal.fire({
        icon: 'warning',
        confirmButtonText: getMessage('Close'),
        html: `<div style="text-align: left;"><pre>${ msg }</pre></div>`,
        width: 800,
    })
})

//message edit profile success
$(function () {
    if (message) {
        toastr.success(message);
    }
});

// delete result event
$(document).on('click', '.btn-delete', async function () {
    let id = $(this).attr('data-id')

    let confirmDelete = await Swal.fire({
        title: getMessage('Delete confirm script')  ,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d93535',
        confirmButtonText: getMessage('Delete button'),
        cancelButtonText: getMessage('Close')
    })

    if (confirmDelete.isConfirmed) {
        try {
            let result = await $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: basePath + '/files/' + id,
                type: 'DELETE',
            })

            dataTable.ajax.reload()
            toastr.success(result.message)
        } catch (e) {
            toastr.error(e.responseJSON.message)
        }
    }
})

// refresh table event
$(document).on('click', '.btn-refresh', function () {
    dataTable.ajax.reload()
})
