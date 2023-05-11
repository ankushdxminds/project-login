<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use View;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(Request $request)
    {
        return redirect('login');
    }

    function login_view(Request $request)
    {
        $data['page_segment'] = '';
        if(isset($request->page_segment) && !empty($request->page_segment))
        {
            $data['page_segment'] = $request->page_segment;
        }
        return view('login',$data);
    }

    function login_api(Request $request)
    {
        $login_data = [filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->email, 'password' => $request->password];

        if (Auth::attempt($login_data))
        {
            User::where('email','=',$request->email)->update(['login_key'=>rand(1111111,9999999)]);

            if(isset($request->page_segment) && !empty($request->page_segment)) 
            {
                return redirect($request->page_segment);
            }else{
                return redirect('/');
            }
            return redirect('/admin/dashboard');
        } 
        else
        {
             return redirect()->back()->with('error','Invalid Username Or Password!');
        }
        
    }

   function check_login()
   { 
        $user = User::select('login_key')->first();
        if(isset($user->login_key) && !empty($user->login_key))
        {
            echo json_encode(['status'=>'success','login_key'=>$user->login_key]);
        } 
        else
        {
            echo json_encode(['status'=>'error','login_key'=>null]);
        }
    }

    function logout(Request $request) 
    {
        Auth::logout();
        User::whereNotNull('login_key')->update(['login_key'=>null]);

        if(isset($request->page_segment) && !empty($request->page_segment)) 
        {
            return redirect($request->page_segment);
        }else{
            return redirect('/');
        }
       
    }
}