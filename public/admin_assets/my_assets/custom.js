function get_state(country, state)
{
    var country_id = $('#' + country).val();

    $.ajax({
        url: base_url + 'get-state/' + country_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            $('#' + state).empty();
            $('#' + state).append(`<option value="">Select state</option>`);
            for (var i = 0; i < data.response.length; i++)
            {
                var result = data.response[i];

                $('#' + state).append(`<option value="` + result.id + `">` + result.state_name + `</option>`);
            }
            $('#' + state).trigger('chosen:updated');

        }
    });
}

function get_all_cities(var_state_id, var_city_id)
{
    // var status = $('#state option:selected').attr('state-id');
    var state_id = $('#' + var_state_id + ' option:selected').val();

    $.ajax({
        url: base_url + 'get-cities/' + state_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            $('#' + var_city_id).empty();
            $('#' + var_city_id).append(`<option value="">Select city</option>`);
            for (var i = 0; i < data.response.length; i++)
            {
                var result = data.response[i];

                $('#' + var_city_id).append(`<option value="` + result.id + `">` + result.name + `</option>`);
            }

            $('#' + var_city_id).trigger('chosen:updated');
        }
    });

}

function user_get_state(country, state)
{
    var country_id = $('#' + country).val();

    $.ajax({
        url: base_url + 'get-state/' + country_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            $('#' + state).empty();
            $('#' + state).append(`<option value="">Select state</option>`);
            for (var i = 0; i < data.response.length; i++)
            {
                var result = data.response[i];

                $('#' + state).append(`<option value="` + result.id + `">` + result.state_name + `</option>`);
            }

            //  $('#'+state).materialSelect();
        }
    });
}

function user_get_all_cities(var_state_id, var_city_id)
{

    var state_id = $('#' + var_state_id + ' option:selected').val();

    $.ajax({
        url: base_url + 'get-cities/' + state_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            $('#' + var_city_id).empty();
            $('#' + var_city_id).append(`<option value="">Select city</option>`);
            for (var i = 0; i < data.response.length; i++)
            {
                var result = data.response[i];

                $('#' + var_city_id).append(`<option value="` + result.id + `">` + result.name + `</option>`);
            }

            $('#' + var_city_id).materialSelect();

        }
    });

}

function get_child_category(parent_id, child_box_id)
{

    $('#' + child_box_id).empty();
    var parent_id = $('#' + parent_id).val();
    if (parent_id)
    {
        $.ajax({
            url: base_url + 'get-child-category/' + parent_id,
            type: 'GET',
            dataType: 'JSON',
            success: function (data)
            {
                $('#' + child_box_id).empty();
                if (data.length != 0)
                {
                    $('#' + child_box_id + '_div').show();

                    $('#' + child_box_id).append(`<option value="">Select</option>`);
                    for (var i = 0; i < data.length; i++)
                    {
                        var result = data[i];
                        console.log(result.category_name);
                        $('#' + child_box_id).append(`<option value="` + result.id + `">` + result.category_name + `</option>`);
                    }
                    $('#' + child_box_id).trigger('chosen:updated');
                } else
                {
                    $('#' + child_box_id + '_div').hide();
                }

                if (child_box_id == 'first_child_category')
                {
                    $('#second_child_category_div').hide();
                    $('#third_child_category_div').hide();

                }
                if (child_box_id == 'second_child_category')
                {
                    $('#third_child_category_div').hide();

                }


            }
        });
    }
}


function reinitialize_tooltip()
{


    (function ($)
    {
        'use strict';

        $(function ()
        {
            /* Code for attribute data-custom-class for adding custom class to tooltip */
            if (typeof $.fn.tooltip.Constructor === 'undefined')
            {
                throw new Error('Bootstrap Tooltip must be included first!');
            }

            var Tooltip = $.fn.tooltip.Constructor;

            // add customClass option to Bootstrap Tooltip
            $.extend(Tooltip.Default, {
                customClass: ''
            });

            var _show = Tooltip.prototype.show;

            Tooltip.prototype.show = function ()
            {

                // invoke parent method
                _show.apply(this, Array.prototype.slice.apply(arguments));

                if (this.config.customClass)
                {
                    var tip = this.getTipElement();
                    $(tip).addClass(this.config.customClass);
                }

            };
            $('[data-toggle="tooltip"]').tooltip();

        });
    })(jQuery);
}

