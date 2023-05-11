@extends('Admin.layouts.master')

@section('title')

   @if(isset($page_title) && !empty($page_title))

    {{ $page_title }}

    @else

    @lang('View.default_title_ebay')

    @endif

@stop

@section('style')

<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

@stop

@section('content')



    <div class="content-wrapper">

        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Dashboard</h4>

                    </div>

                </div>

            </div>



            <div class="col-lg-12 grid-margin d-flex flex-column">

                <div class="row">

                   

                    <div class="col-md-2 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body text-center">

                                <div class="text-danger mb-4">

                                    <i class="mdi mdi-chart-pie mdi-36px"></i>

                                    <p class="font-weight-medium mt-2">Total Users</p>

                                </div>

                                <h1 class="font-weight-light">

                                    @if(isset($total_user)){{ $total_user }}@endif

                                </h1>

                                <p class="text-muted mb-0">User</p>

                            </div>

                        </div>

                    </div>

                   


                </div>



              

            </div>

        </div>



    </div>

@stop



@section('script')


@stop