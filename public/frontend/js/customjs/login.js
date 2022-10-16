var Login = function(){

    var logincheck = function(){
        var form = $('#user-login');
        var rules = {
            email: {required: true,email:true},
            password: {required: true},
        };

        var message = {
            email :{
                required : "Please enter your email.",
                email: "Please enter valid email."
            },
            password : {
                required : "Please enter password."
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        init:function(){
            logincheck();
        }
    }
}();
