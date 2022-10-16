var Mcc_detail = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#mcc-list',
            'ajaxURL': baseurl + "admin/mcc-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }

    var importdata = function(){
        var form = $('#add-import-subscriber');
        var rules = {
            file: {required: true},
        };
        var message = {
            file : {
                required : "Please select excel sheet"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        importdata: function(){
            importdata();
        },
        init: function(){
            list();
        }
    }
}();

