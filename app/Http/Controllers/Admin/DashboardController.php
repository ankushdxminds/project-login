<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Helpers;
use Auth;
use View;

class DashboardController extends Controller
{

    function dashboard_view()
    {

        $data['auth_user'] = Auth::user();

        $data['page_title'] = 'Dashboard';

        $userModel = new User();

        $userData = $userModel->get_total_user();

        $data['total_user'] = $userData;


        return view('Admin/Dashboard/dashboard', $data);
    }

 }

