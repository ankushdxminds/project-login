
$('.common-modal').on('click', function (e)
{
    $('.modal').modal('hide');
    e.preventDefault();
    $('#commonModalId').modal('show').find('.modal-content').load($(this).attr('href'));
});

function reinilize_common_modal()
{
    $('.common-modal').on('click', function (e)
    {
        $('.modal').modal('hide');
        e.preventDefault();
        $('#commonModalId').modal('show').find('.modal-content').load($(this).attr('href'));
    });

}

function error_message(msg, status = 0, url = 0)
{

    iziToast.error({
        title: 'Error',
        message: msg,
        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        onOpening: function ()
        {

        },
        onOpened: function ()
        {
            if (status == 1)
            {
                window.location.href = url;
            }
        },
        onClosing: function ()
        {
            //  window.location.reload();
        },
        onClosed: function ()
        {
            // window.location.reload();
        }
    });


}

function success_message(msg, status, url = "")
{

    iziToast.success({
        title: 'Success',
        message: msg,
        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        onOpening: function ()
        {

        },
        onOpened: function ()
        {
            if (status == 1)
            {

                window.location.reload();
            } else
            {
                window.location.href = url;
            }
        },
        onClosing: function ()
        {
            //  window.location.reload();
        },
        onClosed: function ()
        {
            // window.location.reload();
        }
    });

}


function without_refresh_success_message(msg)
{

    iziToast.success({
        title: 'Success',
        message: msg,
        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        onOpening: function ()
        {

        },
        onOpened: function ()
        {

        },
        onClosing: function ()
        {
            //  window.location.reload();
        },
        onClosed: function ()
        {
            // window.location.reload();
        }
    });

}


function add_update_details(form_id, url)
{
    var data = $('#' + form_id).serialize();
   // show_loader();
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success: function (data)
        {
            //hide_loader();
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 401)
            {
                error_message(data.msg, 1, data.url);
            }
            if (data.status == 200)
            {
                if (form_id == 'login_form')
                {
                    window.location.reload();
                } else
                {
                    success_message(data.msg, 1);
                }

            }
            if (data.status == 201)
            {
                var r_url = data.url;
                success_message(data.msg, 2,r_url);
            }
        }
    });
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
    {
        return false;
    }
    return true;
}


function upload_image(id, url, preview_id, name = "img", input_field = "")
{
    var image = document.getElementById(id);
    var fd = new FormData();
    fd.append('avatar', image.files[0]);
    fd.append('_token', $("input[name=_token]").val());
    fd.append('img_name', name);
    $.ajax({
        url: url,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        data: fd,
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 200)
            {
                if (input_field != "")
                {
                    $('#' + input_field).val(data.response);
                }

                varAvatar = data.response;
                $("#" + preview_id).attr("src", data.full_url);
            }
        }
    });
}



function upload_document(id, url, preview_id, name = "img", input_field = "")
{
    var image = document.getElementById(id);
    var fd = new FormData();
    fd.append('document', image.files[0]);
    fd.append('_token', $("input[name=_token]").val());
    fd.append('img_name', name);
    $.ajax({
        url: url,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        data: fd,
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 200)
            {
                if (input_field != "")
                {
                    $('#' + input_field).val(data.response);
                }
                var full_url = data.full_url;
                $("#" + preview_id).html(`
                <a download="download" href="`+full_url+`">`+data.response+`</a>
                <i class="fa fa-trash" style="color: red" onclick="delete_document('`+preview_id+`')"></i>
                `);
            }
        }
    });
}

function delete_document(id)
{
    $('#'+id).empty();
}


function search(url, searchData, page, search_box)
{
   var  var_page_limit = 10;
    var offset = '';
    page = page - 1;
    if (page == 0)
    {
        offset = 0;
    } else
    {
        offset = page * var_page_limit;
    }
    searchData.offset = offset;
    searchData.limit = var_page_limit;
    searchData.total_status = 1;

    $.ajax(
        {
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: searchData,
            success: function (data)
            {
                var total;
                total = Math.ceil(data.total / var_page_limit);
                $('#pagination').pagination(
                    {
                        items: total,
                        itemOnPage: var_page_limit,
                        currentPage: 1,
                        cssStyle: '',
                        prevText: '<span aria-hidden="true">&laquo;</span>',
                        nextText: '<span aria-hidden="true">&raquo;</span>',
                        onInit: function ()
                        {
                            search_all(url, searchData, 1, search_box);
                        },
                        onPageClick: function (page, evt)
                        {
                            search_all(url, searchData, page, search_box);
                        }
                    });

                if (data.total <= var_page_limit)
                {
                    $('#pagination_div').hide();
                    $('#pagination').hide();
                } else
                {
                    $('#pagination_div').show();
                    $('#pagination').show();
                }

            }
        });
}

