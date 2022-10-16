var Quiz = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#quiz-master',
            'ajaxURL': baseurl + "quiz/quiz-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 1, 6],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-quiz", function() {
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
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'delete-quiz', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactive-quiz", function() {
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
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'deactive-quiz', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-quiz", function() {
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
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'active-quiz', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_quiz = function(){
        $('.select2').select2();
        $('#time').timepicker()

        var form = $('#add-quiz');
        var rules = {
            image: {required: true},
            quiz_type: {required: true},
            quiz_category: {required: true},
            name: {required: true},
            status: {required: true},
        };

        var message = {
            image :{
                required : "Please select quiz image"
            },
            quiz_type :{
                required : "Please select quiz type"
            },
            quiz_category :{
                required : "Please select quiz category"
            },
            name :{
                required : "Please select quiz name"
            },
            status : {
                required : "Please select status"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var edit_quiz = function(){
        $('.select2').select2();
        $('#time').timepicker()

        var form = $('#edit-quiz');
        var rules = {
            quiz_type: {required: true},
            quiz_category: {required: true},
            name: {required: true},
            status: {required: true},
        };

        var message = {
            quiz_type :{
                required : "Please select quiz type"
            },
            quiz_category :{
                required : "Please select quiz category"
            },
            name :{
                required : "Please select quiz name"
            },

            status : {
                required : "Please select status"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var view_quiz = function(){
        var quiz_id = $('#quiz_id').val();
        var dataArr = {quiz_id : quiz_id};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#quiz-question-master',
            'ajaxURL': baseurl + "quiz/quiz-ajaxcall",
            'ajaxAction': 'getdatatable_question',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-question", function() {
            var id = $(this).data('id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
                $('.yes-sure:visible').attr('data-quiz-id', data_quiz_id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            var data = { id: id, data_quiz_id: data_quiz_id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'delete-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactive-question", function() {
            var id = $(this).data('id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            setTimeout(function() {
                $('.yes-sure-deactive:visible').attr('data-id', id);
                $('.yes-sure-deactive:visible').attr('data-quiz-id', data_quiz_id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-deactive', function() {
            var id = $(this).attr('data-id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            var data = { id: id, data_quiz_id: data_quiz_id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'deactive-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-question", function() {
            var id = $(this).data('id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            setTimeout(function() {
                $('.yes-sure-active:visible').attr('data-id', id);
                $('.yes-sure-active:visible').attr('data-quiz-id', data_quiz_id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-active', function() {
            var id = $(this).attr('data-id');
            var data_quiz_id = $(this).attr('data-quiz-id');
            var data = { id: id, data_quiz_id: data_quiz_id, _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "quiz/quiz-ajaxcall",
                data: { 'action': 'active-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

    }

    return{
        init:function(){
            list();
        },
        add:function(){
            add_quiz();
        },
        edit:function(){
            edit_quiz();
        },
        view:function(){
            view_quiz();
        }
    }
}();
