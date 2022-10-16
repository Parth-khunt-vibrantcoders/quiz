var Dashboard = function(){

    var edit_profile = function (){
        var form = $('#edit-profile');
        var rules = {
            editId: {required: true},
            first_name: {required: true},
            last_name: {required: true},
            email: {required: true,email:true},
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    var ch_password = function (){
        var form = $('#change-password');
        var rules = {
            editId: {required: true},
            old_password: {required: true},
            new_password: {required: true},
            confirm_password: {required: true,equalTo: "#new_password"},

        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        edit:function(){
            edit_profile();
        },
        changepassword : function(){
            ch_password();
        },
    }
}();
