<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use Route;
use Session;

class Smtpsetting extends Model
{
    use HasFactory;
    protected $table ='smtp_setting';

    public function get_smtp_setting_details(){
        return Smtpsetting::select('smtp_setting.id', 'smtp_setting.server', 'smtp_setting.username', 'smtp_setting.password', 'smtp_setting.port', 'smtp_setting.driver', 'smtp_setting.encryption')
        ->get()
        ->toArray();
    }
    public function update_smtp_setting($requestData){

        $count = Smtpsetting::where('smtp_setting.id', '!=', $requestData['editid'])
               ->count();

        if($count == 0){

            $objSmtpsetting = Smtpsetting::find($requestData['editid']);
            $objSmtpsetting->server = $requestData['server'];
            $objSmtpsetting->username = $requestData['username'];
            $objSmtpsetting->password =  $requestData['password'];
            $objSmtpsetting->port = $requestData['port'];
            $objSmtpsetting->driver = $requestData['driver'];
            $objSmtpsetting->encryption = $requestData['encryption'];
            $objSmtpsetting->updated_at = date("Y-m-d H:i:s");
            if($objSmtpsetting->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $requestData;
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Edit', 'admin/'. $currentRoute , json_encode($inputData) ,' Smtpsetting' );
                return "true";
            }
            return "false";
        }
        return "false" ;
    }
}
