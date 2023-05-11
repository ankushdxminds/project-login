@php $uri_segment_2 =  Request::segment(2) @endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">

            <ul class="nav">

                <li class="nav-item @if($uri_segment_2 == 'dashboard'){{ 'active'  }} @endif">

                    <a class="nav-link" href="{{ url('/admin/dashboard') }}">

                        <i class="fa fa-dashboard menu-icon"></i>

                        <span class="menu-title">Dashboard</span>

                    </a>

                </li>



            

            </ul>

</nav>



<div class="main-panel">