function reinilize_chosen()
{
    $(".chosen-select").chosen({
        disable_search_threshold: 1,
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });
}

reinilize_chosen();

$(document.body).on('hidden.bs.modal', function ()
{
    $('#my_modal').removeData('bs.modal')
});


function reinilize_user_modal()
{
    $("#my_modal").on("show.bs.modal", function (e)
    {
        $("#my_modal_content").html("");
        var link = $(e.relatedTarget);
        $(this).find("#my_modal_content").load(link.attr("href"));
    });

}

function reinilize_my_modal()
{

    $('.my-modal').on('click', function (e)
    {

        $('.modal').modal('hide');
        e.preventDefault();
        $('#my_modal').modal('show').find('.modal-content').load($(this).attr('href'));
    });

}


function reinilize_large_my_modal()
{

    $('.large-my-modal').on('click', function (e)
    {

        $('.modal').modal('hide');
        e.preventDefault();
        $('#large_my_modal').modal('show').find('.modal-content').load($(this).attr('href'));
    });

}

reinilize_my_modal();
reinilize_large_my_modal();

function add_update_wishlist(product_id, box_id)
{
    $.ajax({
        url: base_url + 'add-remove-wishlist/' + product_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            if (data.response == 1)
            {
                $('#' + box_id).html(' <i class="fa fa-heart"></i>');
            } else
            {
                $('#' + box_id).html(' <i class="far fa-heart"></i>');
            }
        }
    });
}

function add_to_cart(product_id)
{
    /*var product_size = $('#product_size').val();
    var product_color = $('#product_color').val();*/

    var data = $('#variation_form').serialize();


    $.ajax({
        url: base_url + 'add-to-cart-api',
        type: 'POST',
        dataType: 'JSON',
        data:data,
        success: function (data)
        {
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
                url = data.url;
                success_message(data.msg, 2, url);
            }
        }
    });

}

function deals_add_to_cart(deals_id)
{
   /* var product_size = $('#product_size').val();
    var product_color = $('#product_color').val();*/
    var deals_data = $('#variation_form').serialize();

    $.ajax({
        url: base_url + 'deals-add-to-cart-api',
        type: 'POST',
        dataType: 'JSON',
        data: deals_data,
        success: function (data)
        {
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
                url = data.url;
                success_message(data.msg, 2, url);
            }
        }
    });
}


function buy_now(product_id)
{
  /*  var product_size = $('#product_size').val();
    var product_color = $('#product_color').val();*/
    var data = $('#variation_form').serialize();
    $.ajax({
        url: base_url + 'add-to-cart-api',
        type: 'POST',
        dataType: 'JSON',
        data:data,
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 200)
            {
                url = base_url + 'checkout';
                success_message(data.msg, 2, url);
            }
            if (data.status == 201)
            {
                url = base_url + 'checkout';
                success_message(data.msg, 2, url);
            }
        }
    });
}

function re_order(url)
{
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 201)
            {
                url = data.url;
                success_message('Success', 2, url);
            }
        }
    });
}

function switch_to_profile(roles_key)
{
    $.ajax({
        url: base_url + 'user-switch-to-profile',
        type: 'POST',
        dataType: 'JSON',
        data: {
            _token: $("input[name=_token]").val(),
            roles_key: roles_key
        },
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 201)
            {
                url = data.url;
                success_message(data.msg, 2, url);
            }
        }
    });
}

function login_for_bid(error_msg)
{
    error_message(error_msg);
}

