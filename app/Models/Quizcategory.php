<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Route;
use Session;

class Quizcategory extends Model
{
    use HasFactory;
    protected $table = 'quiz_category';

    public function getdatatable(){
        $requestData = $_REQUEST;

        $columns = array(
            0 => 'quiz_category.id',
            1 => 'quiz_type.name',
            2 => 'quiz_category.name',
            3 => DB::raw('(CASE WHEN quiz_category.status = "Y" THEN "Active" ELSE "Inactive" END)')
        );

        $query = Quizcategory ::from('quiz_category')
                        ->join('quiz_type', 'quiz_type.id', '=', 'quiz_category.quiz_type')
                        ->where('quiz_type.is_deleted', 'N')
                        ->where('quiz_category.is_deleted', 'N');


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
                        ->select('quiz_category.id', 'quiz_category.name', 'quiz_category.status', 'quiz_type.name as quiz_type')
                        ->get();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml = '<a href="' . route('quiz-category-edit', $row['id']) . '" class="btn btn-icon" title="Edit Details"><i class="fa fa-edit text-warning"> </i></a>';

            if($row['status'] == "Y"){
                $status = '<span class="badge badge-lg badge-success badge-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-quiz-category" data-id="' . $row["id"] . '" title="Deactive Question"><i class="fa fa-times text-info" ></i></a>';
            }else{
                $status = '<span class="badge badge-lg badge-danger  badge-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-quiz-category" data-id="' . $row["id"] . '" title="Active Question"><i class="fa fa-check text-info" ></i></a>';
            }

            $actionhtml =  $actionhtml.'<a href="javascript:;" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon delete-quiz-category" data-id="' . $row["id"] . '" title="Delete Question"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = ucfirst($row['quiz_type']);
            $nestedData[] = ucfirst($row['name']);
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

    public function add_quiz_category($requestData){
        $count = Quizcategory::where('quiz_category.name', $requestData['quiz_category'])
                            ->where('quiz_type', $requestData['quiz_type'])
                            ->count();
        if($count == 0){
            $objQuiz_category = new Quizcategory();
            $objQuiz_category->name = $requestData['quiz_category'];
            $objQuiz_category->quiz_type = $requestData['quiz_type'];
            $objQuiz_category->status = $requestData['status'];
            $objQuiz_category->is_deleted = "N";
            $objQuiz_category->created_at = date("Y-m-d H:i:s");
            $objQuiz_category->updated_at = date("Y-m-d H:i:s");
            if($objQuiz_category->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $requestData;
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Add', 'quiz/'. $currentRoute , json_encode($inputData) ,'Quiz Category' );
                return "true";
            }
                return "false";
            }
        return 'quiz_category_exits';
    }

    public function get_quiz_category_details($id){
        return Quizcategory::select('quiz_category.name', 'quiz_category.quiz_type','quiz_category.id', 'quiz_category.status')
                            ->where('quiz_category.id', $id)
                            ->get()
                            ->toArray();
    }

    public function edit_quiz_category($requestData){
        $count = Quizcategory::where('quiz_category.name', $requestData['quiz_category'])
                        ->where('quiz_type', $requestData['quiz_type'])
                        ->where('quiz_category.id', '!=', $requestData['editId'])
                        ->count();

                if($count == 0){
                $objQuiz_category = Quizcategory::find($requestData['editId']);
                $objQuiz_category->name = $requestData['quiz_category'];
                $objQuiz_category->quiz_type = $requestData['quiz_type'];
                $objQuiz_category->status = $requestData['status'];
                $objQuiz_category->updated_at = date("Y-m-d H:i:s");
                if($objQuiz_category->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $requestData;
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Edit', 'quiz/'. $currentRoute , json_encode($inputData) ,'Quiz Category' );
                    return "true";
                }
                    return "false";
                }
                return 'quiz_category_exits';

    }

    public function get_quiz_category_list(){
        return Quizcategory::select('quiz_category.name', 'quiz_category.id', 'quiz_type.name as quiz_type')
                        ->join('quiz_type', 'quiz_type.id', '=', 'quiz_category.quiz_type')
                        ->where('quiz_type.is_deleted', 'N')
                        ->where('status', 'Y')
                        ->where('is_deleted', 'N')
                        ->get()
                        ->toArray();
    }

    public function common_activity_user($data,$type){
        $objQuiz_category = Quizcategory::find($data['id']);
        if($type == 0){
            $objQuiz_category->is_deleted = "Y";
            $event = 'Delete Quiz Category';
        }
        if($type == 1){
            $objQuiz_category->status = "Y";
            $event = 'Active Quiz Category';
        }
        if($type == 2){
            $objQuiz_category->status = "N";
            $event = 'Deactive Quiz Category';
        }

        $objQuiz_category->updated_at = date("Y-m-d H:i:s");
        if($objQuiz_category->save()){
            $currentRoute = Route::current()->getName();
             $objAudittrails = new Audittrails();
             $res = $objAudittrails->add_audit($event, 'quiz/'.$currentRoute, json_encode($data), 'Quiz Category');
             return true;
        }else{
            return false ;
        }
    }

    public function change_quiz_type($data){
        return Quizcategory::select('quiz_category.id', 'quiz_category.name')
                ->where('quiz_category.quiz_type', $data['quiz_type'])
                ->where('quiz_category.status', 'Y')
                ->where('quiz_category.is_deleted', 'N')
                ->get()->toArray();
    }
}
