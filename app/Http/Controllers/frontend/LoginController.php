<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Users;
use Auth;
use Session;
use Hash;
class LoginController extends Controller
{
    public function login(){
        $data['title'] =  'User Login || '. Config::get('constants.SYSTEM_NAME');
        $data['description'] =  'User Login || '. Config::get('constants.SYSTEM_NAME');
        $data['keywords'] =  'User Login || '. Config::get('constants.SYSTEM_NAME');
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            'css/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'login.js',
        );
        $data['funinit'] = array(
            'Login.init()',
        );
        return view('frontend.pages.login', $data);
    }

    public function check_sign_in(Request $request){
        if (Auth::guard('users')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_deleted'=>'N', 'user_type'=>2])) {
            $loginData = '';
            $request->session()->forget('logindata');
            $loginData = array(
                'first_name' => Auth::guard('users')->user()->first_name,
                'last_name' => Auth::guard('users')->user()->last_name,
                'email' => Auth::guard('users')->user()->email,
                'userimage' => Auth::guard('users')->user()->userimage,
                'user_type' => Auth::guard('users')->user()->user_type,
                'id' => Auth::guard('users')->user()->id
            );
            Session::push('logindata', $loginData);
            $return['status'] = 'success';
            $return['message'] = 'You have successfully logged in.';
            $return['redirect'] = route('home');
        } else {
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Invalid Login Id/Password';
        }
        return json_encode($return);
        exit();
    }

    public function sign_up(){
        $data['title'] =  'User Sign-up || '. Config::get('constants.SYSTEM_NAME');
        $data['description'] =  'User Sign-up || '. Config::get('constants.SYSTEM_NAME');
        $data['keywords'] =  'User Sign-up || '. Config::get('constants.SYSTEM_NAME');
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            'css/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'register.js',
        );
        $data['funinit'] = array(
            'Register.init()',
        );
        return view('frontend.pages.sign_up', $data);
    }

    public function save_sign_up(Request $request){
        $objUsers = new Users();
        $result = $objUsers->save_sign_up($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
            $return['message'] = 'Your registration successfully registered.';
            $return['redirect'] = route('sign-in');
        } else {
            if ($result == 'email_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Email address already registered';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }
}
