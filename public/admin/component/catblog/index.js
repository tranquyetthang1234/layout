$(document).ready(function(){
});


function changeActive(id)
{
    if (!id) {
        toast('Có lỗi xảy ra. Vui lòng kiểm tra lại', 'error');
        return
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route_active,
        method: 'post',
        data: {
            id: id,
        },
        success(data) {
            try {
                if (data.status) {
                    toast(data.message, 'success');
                } else {
                    if (data.message) {
                        toast(data.message, 'error');
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },
        error() {
            toast('Vui lòng liên hệ Admin!', 'error')
        }
    })
}

function storeBlog()
{

    var fd = new FormData();
    if ($("input[name='name']").val() == '') {
        $("[name='name']").addClass('is-invalid').parent().append(`<div class="invalid-feedback">Vui lòng nhập vào tên </div>`)
        return;
    }
    fd.append("name", $("input[name='name']").val());
    //fd.append('category_id', $("select[name='category_id']").val());
    fd.append('description', $("textarea[name='description']").val());

    //fd.append('file_data', $('#img-category').prop("files")[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        crossOrigin: false,
        contentType: false,
        url: route_create,
        method: 'post',
        data: fd,
        success(data) {
            if (data.status) {
                toast(data.message, 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                toast(data.message, 'error');
            }
        },
        error(reject) {
            if (reject.status === 422) {
                errors = JSON.parse(reject.responseText)
                $.each(errors.errors, function (key, val) {
                    toast(val[0], 'error');
                    $("#" + key + "_error").text(val[0]);
                });
            }
        }
    })
}

function deleteBlog(id)
{
    swal({
        title: 'Bạn có chắc thực hiện thao tác này?',
        text: "Bạn sẽ không thể hoàn nguyên điều này!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: 'Không',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route_destroy,
                method: 'post',
                data: {
                    id: id,
                },
                success(data) {
                    try {
                        if (data.status) {
                            toast(data.message, 'success');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            if (data.message) {
                                toast(data.message, 'error');
                            }
                        }
                    } catch (error) {
                        console.log(error)
                    }
                },
                error() {
                    toast('Vui lòng liên hệ Admin!', 'error')
                }
            })
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
                'Đã hủy',
                'Thao tác này đã hủy',
                'error'
            )
        }
    })
}
function toast(msg, type) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    switch (type) {
        case 'error':
            toastr.error(msg);
            break;
        case 'success':
            toastr.success(msg);
        default:
            break;
    }
}
