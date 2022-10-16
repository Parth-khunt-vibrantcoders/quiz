var Feedback_type = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#feedback-type-list',
            'ajaxURL': baseurl + "admin/feedback-type-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 4],
            'noSearchApply': [0, 4],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-feedback-type", function() {
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
                url: baseurl + "admin/feedback-type-ajaxcall",
                data: { 'action': 'delete-feedback-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".deactive-feedback-type", function() {
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
                url: baseurl + "admin/feedback-type-ajaxcall",
                data: { 'action': 'deactive-feedback-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-feedback-type", function() {
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
                url: baseurl + "admin/feedback-type-ajaxcall",
                data: { 'action': 'active-feedback-type', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_feedback_type = function(){
        $('.select2').select2();

        var form = $('#add-feedback-type');
        var rules = {
            industry_id: {required: true},
            feedback_type: {required: true},

        };

        var message = {
            industry_id :{
                required : "Please select industry",
            },
            feedback_type :{
                required : "Please enter feedback type",
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var edit_feedback_type = function(){
        $('.select2').select2();

        var form = $('#edit-feedback-type');
        var rules = {
            industry_id: {required: true},
            feedback_type: {required: true},

        };

        var message = {
            industry_id :{
                required : "Please select industry",
            },
            feedback_type :{
                required : "Please enter feedback type",
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return{
        init: function(){
            list();
        },
        add: function(){
            add_feedback_type();
        },
        edit: function(){
            edit_feedback_type();
        }
    }
}();
