<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Route;
use Session;
class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';

    public function getdatatable(){
        $requestData = $_REQUEST;

        $columns = array(
            0 => 'quiz.id',
            1 => 'quiz.image',
            2 => 'quiz_type.name',
            3 => 'quiz_category.name',
            4 => 'quiz.name',
            5 => 'quiz.time',
            6 => DB::raw('(CASE WHEN quiz.status = "Y" THEN "Active" ELSE "Inactive" END)')
        );

        $query = Quiztype ::from('quiz')
                    ->join('quiz_category', 'quiz_category.id', '=', 'quiz.category')
                    ->join('quiz_type', 'quiz_type.id', '=', 'quiz_category.quiz_type')
                    ->where('quiz.is_deleted', 'N');


        if (!empty($requestData['search']['value'])) {
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('quiz.id', 'quiz.image', 'quiz.time', 'quiz_type.name as quiz_type', 'quiz_category.name as quiz_category', 'quiz.name',  'quiz.status')
                        ->get();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            if(file_exists( public_path().'/uploads/quiz/'.$row['image']) && $row['image'] != ''){
                $image = url("public/uploads/quiz/".$row['image']);
            }else{
                $image = url("public/uploads/quiz/no-image.png");
            }
            $image_html = '<img src="'. $image .'" class="h-75 align-self-end" alt="" style="height:70px !important;; width:70px !important">';

            $actionhtml = '<a href="' . route('quiz-edit', $row['id']) . '" class="btn btn-icon" title="Edit Details"><i class="fa fa-edit text-warning"> </i></a>';

            if($row['status'] == "Y"){
                $status = '<span class="badge badge-lg badge-success badge-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-quiz" data-id="' . $row["id"] . '" title="Deactive Question"><i class="fa fa-times text-info" ></i></a>';
            }else{
                $status = '<span class="badge badge-lg badge-danger  badge-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-quiz" data-id="' . $row["id"] . '" title="Active Question"><i class="fa fa-check text-info" ></i></a>';
            }
            $actionhtml = $actionhtml. '<a href="' . route('quiz-view', $row['id']) . '" class="btn btn-icon" title="Edit Details"><i class="fa fa-eye text-primary"> </i></a>';
            $actionhtml =  $actionhtml.'<a href="javascript:;" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon delete-quiz" data-id="' . $row["id"] . '" title="Delete Question"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $image_html;
            $nestedData[] = ucfirst($row['quiz_type']);
            $nestedData[] = ucfirst($row['quiz_category']);
            $nestedData[] = ucfirst($row['name']);
            $nestedData[] = $row['time'];
            $nestedData[] = $status;
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }


    public function add_quiz($requestData){

        $objQuiz = new Quiz();
        $objQuiz->category = $requestData['quiz_category'];
        if($requestData['image']){
            $image = $requestData['image'];
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/quiz/');
            $image->move($destinationPath, $imagename);
            $objQuiz->image = $imagename;
        }
        $objQuiz->slug = $this->check_slug(generateRandomString(10));
        $objQuiz->name = $requestData['name'];
        $objQuiz->time = $requestData['time'];
        $objQuiz->status = $requestData['status'];
        $objQuiz->is_deleted = 'N';
        $objQuiz->created_at = date('Y-m-d h:i:s');
        $objQuiz->updated_at = date('Y-m-d h:i:s');
        if($objQuiz->save()){
            $currentRoute = Route::current()->getName();
            $inputData = $requestData;
            unset($inputData['_token']);
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit('Add', 'quiz/'. $currentRoute , json_encode($inputData) ,'Quiz' );
            return 'true';
        }
        return 'false';

    }

    public function check_slug($slug){
        $count = Quiz::where('slug', $slug)->count();
        if($count == 0){
            return $slug;
        }else{
            $this->check_slug(generateRandomString(10));
        }
    }

    public function get_quiz_edit($editId){
        return Quiz::from('quiz')
                ->join('quiz_category', 'quiz_category.id', '=', 'quiz.category')
                ->join('quiz_type', 'quiz_type.id', '=', 'quiz_category.quiz_type')
                ->select('quiz.id', 'quiz.category', 'quiz.image', 'quiz.name', 'quiz.time', 'quiz.status', 'quiz_type.id as quiz_type')
                ->where('quiz.id', $editId)
                ->get()
                ->toArray();
    }

    public function edit_quiz($requestData){

        $objQuiz = Quiz::find($requestData['editId']);
        $objQuiz->category = $requestData['quiz_category'];
        if($requestData['image']){
            $image = $requestData['image'];
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/quiz/');
            $image->move($destinationPath, $imagename);
            $objQuiz->image = $imagename;
        }
        $objQuiz->name = $requestData['name'];
        $objQuiz->time = $requestData['time'];
        $objQuiz->status = $requestData['status'];
        $objQuiz->updated_at = date('Y-m-d h:i:s');
        if($objQuiz->save()){
            $currentRoute = Route::current()->getName();
            $inputData = $requestData;
            unset($inputData['_token']);
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit('Edit', 'quiz/'. $currentRoute , json_encode($inputData) ,'Quiz' );
            return 'true';
        }
        return 'false';

    }

    public function common_activity_user($data,$type){
        $objQuiz = Quiz::find($data['id']);
        if($type == 0){
            $objQuiz->is_deleted = "Y";
            $event = 'Delete Quiz';
        }
        if($type == 1){
            $objQuiz->status = "Y";
            $event = 'Active Quiz';
        }
        if($type == 2){
            $objQuiz->status = "N";
            $event = 'Deactive Quiz';
        }

        $objQuiz->updated_at = date("Y-m-d H:i:s");
        if($objQuiz->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'quiz/'.$currentRoute, json_encode($data), 'Quiz');

            return true;
        }else{
            return false ;
        }
    }

    public function get_quiz_view_details($editId){
        return Quiz::from('quiz')
                ->join('quiz_category', 'quiz_category.id', '=', 'quiz.category')
                ->join('quiz_type', 'quiz_type.id', '=', 'quiz_category.quiz_type')
                ->select('quiz.id', 'quiz.category', 'quiz.image', 'quiz.name', 'quiz.time', 'quiz.status', 'quiz_category.name as quiz_category', 'quiz_type.name as quiz_type')
                ->where('quiz.id', $editId)
                ->get()
                ->toArray();
    }
}
