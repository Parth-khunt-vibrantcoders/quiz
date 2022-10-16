<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audittrails;
use DB;
use Hash;
use Route;
use Session;
use Str;

class Users extends Model
{
    use HasFactory;
    protected $table= 'users';

    public function update_profile($requestData){

        $countUser = Users::where("email",$requestData['email'])
                        ->where("id",'!=',$requestData['edit_id'])
                        ->count();

        if($countUser == 0){

            $objUsers = Users::find($requestData['edit_id']);
            $objUsers->first_name = $requestData['first_name'];
            $objUsers->last_name = $requestData['last_name'];
            $objUsers->email = $requestData['email'];
            if($requestData['userimage']){
                $image = $requestData['userimage'];
                $imagename = 'userimage'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/userprofile/');
                $image->move($destinationPath, $imagename);
                $objUsers->userimage  = $imagename ;
            }
            if($objUsers->save()){
                $currentRoute = Route::current()->getName();

                $request_data = $requestData;
                unset($request_data['_token']);
                unset($request_data['profile_avatar_remove']);
                unset($request_data['userimage']);
                if($requestData['userimage']){
                    $request_data['userimage'] = $imagename;
                }
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($request_data) ,'Update Profile' );
                return true;
            }else{
                return "false";
            }

        }else{
            return "email_exist";
        }
    }

    public function changepassword($requestData)
    {

        if (Hash::check($requestData['old_password'], $requestData['user_old_password'])) {
            $countUser = Users::where("id",'=',$requestData['editid'])->count();
            if($countUser == 1){
                $objUsers = Users::find($requestData['editid']);
                $objUsers->password =  Hash::make($requestData['new_password']);
                $objUsers->updated_at = date('Y-m-d H:i:s');
                if($objUsers->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $requestData;
                    unset($inputData['_token']);
                    unset($inputData['user_old_password']);
                    unset($inputData['old_password']);
                    unset($inputData['new_password']);
                    unset($inputData['new_confirm_password']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($inputData) ,'Change Password' );
                    return true;
                }else{
                    return 'false';
                }
            }else{
                return "false";
            }
        }else{
            return "password_not_match";
        }
    }

    public function save_sign_up($requestData){
        $count = Users::where('users.email', $requestData['email'])->count();
       if($count == 0){
            $objUsers = new Users();
            $objUsers->first_name = $requestData['firstname'];
            $objUsers->last_name = $requestData['lastname'];
            $objUsers->email = $requestData['email'];
            $objUsers->email_verified_at = date('Y-m-d H:i:s');
            $objUsers->password = Hash::make($requestData['password']);
            $objUsers->user_type = 2;
            $objUsers->status = 'Y';
            $objUsers->is_deleted = 'N';
            $objUsers->created_at = date('Y-m-d H:i:s');
            $objUsers->updated_at = date('Y-m-d H:i:s');
            if($objUsers->save()){
                return 'true';
            }else{
                return 'false';
            }
       }else{
           return 'email_exits';
       }
    }
}
