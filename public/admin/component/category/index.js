$(document).ready(function () {
    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        placeholder: 'menu-highlight',
        items: 'li',
        handle: 'a',
        listType: 'ul',
        toleranceElement: '> a',
        maxLevels: 10,
        isTree: true,
        opacity: .6,
        update: function (e, ui) {
            changePosition(e);
            $(this).children().each(function (index) {
            })
        },
        relocate: function (e) {
        },
    });
})

// upload image lead
var datafile;

let dropArea = document.getElementsByClassName('drop-area')
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        [...dropArea].forEach(e => e.addEventListener(eventName, preventDefaults, false))

    })
let dropAreaProgress = document.getElementsByClassName('drop-area-progress')
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        [...dropAreaProgress].forEach(e => e.addEventListener(eventName, preventDefaults, false))

    })
function preventDefaults(e) {
    e.preventDefault()
    e.stopPropagation()
}

var rangeRender
var nameFile
[...dropArea].forEach(e => e.addEventListener('drop', handleDrop, false))
function handleDrop(e) {
    rangeRender = $(e.currentTarget)
    let dt = e.dataTransfer
    let files = dt.files
    handleFiles(files)

}
function handleFiles(files, el = null) {
    if (el != null)
        rangeRender = $(el).parent()
    previewFile(files[0])

}

function previewFile(file) {
    let reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onloadend = function () {
        let img = document.createElement('img')
        img.src = reader.result
        rangeRender.parent().find('.gallery').html('').append(img)
    }
    this.datafile = file;
    id_lead = rangeRender.parent().find('.gallery').attr('data_ids');
    //ajaxUploadimg(id_lead, this.datafile);
    //dataForm.set(rangeRender.attr('file-name'), file)
}

function createCategory()
 {
    var fd = new FormData();
    if ($("input[name='name']").val() == '') {
        $("[name='name']").addClass('is-invalid').parent().append(`<div class="invalid-feedback">Vui lòng nhập vào tên </div>`)
        return ;
    }
    fd.append("name", $("input[name='name']").val());
    fd.append('category_id', $("select[name='category_id']").val());
    fd.append('description', $("textarea[name='description']").val());
    fd.append('file_data', $('#img-category').prop("files")[0]);
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
           if(data.status) {
               toast(data.message, 'success');
           }else {
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

function updateCategory(id)
{
    if(!id) {
        toast('Có lỗi xảy ra. Vui lòng kiểm tra lại', 'error');
        return
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route_show,
        method: 'get',
        data: {
            id: id,
        },
        success(data) {
            try {
                if (data.status) {
                    $("input[name=name_update]").val(data.data.name)
                    $("input[name=descript_update]").val(data.data.description)
                    $(".id_cat").val(data.data.id)
                    $(".my_image").attr("src", data.data.icon_url);

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

function saveUpdateCat()
{
    var name = $(".name_cat").val()
    if (name == '') {
        toast('Vui lòng nhập vào tên danh mục', 'error');
        return;
    }
    var name = $("input[name=name_update]").val();
    var description = $("input[name=descript_update]").val()
    var id = $(".id_cat").val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route_update,
        method: 'post',
        data: {
            name: name,
            description: description,
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
}

function changePosition(e) {
    serialize = $('.sortable').nestedSortable('toHierarchy');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        method: 'post',
        data: {
            list: serialize,
        },
        success(data) {
            try {
                if (data.status) {
                    $(".input_catname").empty();
                    toast(data.message, 'success');
                    html_option = `<option value="0">---------------- ROOT ----------------</option>`
                    $(".input_catname").prepend(html_option);
                    recursionSelect(data.data)
                    var result = recursionSelect(data.data);
                    $(".input_catname").append(result);
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

function changeActive(id) {
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

function deleteCategory(id)
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
