
let btnAdd = $('#btnAdd')
let btnSubmit = $('#btnSubmit')
let inputFile = $('#inputFile')

// display prompt if user tries to navigate away/reload page when uploading file
function beforeUnloadListener(event) {
    event.preventDefault()
    return event.returnValue = '';
}

// display file browser
btnAdd.on('click', function() {
    let listFile = $('.list-file')
    inputFile.val('')

    if (listFile.find('.itemContainer').length !== 0) {
        listFile.find('.itemContainer').remove()
        btnSubmit.prop('disabled', true)
    }

    inputFile.click()
})

// add item to list file
inputFile.on('change', function() {
    if (!this.files.length) {
        return
    }

    btnSubmit.prop('disabled', false)

    let listFile = $('.list-file')
    let fileName = this.files[0].name

    listFile.html('')
    listFile.append(`
                <div class="itemContainer">
                    <p><i class="fas fa-file-archive fa-2x file-icon"></i>${ fileName }</p>
                    <button type="button" class="btn btn-danger btnRmFile">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            `)
})

// handle delete file in input type file
$(document).on('click', '.btnRmFile', function() {
    clearInput()
})

// handle submit to server
btnSubmit.on('click', async function() {
    let progressBar = $('.progress')
    let barValue = $('#bar-value')
    $('.btnRmFile').prop('disabled', true)
    btnAdd.prop('disabled',true)
    $(this).prop('disabled', true)
    barValue.css({ width: '0%' })
    progressBar.removeClass('d-none')
    addEventListener('beforeunload', beforeUnloadListener, { capture: true })

    try {
        let formData = new FormData($('#mainForm')[0])
        await $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhr: function() {
                // update percentage bar
                let xhr = new window.XMLHttpRequest()
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        barValue.css({ width: `${ Math.round(e.loaded * 90 / e.total) }%` })
                    }
                }, false)
                return xhr
            },
            url: basePath + '/analyze',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
        })

        clearInput()
        barValue.css({ width: '100%' })

        setTimeout(() => {
            progressBar.addClass('d-none')
            Swal.fire({
                icon: 'success',
                text: getMessage('Upload File success'),
                timer: 1500,
            })
        }, 300)
    } catch(err) {
        barValue.css({ width: '100%' })
        setTimeout(() => {
            switch (err.status) {
                case 500:
                    Swal.fire({
                        icon: 'error',
                        text: err.responseJSON.message,
                    })
                    break

                case 422:
                    let errors = err.responseJSON.errors
                    Swal.fire({
                        icon: 'error',
                        text: errors[Object.keys(errors)[0]][0],
                    })
                    break

                default:
                    Swal.fire({
                        icon: 'error',
                        text: getMessage('Server error'),
                    })
            }
            clearInput()
            progressBar.addClass('d-none')
        }, 300)
    }

    removeEventListener('beforeunload', beforeUnloadListener, { capture: true })
})

// clear input file and list file
function clearInput() {
    inputFile.val('')
    $('.list-file').html('')
    btnAdd.prop('disabled', false)
    btnSubmit.prop('disabled', true)
}
