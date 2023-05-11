<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Routing\Controller as Controller;



use App\Models\User;

use Illuminate\Http\Request;

use App\Helpers\Helpers;

use Auth;

use View;

use Validator;





class UserController extends Controller

{



    function user_list_view()

    {

        

        $data['auth_user'] = Auth::user();

        $data['page_title'] = trans('View.title_admin_user_list');

        return view('Admin/User/index', $data);

    }



    function search_user_api(Request $request)

    {

        $userObj = new User();

        $request->roles_key = config('groups.USERS');

        $response = $userObj->search_users($request);

        $data['data'] = $response['data'];

        $view = View::make('Admin/Search/users', $data);

        $html = $view->render();

        return response()->json(['html' => $html, 'total' => $response['total']]);

    }



    function add_user_view()

    {



        

        $data['auth_user'] = Auth::user();

        $data['page_title'] = trans('View.title_admin_user_add');

        return view('Admin/User/create', $data);

    }



    function store_user_api(Request $request)

    {



        $check_validation = users_validation($request);

        if ($check_validation['status'] == 400)

            return response()->json($check_validation);



        $request->password = '12345';

        $userObj = new User();

        $response = $userObj->add_update_user($request);



        $resp_msg = trans('Msg.succ_add_seller_details');

        $url = config('routes.admin_user_list');



        return response()->json(['status' => 201, 'url' => $url, 'response' => $response, 'msg' => $resp_msg]);

    }



    function edit_user_view($user_id)

    {

      

        $userData = User::find($user_id);

        if(empty($userData))

            return view('Others/error',['status' => 404,'error' => 'Not found','msg' => trans('Msg.seller_not_exist')]);



        $data['data'] = $userData;



        

        $data['auth_user'] = Auth::user();

        $data['page_title'] = trans('View.title_admin_user_add');

        return view('Admin/User/edit', $data);

    }



    function update_user_api(Request $request)

    {



        $check_validation = users_validation($request);

        if ($check_validation['status'] == 400)

            return response()->json($check_validation);



        $request->password = '12345';

        $userObj = new User();

        $response = $userObj->add_update_user($request);



        $resp_msg = trans('Msg.succ_add_seller_details');

        $url = config('routes.admin_user_list');



        return response()->json(['status' => 201, 'url' => $url, 'response' => $response, 'msg' => $resp_msg]);

    }

   





}

