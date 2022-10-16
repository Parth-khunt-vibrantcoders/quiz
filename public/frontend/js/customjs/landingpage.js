var Landingpage = function(){
    var question = function(){
        $("body").on('change', '.answer-btn', function(){
            var value = $(this).val();
            var adid = $("#adid").val();

            var question_no = $(this).attr('data-question');
            var correct_ans = $("#question"+question_no).val();

            // if(correct_ans == value){
            //     $(this).closest('.answerui').addClass('right-ans');
            // }else{
            //     $(this).closest('.answerui').addClass('wrong-ans');
            // }
            $(this).closest('.answerui').addClass('right-ans');

            // var correct_ans_id =  'right_answer'+question_no;

            // $("#"+correct_ans_id).closest('.answerui').addClass('right-ans');

            if(question_no != 2){
                setTimeout(function() {
                    $("#question_answer"+question_no).delay(1000).addClass('hidden');
                    $("#question_answer"+ parseInt(parseInt(question_no)+1)).delay(1000).removeClass('hidden');
                }, 1000);
            }else{
                setTimeout(function() {
                    window.location.href = baseurl + "quiz-start?id=" + adid;
                }, 1000);
            }
        });
    }
    return {
        init:function(){
            question();
        }
    }
}();
