var Question = function(){

    var list = function (){
        // question-answer
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#question-answer',
            'ajaxURL': baseurl + "landing-page/landing-page-question-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0,3],
            'noSearchApply': [0,3],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".deletequestion", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var quizid = $('#quiz_id').val();
            var data = { id: id,quizid:quizid, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "landing-page/landing-page-question-ajaxcall",
                data: { 'action': 'deletequestion', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactivedeletequestion", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure-deactive:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-deactive', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "landing-page/landing-page-question-ajaxcall",
                data: { 'action': 'deactivedeletequestion', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".activedeletequestion", function() {
            var id = $(this).data('id');

            setTimeout(function() {
                $('.yes-sure-active:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-active', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "landing-page/landing-page-question-ajaxcall",
                data: { 'action': 'activedeletequestion', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

    }

    var addQuestion = function(){
        var form = $('#add-question');
        var rules = {
            question: {required: true},
            answer1: {required: true},
            answer2: {required: true},
            answer3: {required: true},
            answer4: {required: true},
            answer: {required: true},
        };

        var message = {
            question :{
                required : "Please enter question   "
            },
            answer1 : {
                required : "Please enter answer1"
            },
            answer2 : {
                required : "Please enter answer2"
            },
            answer3 : {
                required : "Please enter answer3"
            },
            answer4 : {
                required : "Please enter answer4"
            },
            answer : {
                required : "Please select correct answer"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });

    }

    var editQuestion = function(){
        var form = $('#edit-question');
        var rules = {
            question: {required: true},
            answer1: {required: true},
            answer2: {required: true},
            answer3: {required: true},
            answer4: {required: true},
            answer: {required: true},
        };

        var message = {
            question :{
                required : "Please enter question   "
            },
            answer1 : {
                required : "Please enter answer1"
            },
            answer2 : {
                required : "Please enter answer2"
            },
            answer3 : {
                required : "Please enter answer3"
            },
            answer4 : {
                required : "Please enter answer4"
            },
            answer : {
                required : "Please select correct answer"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });

    }

    return {
        init:function(){
            list();
        },
        add:function(){
            addQuestion();
        },
        edit:function(){
            editQuestion();
        },
    }
}();
