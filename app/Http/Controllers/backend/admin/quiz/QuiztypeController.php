<?php

namespace App\Http\Controllers\backend\admin\quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Quiztype;
class QuiztypeController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = 'Quiz type List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Quiz type List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Quiz type List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['css'] = array(
        );
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
            'quiztype.js',
        );
        $data['funinit'] = array(
            'Quiztype.init()',
        );
        $data['header'] = array(
            'title' => 'Quiz type List',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz type List' => 'Quiz type List',
            )
        );
        return view('backend.pages.quiztype.list', $data);
    }

    public function add(){

        $data['title'] = 'Add Quiz type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Add Quiz type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Add Quiz type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['plugincss'] = array(
            'plugins/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',
            'js/pages/crud/forms/widgets/select2.js',
            'js/pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiztype.js',
        );
        $data['funinit'] = array(
            'Quiztype.add()',
        );
        $data['header'] = array(
            'title' => 'Add Quiz Type',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz Type List' => route('quiz-type-list'),
                'Add Quiz Type' => 'Add Quiz Type',
            )
        );
        return view('backend.pages.quiztype.add', $data);
    }

    public function save_add_quiz_type(Request $request){
        $objQuiztype = new Quiztype();
        $result = $objQuiztype->add_quiz_type($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz type added successfully.';
            $return['redirect'] = route('quiz-type-list');
        } else {
            if($result == 'quiz_type_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz type already exit.';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function edit($editId){

        $objQuiztype = new Quiztype();
        $data['quiz_type_details'] = $objQuiztype->get_quiz_type_details($editId);

        $data['title'] = 'Edit Quiz Type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Edit Quiz Type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Edit Quiz Type || '.Config::get('constants.SYSTEM_NAME') ;
        $data['plugincss'] = array(
            'plugins/toastr/toastr.min.css'
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',
            'js/pages/crud/forms/widgets/select2.js',
            'js/pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'quiztype.js'
        );
        $data['funinit'] = array(
            'Quiztype.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Quiz Type',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz Type' => route('quiz-type-list'),
                'Quiz Type Edit' => 'Quiz Type Edit',
            )
        );
        return view('backend.pages.quiztype.edit', $data);
    }

    public function save_edit_quiz_type(Request $request){
        $ojQuiztype = new Quiztype();
        $result = $ojQuiztype->edit_quiz_type($request);
        if ($result == 'true') {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz type added successfully.';
            $return['redirect'] = route('quiz-type-list');
        } else {
            if($result == 'quiz_type_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz type already exit.';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'getdatatable':

                $objQuiztype = new Quiztype();
                $list = $objQuiztype->getdatatable();

                echo json_encode($list);
                break;

            case 'delete-quiz-type':


                $objQuiztype = new Quiztype();
                $result = $objQuiztype->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Type successfully deleted.';
                    $return['redirect'] = route('quiz-type-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;



            case 'active-quiz-type':

                $objQuiztype = new Quiztype();
                $result = $objQuiztype->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Type successfully actived.';
                    $return['redirect'] = route('quiz-type-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;


            case 'deactive-quiz-type':

                $objQuiztype = new Quiztype();
                $result = $objQuiztype->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Type successfully deactived.';
                    $return['redirect'] = route('quiz-type-list');
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
