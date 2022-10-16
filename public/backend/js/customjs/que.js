var Que = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 5,
            'tableID': '#question-list',
            'ajaxURL': baseurl + "question/admin-question-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 6],
            'noSearchApply': [0,3],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-question", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');

            var data = { id: id,  _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "question/admin-question-ajaxcall",
                data: { 'action': 'delete-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });


        $("body").on("click", ".deactive-question", function() {
            var id = $(this).data('id');

            setTimeout(function() {
                $('.yes-sure-deactive:visible').attr('data-id', id);

            }, 500);
        })

        $('body').on('click', '.yes-sure-deactive', function() {
            var id = $(this).attr('data-id');

            var data = { id: id,  _token: $('#_token').val() };
                $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "question/admin-question-ajaxcall",
                data: { 'action': 'deactive-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-question", function() {
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
                url: baseurl + "question/admin-question-ajaxcall",
                data: { 'action': 'active-question', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

    }

    var add_question = function(){
        $('.select2').select2();

        var form = $('#add-question');
        var rules = {
            quiz_type: {required: true},
            quiz_category: {required: true},
            quiz: {required: true},
            file: {required: true},
        };

        var message = {
            quiz_type : {
                required : "Please select quiz type"
            },
            quiz_category : {
                required : "Please select quiz category"
            },
            quiz : {
                required : "Please select quiz"
            },
            file : {
                required : "Please select file"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });

    }
    return{
        init:function(){
            list();
        },
        add:function(){
            add_question();
        }
    }
}();