function get_available_stock(product_id,category_id,deals_percentage = 0)
{
    var arr = [];
    $('.product_variation_select_class').each(function() {
        if($(this).val())
            arr.push($(this).val());
    });

    $.ajax({
        url: base_url + 'get-product-stock-quantity',
        type: 'POST',
        dataType: 'JSON',
        data:{
            _token: $("input[name=_token]").val(),
            variation_arr:arr,
            product_id:product_id,
            category_id:category_id,
            deals_percentage:deals_percentage
        },
        success: function (data)
        {
            if (data.status == 400)
            {
                error_message(data.msg);
            }
            if (data.status == 200)
            {

                if(data.response)
                {
                    if(deals_percentage != 0)
                    {
                        if (data.response.discount_price)
                        {
                            $('#variation_price_box').html(`<span class=" font-weight-bold">
                                        <strong>
                                           $`+data.response.discount_price+`
                                        </strong>
                                    </span>
                                    <span class="grey-text ml-1">
                                        <small>
                                            <s>
                                               $`+data.response.price+`
                                            </s>
                                            `+deals_percentage+`% off
                                        </small>

                                    </span>`);
                        }
                    }
                    else
                    {
                        if (data.response.price)
                        {
                            $('#variation_price_box').text('$' + data.response.price);
                        }
                    }

                    if (data.response.quantity)
                    {
                        $('#available_stock_quantity').text('$' + data.response.quantity);
                    }
                    else if (data.response.quantity == 0)
                    {
                        $('#available_stock_quantity').text('$' + data.response.quantity);
                    }
                }
            }
        }
    });
}

function get_promote_product_percentage(box_id)
{
      /*var third_child_category = $('#third_child_category option:selected').val();
     var second_child_category = $('#second_child_category option:selected').val();
     var first_child_category_div = $('#first_child_category_div option:selected').val();
     var parent_category = $('#parent_category option:selected').val();

      var brand_id = $('#brand_id option:selected').val();


     var category_id = 0;
     if (third_child_category > 0)
     category_id = third_child_category;
     else if (second_child_category > 0)
     category_id = second_child_category;
     else if (first_child_category_div > 0)
     category_id = first_child_category_div;
     else if (parent_category > 0)
     category_id = parent_category;*/

      var category_id = $('#last_child_category_id').val();
      var item_condition = $('#condition').val();
      var price = $('#selling_price').val();

     $.ajax({
     url: base_url + 'get-promote-product-percentage/'+ price  +'/'+ category_id  + '/' + item_condition ,
     type: 'GET',
     dataType: 'JSON',
     success: function (data) {
     if (data.status == 400) {
     error_message(data.msg);
     }
     if (data.status == 200) {
     $('#'+box_id).text('Current promotion trend : '+data.response+'%');
     }
     }
     });

}

function check_promote_percentage_box(promote_percentage_status, promote_percentage_input_box)
{

    var check = $('#' + promote_percentage_status).is(":checked");
    console.log(check);
    if (check)
    {
        $('#' + promote_percentage_input_box).show();
    } else
    {
        $('#' + promote_percentage_input_box).hide();
    }
}

function update_promotion_reference_data(url, reference_id,seller_id = 0)
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


        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: {
                _token: $("input[name=_token]").val(),
                arr: arr,
                reference_data: $('#' + reference_id).val(),
                seller_id:seller_id

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
}

function get_category_form(category, category_form_id)
{
    var category_id = $('#' + category).val();
    $.ajax({
        url: base_url + 'search/get-category-form/' + category_id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data)
        {
            $('#' + category_form_id).html(data.response);
            if (data.condition_response)
            {
                $('#condition').empty();
                if (data.condition_response.length != 0)
                {
                    $('#condition').append(`<option data-description-status="0" value="">Select condition</option>`);
                    for (var i = 0; i < data.condition_response.length; i++)
                    {
                        var result = data.condition_response[i];
                        $('#condition').append(`
                            <option data-description-status="` + result.description_status + `"  data-condition-remark="` + result.remark + `" value="` + result.id + `">` + result.condition + `</option>
                        `);
                    }
                }

                if (data.category_brand_data)
                {
                    $('#brand_id').empty();
                    for (var i = 0; i <data.category_brand_data.length ; i++)
                    {
                        var result = data.category_brand_data[i];
                        $('#brand_id').append(`
                            <option value="` + result.brand_name + `">
                        `);
                    }
                }

                if (data.category_model_data)
                {
                    $('#model_id').empty();
                    for (var i = 0; i <data.category_model_data.length ; i++)
                    {
                        var result = data.category_model_data[i];
                        $('#model_id').append(`
                            <option value="` + result.model_name + `">
                        `);
                    }
                }
            }
        }
    });
}

