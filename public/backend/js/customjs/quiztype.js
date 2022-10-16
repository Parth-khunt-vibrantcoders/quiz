var Quiztype = function(){

    var list = function(){

        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#quiz-type-master',
            'ajaxURL': baseurl + "quiz/quiz-type-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0,3],
            'noSearchApply': [0,3],
            'defaultSortColumn': [3],
            'defaultSortOrder': 'ASC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-quiz-type", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "quiz/quiz-type-ajaxcall",
                data: { 'action': 'delete-quiz-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactive-quiz-type", function() {
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
                url: baseurl + "quiz/quiz-type-ajaxcall",
                data: { 'action': 'deactive-quiz-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-quiz-type", function() {
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
                url: baseurl + "quiz/quiz-type-ajaxcall",
                data: { 'action': 'active-quiz-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

     var add_quiz_type = function(){
        $('.select2').select2();
        var form = $('#add-quiz-type');
        var rules = {
            quiz_type: {required: true},
            status: {required: true},
        };

        var message = {
            quiz_type :{
                required : "Please enter quiz type"
            },
            quiz_priority :{
                required : "Please enter quiz priority"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var edit_quiz_type = function(){
        $('.select2').select2();
        var form = $('#edit-quiz-type');
        var rules = {
            editId: {required: true},
            quiz_type: {required: true},
            status: {required: true},
        };

        var message = {
            editId:{
                required : "Please enter quiz type id"
            },
            quiz_type :{
                required : "Please enter quiz type"
            },
            quiz_priority :{
                required : "Please enter quiz priority"
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
            add_quiz_type();
        },
        edit:function(){
            edit_quiz_type();
        }
    }
}();
