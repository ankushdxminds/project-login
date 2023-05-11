<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">

        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">

            <li class="nav-item nav-toggler-item">

                <button class="navbar-toggler align-self-center"

                        type="button"

                        data-toggle="minimize">

                    <span class="mdi mdi-menu"></span>

                </button>

            </li>

            <!-- <li class="nav-item nav-search d-none d-lg-flex">

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text" id="search">

                            <i class="mdi mdi-magnify"></i>

                        </span>

                    </div>

                    <input type="text"

                           class="form-control"

                           placeholder="search"

                           aria-label="search"

                           aria-describedby="search">

                </div>

            </li> -->

            <li class="nav-item nav-search d-none d-lg-flex">

                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

                    <a class="navbar-brand brand-logo" href="{{ url('/') }}">

                      Welcome
                    </a>

                   
                </div>

            </li>

        </ul>

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

          <a class="navbar-brand brand-logo-mini" href="{{ config('constants.public_url') }}/uploads/logo/logo.png" alt="logo"></a>

        </div>



        <ul class="navbar-nav navbar-nav-right">



            

            <li class="nav-item nav-profile dropdown">

                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

                   

                    <span class="nav-profile-name">

                            {{ $auth_user->username }}

                    </span>

                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                   
                    <div class="dropdown-divider"></div>

                    <a href="{{ url('/logout') }}"

                       class="dropdown-item">

                        <i class="mdi mdi-logout text-primary"></i>

                        Logout

                    </a>

                </div>

            </li>



            <li class="nav-item nav-toggler-item-right d-lg-none">

                <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">

                    <span class="mdi mdi-menu"></span>

                </button>

            </li>

        </ul>

    </div>

</nav>



<div class="container-fluid page-body-wrapper">

    <div id="right-sidebar" class="settings-panel">

        <i class="settings-close mdi mdi-close"></i>

        {{--   <ul class="nav nav-tabs" id="setting-panel" role="tablist">

               <li class="nav-item">

                   <a class="nav-link active"

                      id="todo-tab"

                      data-toggle="tab"

                      href="#todo-section"

                      role="tab"

                      aria-controls="todo-section"

                      aria-expanded="true">

                       @lang('View.agency')

                   </a>

               </li>



           </ul>--}}

        <div class="tab-content" id="setting-content">

            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"

                 aria-labelledby="todo-section">

                <div class="list-wrapper px-3">



                </div>



            </div>



        </div>

    </div>



    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">

        @csrf

    </form>



