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
    @csrf
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <span custom class="{{ create_custom_class('page title') }}">
                            User details
                        </span>
                        </h4>
                        <p class="card-description">
                            {{-- Add class <code>.table-striped</code>--}}
                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-primary mr-2 btn-sm"
                                   href="javascript:void(0)"
                                   onclick="status_update_all(1,'{{ url('/admin/add-update/update-user-status') }}')">
                                    @lang('View.active')
                                    <i class="mdi mdi-check menu-icon"></i>
                                </a>

                                <a class="btn btn-primary mr-2 btn-sm"
                                   href="javascript:void(0)"

                                   onclick="status_update_all(0,'{{ url('/admin/add-update/update-user-status') }}')">
                                    @lang('View.inactive')
                                    <i class="mdi mdi-block-helper menu-icon"></i>
                                </a>

                                <a class="btn btn-primary mr-2 btn-sm"
                                   href="javascript:void(0)"
                                   onclick="status_update_all(1,'{{ url('/admin/add-update/verified-user-status') }}')">
                                    @lang('View.verified')
                                    <i class="mdi mdi-check menu-icon"></i>
                                </a>

                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text"
                                           id="search_item"
                                           name="search_item"
                                           placeholder="@lang('View.search_placeholder')"
                                           onkeyup="search_by_key(1)"
                                           class="form-control">
                                </div>

                            </div>
                            <div class="table-responsive">
                                <div id="search_list_box">

                                </div>
                            </div>

                        </div>
                        <div class="mt-4" id="pagination_div">
                            <nav aria-label="Page navigation">
                                <ul class="pagination d-flex justify-content-end" id="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

    <script>

        $(document).ready(function ()
        {
            search_by_key();
        });

        function search_by_key()
        {
            var url = '{{ url('/admin/user/search-api') }}';
            var dataObj = {};
            dataObj._token = $("input[name=_token]").val();
            dataObj.item = $('#search_item').val();
            search(url, dataObj, 1, 'search_list_box');
        }
    </script>

@stop