function search_all(url, searchData, page, search_box)
{
    var  var_page_limit = 10;
    var offset = '';
    page = page - 1;
    if (page == 0)
    {
        offset = 0;
    } else
    {
        offset = page * var_page_limit;
    }
    searchData.offset = offset;
    searchData.limit = var_page_limit;
    searchData.total_status = 0;
    $.ajax(
        {
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: searchData,
            success: function (data)
            {
                $('#' + search_box).empty();
                $('#' + search_box).html(data.html);
            }
        });
}

function delete_data(url)
{
    var arr = [];
    $("input:checkbox[name=action]:checked").each(function ()
    {
        arr.push($(this).val());
    });

    if (arr == "")
    {
        error_message('Please select at least one record');
    } else
    {

        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            message: 'Are You Sure to perform this action?',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function (instance, toast)
                {

                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: $("input[name=_token]").val(),
                            arr: arr
                        },
                        success: function (data)
                        {
                            if (data.status == 400)
                            {
                                error_message(data.msg);
                            }
                            if (data.status == 200)
                            {
                                success_message(data.msg, 1);
                            }
                        }
                    });

                }, true],
                ['<button>NO</button>', function (instance, toast)
                {

                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                }],
            ],

        });
    }



}

function delete_single_data(url,id)
{

    iziToast.question({
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Hey',
        message: 'Are You Sure to perform this action?',
        position: 'center',
        buttons: [
            ['<button><b>YES</b></button>', function (instance, toast)
            {

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id:id,
                        _token: $('input[name=_token]').val(),
                    },
                    success: function (data)
                    {
                        if (data.status == 400)
                        {
                            error_message(data.msg);
                        }
                        if (data.status == 200)
                        {
                            success_message(data.msg, 1);
                        }
                    }
                });

            }, true],
            ['<button>NO</button>', function (instance, toast)
            {

                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

            }],
        ],

    });



}


function check_action()
{
    var check = $("input:checkbox[name=all_action]:checked").val();
    if (check)
    {
        $(".action").prop("checked", true);
    } else
    {
        $(".action").prop("checked", false);
    }

}


function status_update_all(status, url)
{
    var arr = [];
    $("input:checkbox[name=action]:checked").each(function ()
    {
        arr.push($(this).val());
    });

    if (arr == "")
    {
        error_message('Please select at least one record');
    } else
    {

        var title = 'Are you sure you want to preform this action?';
      /*  if (status == 1)
        {
            title = 'Are you sure you want to active record?';
        }*/

        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            message: title,
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function (instance, toast)
                {

                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: $("input[name=_token]").val(),
                            arr: arr,
                            status: status
                        },
                        success: function (data)
                        {
                            if (data.status == 400)
                            {
                                error_message(data.msg);
                            }
                            if (data.status == 200)
                            {
                                success_message(data.msg, 1);
                            }
                        }
                    });

                }, true],
                ['<button>NO</button>', function (instance, toast)
                {

                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                }],
            ],

        });
    }
}


function single_status_update(id, url,status = 0)
{
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        data: {
            _token: $("input[name=_token]").val(),
            id: id,
            status : status
        },
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 200)
            {
                success_message(data.msg, 1);
            }
        }
    });

}
function copyText(element)
{
    var range, selection, worked;

    if (document.body.createTextRange)
    {
        range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection)
    {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    try
    {
        document.execCommand('copy');
        without_refresh_success_message('text copied!');
    } catch (err)
    {
        error_message('unable to copy text');
    }
}

function update_product_single_details(productData, url)
{

    // show_loader();
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        data: productData,
        success: function (data)
        {
            console.log(data);
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 401)
            {
                error_message(data.msg, 1, data.url);
            }
            if (data.status == 200)
            {
                success_message(data.msg, 1);
            }
            if (data.status == 201)
            {
                var r_url = data.url;
                success_message(data.msg, 2,r_url);
            }
        }
    });
}

function read_notification_update(id,url)
{
    console.log(id);
    $.ajax({
            url: base_url+'add-update/read-notification-status/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function (data)
            {
                if(url)
                {
                    window.location.href = url;
                }
                else
                {
                    window.location.reload();
                }
            }
        });

}




