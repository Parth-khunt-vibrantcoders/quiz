<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiztype;
use App\Models\Quizcategory;
use App\Models\Quiz;
class CommonController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function ajaxcall(Request $request){
        $action = $request->input('action');

        switch ($action) {
            case 'change-quiz-type':

                $objQuizcategory = new Quizcategory();
                $list = $objQuizcategory->change_quiz_type($request->input('data'));

                echo json_encode($list);
                break;
            case 'change-quiz-category':

                $objQuiz = new Quiz();
                $list = $objQuiz->get_quiz_list($request->input('data'));

                echo json_encode($list);
                break;
            }
    }
}
