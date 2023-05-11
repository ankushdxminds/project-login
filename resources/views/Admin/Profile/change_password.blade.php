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
                       Reset Password
                      </span>
                        </h4>
                        <p class="card-description">
                        </p>
                        <form class="forms-sample" id="addUpdateForm" name="addUpdateForm">
                            @csrf
                            <div class="modal-body">

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.password')</label>
                                        <input type="password"
                                               placeholder="@lang('View.password')"
                                               class="form-control"
                                               name="password" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">@lang('View.password_confirm')</label>
                                        <input type="password"
                                               placeholder="@lang('View.password_confirm')"
                                               class="form-control"
                                               name="password_confirm" >
                                    </div>
                                </div>

                                <input type="hidden" name="id"
                                       value="@if(isset($data->id)) {{ $data->id  }} @else 0 @endif">

                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-primary"
                                        onclick="add_update_details('addUpdateForm','{{ url('admin/profile/update-password') }}')">
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
@stop
