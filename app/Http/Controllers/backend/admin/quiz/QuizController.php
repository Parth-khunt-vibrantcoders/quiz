<?php

namespace App\Http\Controllers\backend\admin\quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Quiz;
use App\Models\Quiztype;
use App\Models\Quizcategory;
use App\Models\Question;

class QuizController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = 'Quiz List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Quiz List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Quiz List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'plugins/custom/datatables/datatables.bundle.js',
            'pages/crud/datatables/data-sources/html.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiz.js',
        );
        $data['funinit'] = array(
            'Quiz.init()',
        );
        $data['header'] = array(
            'title' => 'Quiz List',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz List' => 'Quiz List',
            )
        );
        return view('backend.pages.quiz.list', $data);
    }

    public function add(){

        $objQuiztype = new Quiztype();
        $data['quiz_type'] = $objQuiztype->get_quiz_type_list();

        $data['title'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['plugincss'] = array(
            'plugins/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/forms/widgets/select2.js',
            'pages/crud/file-upload/image-input.js',
            'pages/crud/forms/widgets/bootstrap-timepicker.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiz.js',
        );
        $data['funinit'] = array(
            'Quiz.add()',
        );
        $data['header'] = array(
            'title' => 'Add Quiz',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz List' => route('quiz-list'),
                'Add Quiz' => 'Add Quiz',
            )
        );
        return view('backend.pages.quiz.add', $data);
    }

    public function save_add_quiz(Request $request){
        $objQuiz = new Quiz();
        $result = $objQuiz->add_quiz($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz added successfully.';
            $return['redirect'] = route('quiz-list');
        } else {
            if($result == 'quiz_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz already exit.';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }


    public function edit( $editId){

        $objQuiz = new Quiz();
        $data['quiz_details'] = $objQuiz->get_quiz_edit($editId);

        $objQuizcategory = new Quizcategory();
        $data['quiz_category'] = $objQuizcategory->change_quiz_type($data['quiz_details'][0]);

        $objQuiztype = new Quiztype();
        $data['quiz_type'] = $objQuiztype->get_quiz_type_list();

        $data['title'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Add Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['plugincss'] = array(
            'plugins/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',
            'js/pages/crud/forms/widgets/select2.js',
            'js/pages/crud/file-upload/image-input.js',
            'js/pages/crud/forms/widgets/bootstrap-timepicker.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiz.js',
        );
        $data['funinit'] = array(
            'Quiz.edit()',
        );
        $data['header'] = array(
            'title' => 'Add Quiz',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz List' => route('quiz-list'),
                'Add Quiz' => 'Add Quiz',
            )
        );
        return view('backend.pages.quiz.edit', $data);
    }

    public function save_edit_quiz(Request $request){
        $objQuiz = new Quiz();
        $result = $objQuiz->edit_quiz($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz updated successfully.';
            $return['redirect'] = route('quiz-list');
        } else {
            if($result == 'quiz_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz already exit.';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function view(Request $request, $editId){

        $objQuiz = new Quiz();
        $data['quiz_details'] = $objQuiz->get_quiz_view_details($editId);

        $data['title'] = 'View Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'View Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'View Quiz - '. Config::get('constants.SYSTEM_NAME') ;
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'plugins/custom/datatables/datatables.bundle.js',
            'js/pages/crud/datatables/data-sources/html.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiz.js',
        );
        $data['funinit'] = array(
            'Quiz.view()',
        );
        $data['header'] = array(
            'title' => 'View Quiz',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz List' => route('quiz-list'),
                'View Quiz' => 'View Quiz',
            )
        );
        return view('backend.pages.quiz.view', $data);
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'getdatatable':

                $objQuiz = new Quiz();
                $list = $objQuiz->getdatatable();

                echo json_encode($list);
                break;

            case 'delete-question':

                $objQuestion = new Question();
                $result = $objQuestion->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Question successfully deleted';
                    $return['redirect'] = route('quiz-view', $request->input('data')['data_quiz_id']);
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;

            case 'deactive-question':

                $objQuestion = new Question();
                $result = $objQuestion->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Question successfully deactived';
                    $return['redirect'] = route('quiz-view', $request->input('data')['data_quiz_id']);
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;

            case 'active-question':

                $objQuestion = new Question();
                $result = $objQuestion->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Question successfully actived';
                    $return['redirect'] = route('quiz-view', $request->input('data')['data_quiz_id']);
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;


            case 'getdatatable_question':

                $objQuestion = new Question();
                $list = $objQuestion->getdatatable($request->input('data')['quiz_id']);

                echo json_encode($list);
                break;

            case 'active-quiz':

                $objQuiz = new Quiz();
                $result = $objQuiz->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz successfully actived';
                    $return['redirect'] = route('quiz-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;



            case 'deactive-quiz':

                $objQuiz = new Quiz();
                $result = $objQuiz->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz successfully deactived';
                    $return['redirect'] = route('quiz-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;


            case 'delete-quiz':

                $objQuiz = new Quiz();
                $result = $objQuiz->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz successfully deleted';
                    $return['redirect'] = route('quiz-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;
        }
    }
}
