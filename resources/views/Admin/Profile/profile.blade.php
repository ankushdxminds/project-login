@extends('Admin.layouts.master')
@section('title')
    @if(isset($page_title) && !empty($page_title))
        {{ $page_title }}
    @else
        @lang('View.default_title_ebay')
    @endif
@stop
@section('style')
@stop
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                      <span >
                       User details
                      </span>
                        </h4>
                        <p class="card-description">
                        </p>
                        <form class="forms-sample" id="addUpdateForm" name="addUpdateForm">
                            @csrf
                            <div class="modal-body">

                                <div class="row form-group">

                                    <div class="col-md-6">
                                        <label for="status">@lang('View.username')</label>
                                        <input onkeyup="check_username(<?php if(isset($data->id) && !empty($data->id)){ echo $data->id; } ?>,this.value)"
                                               type="text"
                                               placeholder="@lang('View.username')"
                                               class="form-control"
                                               name="username"
                                               value="@if(isset($data->username)){{ $data->username }}@endif">
                                        <span id="username_alert" style="color: red;"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.first_name')</label>
                                        <input type="text"
                                               placeholder="@lang('View.first_name_placeholder')"
                                               class="form-control"
                                               name="first_name"
                                               value="@if(isset($data->first_name)) {{ $data->first_name }} @endif">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.last_name')</label>
                                        <input type="text"
                                               placeholder="@lang('View.last_name_placeholder')"
                                               class="form-control"
                                               name="last_name"
                                               value="@if(isset($data->last_name)){{ $data->last_name }} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.email')</label>
                                        <input type="text"
                                               placeholder="@lang('View.email_placeholder')"
                                               class="form-control"
                                               name="email"
                                               data-inputmask="'alias': 'email'"
                                               value="@if(isset($data->email)){{ $data->email }}@endif">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.phone_number')</label>
                                        <input type="text"
                                               placeholder="@lang('View.phone_number_placeholder')"
                                               class="form-control"
                                               name="phone_number"
                                               onkeypress="return isNumberKey(event)"
                                               value="@if(isset($data->phone_number)){{$data->phone_number}}@endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label>@lang('View.dob')</label>
                                        <div id="datepicker-popup" class="input-group date datepicker">
                                            <input type="text"
                                                   name="dob"
                                                   placeholder="@lang('View.dob_placeholder')"
                                                   @if(isset($data->dob) && !empty($data->dob))
                                                   value="{{$data->dob}}"
                                                   @endif
                                                   class="form-control">
                                            <span class="input-group-addon input-group-append border-left">
                                          <span class="mdi mdi-calendar input-group-text"></span>
                                        </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class=" row">
                                            <label class="col-sm-3 col-form-label">@lang('View.gender')</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio"
                                                               class="form-check-input"
                                                               value="Male"
                                                               name="gender"
                                                               id="membershipRadios1"
                                                               @if(isset($data->gender))
                                                               @if($data->gender == 'Male')
                                                               checked="checked"
                                                               @endif
                                                               @else
                                                               checked="checked"
                                                                @endif
                                                        >
                                                        Male
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio"
                                                               class="form-check-input"
                                                               @if(isset($data->gender))
                                                               @if($data->gender == 'Female')
                                                               checked="checked"
                                                               @endif
                                                               @endif
                                                               value="Female"
                                                               name="gender"
                                                               id="membershipRadios2">
                                                        Female
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.address')</label>
                                        <input type="text"
                                               placeholder="@lang('View.address_placeholder')"
                                               class="form-control"
                                               name="address"
                                               value="@if(isset($data->address)){{ $data->address }} @endif">
                                    </div>

                                </div>
                              
                                <div class="form-group row">
                                    
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.zip_code')</label>
                                        <input type="text"
                                               placeholder="@lang('View.zip_code_placeholder')"
                                               class="form-control"
                                               name="zipcode"
                                               value="@if(isset($data->zipcode)){{ $data->zipcode }} @endif">
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="avatar_preview">@lang('View.avatar')</label>
                                    <div class="form-control-range">


                                    <img width="110px"
                                         class="img-responsive"
                                         id="avatar_preview"
                                         height="110px"
                                         src="@if(isset($data->avatar) && !empty($data->avatar)) {{ config('constants.avatar_url').$data->avatar  }} @else {{ config('constants.default_img_url') }} @endif">
                                    <div class="col-md-12 upload-box">
                                        <button class="btn btn-primary upload-btn"
                                                type="button">
                                            <i class="fa fa-upload"></i>&nbsp;&nbsp;
                                            <span class="bold">@lang('View.upload')</span>
                                        </button>
                                        <input type="file"
                                               id="avatar_file"
                                               onchange="upload_image('avatar_file','{{ url('/upload/avatar') }}','avatar_preview','user_','avatar')"
                                               class="upload-file"
                                        >
                                    </div>
                                    </div>
                                    <input type="hidden"
                                           value="@if(isset($data->avatar)){{ $data->avatar  }} @endif"
                                           name="avatar" id="avatar">
                                </div>
                                <input type="hidden" name="id"
                                       value="@if(isset($data->id)) {{ $data->id  }} @else 0 @endif">

                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-primary"
                                        onclick="add_update_details('addUpdateForm','{{ url('admin/profile/update-profile-api') }}')">
                                    @lang('View.save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

    <script>
        function check_username(user_id , username)
        {
            $.ajax({
                url: base_url + 'admin/user/get-username/'+ user_id + '/'+username,
                type: 'GET',
                dataType: 'JSON',
                success: function (data)
                {
                    if(data==true)
                    {
                        $('#username_alert').empty();
                        $('#username_alert').text('Username Already Exist')
                    }else{
                        $('#username_alert').empty();
                    }

                }
            });

        }
    </script>
@stop