function get_variation_option(var_attribute_id, var_option_id)
{
    var attribute_id = $('#' + var_attribute_id + ' option:selected').val();
    if (attribute_id)
    {
        $.ajax({
            url: base_url + 'search/get-variation-option/' + attribute_id,
            type: 'GET',
            dataType: 'JSON',
            success: function (data)
            {
                $('#' + var_option_id).html('<option disabled value="">Select option</option>');
                if (data.response.length != 0)
                {

                    for (var i = 0; i < data.response.length; i++)
                    {
                        var result = data.response[i];
                        $('#' + var_option_id).append('<option value="' + result.id + '">' + result.option + '</option>');
                    }

                }
                $('#' + var_option_id).trigger('chosen:updated');
            }
        });
    } else
    {
        $('#' + var_option_id).html('<option disabled value="">Select option</option>');
        $('#' + var_option_id).trigger('chosen:updated');
    }

}

function create_new_product(search_text)
{

    $.ajax({
        url: base_url + 'add-update/create-draft-product?search_text=' + search_text,
        type: 'GET',
        dataType: 'JSON',
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
            if(data.status == 201)
            {
                window.location.href = data.url;
            }
        }
    });
}

function check_condition_description()
{
    var value = $('#condition option:selected').attr('data-description-status');
    if (value == 1)
    {
        $('#condition_description_box').show();
    } else
    {
        $('#condition_description_box').hide();
    }

    var remark = $('#condition option:selected').attr('data-condition-remark');
    if (remark)
    {
        $('#condition_remark_text').text(remark);
    } else
    {
        $('#condition_remark_text').text('');
    }
}

function check_duration_status()
{
    var value = $('#duration_status option:selected').val();
    if (value == 1)
    {
        $('#duration_status_box').show();
    } else
    {
        $('#duration_status_box').hide();
    }
}

function check_free_shipping_status(status_id, fees_id)
{
    var value = $('#' + status_id).is(':checked');
    if (value)
    {
        $('#' + fees_id).val('0.00');
        $('#' + fees_id).prop("disabled", true);
    } else
    {
        $('#' + fees_id).prop("disabled", false);
    }
}


function check_domestic_shipping_box(shipping_id, box_id)
{
    var value = $('#' + shipping_id + ' option:selected').val();
    if (value == 'NOT_SPECIFIED')
    {
        $('#' + box_id).hide();
    } else
    {
        $('#' + box_id).show();
    }

}

function check_international_shipping_option(select_id)
{
    var value = $('#' + select_id + ' option:selected').val();
    if (value == 2)
    {
        $('#custom_country_box').show();
    } else
    {
        $('#custom_country_box').hide();
    }
}

function check_international_shipping(select_id)
{
    var value = $('#' + select_id + ' option:selected').val();
    if (value == 'NOT_SPECIFIED')
    {
        $('#international_shipping_box').hide();
    } else
    {
        $('#international_shipping_box').show();
    }
}

function check_another_shipping_country(select_id)
{
    var value = $('#' + select_id + ' option:selected').val();
    if (value == 1)
    {
        $('#another_shipping_country_box').show();
    } else
    {
        $('#another_shipping_country_box').hide();
    }
}

function check_estimate_weight(select_id)
{
    var value = $('#' + select_id + ' option:selected').val();
    if (value == 'ONE_LB_OR_LESS')
    {
        $('#major_unit_weight_box').hide();
        $('#minor_unit_weight_box').show();
    } else if (value == 'CUSTOM_WEIGHT')
    {
        $('#major_unit_weight_box').show();
        $('#minor_unit_weight_box').show();
    } else
    {
        $('#major_unit_weight_box').hide();
        $('#minor_unit_weight_box').hide();
    }
}

function check_return_status(return_status, return_box)
{
    var value = $('#' + return_status).is(':checked');
    if (value)
    {
        $('#' + return_box).show();
    } else
    {
        $('#' + return_box).hide();
    }
}


function like_dislike_product_review(review_id, status,url)
{
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        data: {
            _token: $("input[name=_token]").val(),
            review_id: review_id,
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
                $('#review_like_'+review_id).text('('+data.like_count+')');
                $('#review_dis_like_'+review_id).text('('+data.dis_like_count+')');
            }
        }
    });
}



