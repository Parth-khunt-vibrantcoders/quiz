<?php

namespace App\Http\Controllers\backend\admin\quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quizcategory;
use App\Models\Quiztype;
use Config;

class QuizcategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = 'Quiz category List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Quiz category List - '. Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Quiz category List - '. Config::get('constants.SYSTEM_NAME') ;
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
            'quizcategory.js',
        );
        $data['funinit'] = array(
            'Quizcategory.init()',
        );
        $data['header'] = array(
            'title' => 'Quiz Category List',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz Category List' => 'Quiz Category List',
            )
        );
        return view('backend.pages.quizcategory.list', $data);
    }

    public function add(){

        $objQuiztype = new Quiztype();
        $data['quiz_type'] = $objQuiztype->get_quiz_type_list();

        $data['title'] = 'Add Quiz category || '.Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Add Quiz category || '.Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Add Quiz category || '.Config::get('constants.SYSTEM_NAME') ;
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
            'quizcategory.js'
        );
        $data['funinit'] = array(
            'Quizcategory.add()'
        );
        $data['header'] = array(
            'title' => 'Add Quiz category',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Quiz category List' => route('quiz-category-list'),
                'Add Quiz category' => 'Add Quiz category',
            )
        );
        return view('backend.pages.quizcategory.add', $data);
    }

    public function save_add_quiz_category(Request $request){
        $objQuizcategory = new Quizcategory();
        $result = $objQuizcategory->add_quiz_category($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz category added successfully.';
            $return['redirect'] = route('quiz-category-list');
        } else {
            if($result == 'quiz_category_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz category already exit.';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function edit(Request $request, $genderid){


        $objQuiztype = new Quiztype();
        $data['quiz_type'] = $objQuiztype->get_quiz_type_list();

        $ojQuizcategory = new Quizcategory();
        $data['quiz_category_details'] = $ojQuizcategory->get_quiz_category_details($genderid);

        $data['title'] = 'Edit Gender || '.Config::get('constants.SYSTEM_NAME') ;
        $data['keywords'] = 'Edit Gender || '.Config::get('constants.SYSTEM_NAME') ;
        $data['description'] = 'Edit Gender || '.Config::get('constants.SYSTEM_NAME') ;
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
            'quizcategory.js'
        );
        $data['funinit'] = array(
            'Quizcategory.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Gender',
            'breadcrumb' => array(
                'Dashboard' => route('my-dashboard'),
                'Gender List' => route('quiz-category-list'),
                'Edit Gender' => 'Edit Gender',
            )
        );
        return view('backend.pages.quizcategory.edit', $data);
    }

    public function save_edit_quiz_category(Request $request){
        $ojQuizcategory = new Quizcategory();
        $result = $ojQuizcategory->edit_quiz_category($request->all());
        if ($result == 'true') {
            $return['status'] = 'success';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Quiz category added successfully.';
            $return['redirect'] = route('quiz-category-list');
        } else {
            if($result == 'quiz_category_exits') {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Quiz category already exit.';
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

                $objQuizcategory = new Quizcategory();
                $list = $objQuizcategory->getdatatable();

                echo json_encode($list);
                break;
            case 'delete-quiz-category':

                $objQuizcategory = new Quizcategory();
                $result = $objQuizcategory->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Category successfully deleted';
                    $return['redirect'] = route('quiz-category-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;


            case 'active-quiz-category':

                $objQuizcategory = new Quizcategory();
                $result = $objQuizcategory->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Category successfully actived';
                    $return['redirect'] = route('quiz-category-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;


            case 'deactive-quiz-category':

                $objQuizcategory = new Quizcategory();
                $result = $objQuizcategory->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Quiz Category successfully deactived';
                    $return['redirect'] = route('quiz-category-list');
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
