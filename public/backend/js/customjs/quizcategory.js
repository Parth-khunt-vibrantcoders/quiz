var Quizcategory = function(){

    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#quiz-category-master',
            'ajaxURL': baseurl + "quiz/quiz-category-ajaxcall",
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

        $("body").on("click", ".delete-quiz-category", function() {
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
                url: baseurl + "quiz/quiz-category-ajaxcall",
                data: { 'action': 'delete-quiz-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactive-quiz-category", function() {
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
                url: baseurl + "quiz/quiz-category-ajaxcall",
                data: { 'action': 'deactive-quiz-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-quiz-category", function() {
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
                url: baseurl + "quiz/quiz-category-ajaxcall",
                data: { 'action': 'active-quiz-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_quiz_category = function(){
        $('.select2').select2();
        var form = $('#add-quiz-category');
        var rules = {
            quiz_type: {required: true},
            quiz_category: {required: true},
            status: {required: true},
        };

        var message = {
            quiz_type :{
                required : "Please select quiz type"
            },
            quiz_category :{
                required : "Please enter quiz category"
            },
            status : {
                required : "Please select status"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var edit_quiz_category = function(){
        $('.select2').select2();
        var form = $('#edit-quiz-category');
        var rules = {
            editId: {required: true},
            quiz_type: {required: true},
            quiz_category: {required: true},
            status: {required: true},
        };

        var message = {
            editId:{
                required : "Please enter quiz category id"
            },
            quiz_type :{
                required : "Please select quiz type"
            },
            quiz_category :{
                required : "Please enter quiz category"
            },
            status : {
                required : "Please select status"
            }
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
            add_quiz_category();
        },
        edit:function(){
            edit_quiz_category();
        }
    }
}();
