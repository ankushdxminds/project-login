<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Routing\Controller as Controller;



use Illuminate\Http\Request;

use App\Models\User;

use App\Helpers\Helpers;

use Auth;

use View;





class ProfileController extends Controller

{



    function profile_view()

    {

        

        $data['auth_user'] = Auth::user();



        $id = $auth_user->id;

        $data['data'] = User::where('id','=',$id)->first();



        $data['heading'] =  trans('profile_details');

        $data['post_url'] = url('/admin/add-update/update-profile-api');



       

        //  $data['city_data'] = $countryObj->get_city($auth_user->state_id);

        $data['page_title'] =$auth_user->username;

        return view('Admin/Profile/profile', $data);

    }





    function add_update_user_profile_api(Request $request)

    {



        $check_validation = users_validation($request);

        if ($check_validation['status'] == 400)

            return response()->json($check_validation);



        $auth_user = Auth::user();





        $query = User::query();

        $query->where('username', '=', $request->username);

        $query->where('id', '!=', $auth_user->id);

        $data = $query->get();



        if(isset($data[0]->id) && !empty($data[0]->id))

        {

            return response()->json(['status' => 400, 'response' => '', 'msg' => 'username Already Exist']);

        }







        $request->id = $auth_user->id;



        $userObj = User::find($auth_user->id);

        

        $userObj->username = $request->username;

        $userObj->first_name = $request->first_name;

        $userObj->last_name = $request->last_name;

        $userObj->email = $request->email;

        $userObj->address = $request->address;

        $userObj->address = $request->address;



        if(isset($request->phone_number))

            $userObj->phone_number = $request->phone_number;

        $userObj->gender = $request->gender;



        if(isset($request->dob))

            $userObj->dob = strtotime($request->dob);

      

        if (isset($request->avatar))

        {

            if ($userObj->avatar == $request->avatar)

            {

                $userObj->avatar = $request->avatar;



            } else

            {

                $userObj->avatar = move_avatar_file($request->avatar, $userObj->avatar);

            }

        }



        $userObj->save();



        $resp_msg = trans('Msg.succ_update_user_details');



        return response()->json(['status' => 200, 'response' => 1, 'msg' => $resp_msg]);

    }



    function change_password_view($user_id = 0)

    {

        $auth_user = Auth::user();



        if(empty($user_id))

        {

            $user_id = $auth_user->id;

        }

        

        $userData = User::find($user_id);





        $data['data'] = $userData;



        

        $data['auth_user'] = $auth_user;

        $data['page_title'] = trans('View.title_admin_seller_add');

        return view('Admin/Profile/change_password', $data);

    }



    function update_password(Request $request)

    {

        if(!isset($request->password) && empty($request->password))

            return response()->json(['status' => 400, 'response' => 'error', 'msg' => 'Passsword Required']);



        if(!isset($request->password_confirm) && empty($request->password_confirm))

            return response()->json(['status' => 400, 'response' => 'error', 'msg' => 'Confirm Passsword Required']);



        if($request->password != $request->password_confirm)

            return response()->json(['status' => 400, 'response' => 'error', 'msg' => 'Password And Confirm Passsword Not Same']);





        $password = bcrypt($request->password);

        User::where('id', $request->id)->update(['password' => $password]);





        return response()->json(['response' => 'success', 'msg' => trans('Msg.password_changed'), 'status' => 200]);





    }





}

