<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiztype;
use Config;
class QuizLoginController extends Controller
{
    public function list(){

        $objQuiztype = new Quiztype();
        $data['quiz_type'] = $objQuiztype->get_quiz_type_frontend_list();

        $data['title'] =  'Home || '. Config::get('constants.SYSTEM_NAME');
        $data['description'] =  'Home || '. Config::get('constants.SYSTEM_NAME');
        $data['keywords'] =  'Home || '. Config::get('constants.SYSTEM_NAME');
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
        );
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('frontend.pages.home', $data);
    }
}
