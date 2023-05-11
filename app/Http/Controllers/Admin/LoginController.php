<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as Controller;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Helpers\Helpers;
use Auth;
use View;
use Validator;

class LoginController extends Controller
{
    function login_view()
    {
        $data['page_title'] = 'Login';
        return view('Admin/login', $data);
    }



    function login_api(Request $request)
    {
        $rules = ['email' => 'required', 'password' => 'required'];
        $msg = ['email.required' => trans('Msg.admin_email_login_required'),
                'password.required' => trans('Msg.admin_password_login_required')
            ];
        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails())
            return response()->json(['status' => 400, 'response' => 'error', 'msg' => $validator->errors()->first()]);

        $login_data = [filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->email, 'password' => $request->password,'roles_key' => 'ADMIN'];

        if (Auth::attempt($login_data))
        {
            return response()->json(['status' => 201,'url'=>url('/admin/dashboard'), 'response' => 'success', 'msg' => trans('Msg.succ_admin_login')]);
        } else
        {
            return response()->json(['status' => 400, 'response' => 'error', 'msg' => trans('Msg.wrong_admin_credentials')]);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect(config('routes.login'));
    }

}

