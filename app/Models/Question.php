<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Route;
use Session;
class Question extends Model
{
    use HasFactory;
    protected $table = 'question';

    public function getdatatable($quizId){
        $requestData = $_REQUEST;

        $columns = array(
            0 => 'question.id',
            1 => 'question.question',
            1 => DB::raw('(CASE WHEN question.status = "Y" THEN "Active" ELSE "Inactive" END)')
        );

        $query = Question ::from('question')
                                ->where('question.quiz_id', $quizId)
                                ->where('question.is_deleted', 'N');


        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
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
                        ->select('question.id', 'question.question', 'question.status', 'question.quiz_id')
                        ->get();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml = '<a href="' . route('quiz-edit-question', $row['id']) . '" class="btn btn-icon" title="Edit Details"><i class="fa fa-edit text-warning"> </i></a>';

            if($row['status'] == "Y"){
                $status = '<span class="badge badge-lg badge-success badge-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-question" data-quiz-id="'.$row['quiz_id'].'" data-id="' . $row["id"] . '" title="Deactive Question"><i class="fa fa-times text-info" ></i></a>';
            }else{
                $status = '<span class="badge badge-lg badge-danger  badge-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="javascript:;" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-question" data-quiz-id="'.$row['quiz_id'].'" data-id="' . $row["id"] . '" title="Active Question"><i class="fa fa-check text-info" ></i></a>';
            }

            $actionhtml =  $actionhtml.'<a href="javascript:;" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon delete-question" data-quiz-id="'.$row['quiz_id'].'" data-id="' . $row["id"] . '" title="Delete Question"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['question'];
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

    public function add_question($requestData){
        $objQuestion = new Question();
        $objQuestion->quiz_id = $requestData->input('quizId');
        $objQuestion->question = $requestData->input('question');
        $objQuestion->answer1 = $requestData->input('answer1');
        $objQuestion->answer2 = $requestData->input('answer2');
        $objQuestion->answer3 = $requestData->input('answer3');
        $objQuestion->answer4 = $requestData->input('answer4');
        $objQuestion->right_answer = $requestData->input('answer');
        $objQuestion->status = $requestData->input('status');
        $objQuestion->is_deleted = 'N';
        $objQuestion->created_at = date("Y-m-d H:i:s");
        $objQuestion->updated_at = date("Y-m-d H:i:s");
        return $objQuestion->save();
    }

    public function get_question_details($questionId){
        return Question::select('question.id', 'question.question', 'question.quiz_id', 'question.answer1', 'question.answer2', 'question.answer3', 'question.answer4', 'question.right_answer', 'question.status')
                    ->where('question.id', $questionId)
                    ->get()
                    ->toArray();
    }

    public function edit_question($requestData){
        $objQuestion = Question::find($requestData->input('questionId'));
        $objQuestion->quiz_id = $requestData->input('quizId');
        $objQuestion->question = $requestData->input('question');
        $objQuestion->answer1 = $requestData->input('answer1');
        $objQuestion->answer2 = $requestData->input('answer2');
        $objQuestion->answer3 = $requestData->input('answer3');
        $objQuestion->answer4 = $requestData->input('answer4');
        $objQuestion->right_answer = $requestData->input('answer');
        $objQuestion->status = $requestData->input('status');
        $objQuestion->is_deleted = 'N';
        $objQuestion->updated_at = date("Y-m-d H:i:s");
        return $objQuestion->save();
    }

    public function common_activity_user($data,$type){
        $obQuestion = Question::find($data['id']);
        if($type == 0){
            $obQuestion->is_deleted = "Y";
            $event = 'Delete Question';
        }
        if($type == 1){
            $obQuestion->status = "Y";
            $event = 'Active Question';
        }
        if($type == 2){
            $obQuestion->status = "N";
            $event = 'Deactive Question';
        }

        $obQuestion->updated_at = date("Y-m-d H:i:s");
        if($obQuestion->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'quiz/'.$currentRoute, json_encode($data), 'Question');

            return true;
        }else{
            return false ;
        }
    }

}
