<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.8.94/css/materialdesignicons.min.css"> -->

    <!-- <link rel="stylesheet" href="{{ config('constants.assets_url') }}vendors/css/vendor.bundle.base.css"> -->

    <!-- <link rel="stylesheet" href="{{ config('constants.assets_url') }}vendors/css/vendor.bundle.addons.css"> -->

    <link rel="stylesheet" href="{{ config('constants.assets_url') }}css/vertical-layout-light/style.css">

    <!-- <link rel="shortcut icon" href="{{ config('constants.assets_url') }}images/favicon.png" /> -->

    <link href="{{ config('constants.my_assets_url') }}iziToast.min.css" rel="stylesheet">

    <!-- <link href="{{ config('constants.my_assets_url') }}simplePagination.css" rel="stylesheet"> -->

    <!-- <link href="{{ config('constants.my_assets_url') }}chosen.css" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

</head>

<body class="">

<div class="container-scroller">

    <style>

        .upload-file {

            opacity: 0;

            height: 33px;

            width: 22%;

        }



        .upload-btn {

            position: absolute;

        }



        .upload-box {

            padding-left: 0px;

            margin-top: 7px;

        }



        .without::-webkit-datetime-edit-ampm-field {

            display: none;

        }



        .without::-webkit-clear-button {

            display: none;

        }

    </style>





    <div class="container-scroller">





        <div class="container-fluid page-body-wrapper full-page-wrapper">

            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">

                <div class="row flex-grow">

                    <div class="col-lg-12 order-2 d-flex justify-content-center flex-column">

                        <div class="auth-form-transparent text-left p-3">

                            <h4>@lang('View.welcome')</h4>

                            <h6 class="font-weight-light">

                                @lang('View.welcome_text')

                            </h6>

                            <form class="pt-3 forms-sample" id="loginForm">

                                <div class="form-group">

                                    <label>@lang('View.email')</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend bg-transparent">

                                          <span class="input-group-text bg-transparent border-right-0">

                                            <i class="mdi mdi-account-outline text-primary"></i>

                                          </span>

                                        </div>

                                        <input type="email"

                                               id="email"

                                               name="email"

                                               class="form-control form-control-lg border-left-0"

                                               placeholder="@lang('View.email_placeholder')"

                                               required="">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>@lang('View.password')</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend bg-transparent">

                                      <span class="input-group-text bg-transparent border-right-0">

                                        <i class="mdi mdi-lock-outline text-primary"></i>

                                      </span>

                                        </div>

                                        <input type="password"

                                               id="password"

                                               name="password"

                                               class="form-control form-control-lg border-left-0"

                                               placeholder="@lang('View.password_placeholder')"

                                               required="">

                                    </div>

                                </div>

                                @csrf

                             {{--   <div class="my-2 d-flex justify-content-between align-items-center">

                                    <div class="form-check">

                                        <label class="form-check-label text-muted">

                                            <input type="checkbox" class="form-check-input">

                                            Keep me signed in

                                        </label>

                                    </div>



                                </div>--}}

                                <div class="my-3">

                                    <button type="button"

                                            onclick="add_update_details('loginForm','{{ url('/admin/login-api') }}')"

                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">

                                       @lang('View.login')

                                    </button>

                                </div>

                            </form>

                        </div>

                            <p class="font-weight-medium text-center">Copyright &copy;

                            2019 All rights reserved.</p>

                    </div>

                

                </div>

            </div>

            <!-- content-wrapper ends -->

        </div>

    </div>

</div>





<script>

    var base_url = '{{ url('/') }}/';

</script>



<script src="{{ config('constants.assets_url') }}vendors/js/vendor.bundle.base.js"></script>

<!-- <script src="{{ config('constants.assets_url') }}vendors/js/vendor.bundle.addons.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/off-canvas.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/hoverable-collapse.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/settings.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/todolist.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/select2.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/formpickers.js"></script> -->

<!-- <script src="{{ config('constants.assets_url') }}js/tooltips.js"></script> -->

<!-- <script src="{{ config('constants.my_assets_url') }}jquery.simplePagination.js"></script> -->

<script src="{{ config('constants.my_assets_url') }}iziToast.min.js"></script>

<!-- <script src="{{ config('constants.my_assets_url') }}chosen.jquery.js"></script> -->

<script src="{{ config('constants.my_assets_url') }}common.js"></script>

<!-- <script src="{{ config('constants.my_assets_url') }}custom.js"></script> -->

<!-- <script>

    //checkbox and radios

    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

</script> -->





<script>

    $('#loginForm').keydown(function (e) {

        var key = e.which;

        if (key == 13) {



            add_update_details('loginForm', '{{ url('/admin/login-api') }}');

        }

    });

</script>





<div class="modal fade" id="commonModalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

     aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content" id="adminModalBody">

            <div class="modal-body">



            </div>

        </div>

    </div>

</div>





</body>

</html>



