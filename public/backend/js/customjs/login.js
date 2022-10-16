var Login = function(){
    var validation = function(){
        var form = $('#login-form');
        var rules = {
            email: {required: true,email:true},
            password: {required: true},
        };

        var message = {
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },
            password : {
                required : "Please enter password"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        var form = $('#sign-up-form');
        var rules = {
            first_name: {required: true},
            last_name: {required: true},
            email: {required: true,email:true},
            agree: {required: true}

        };

        var message = {
            first_name : {
                required : "Please enter first name"
            },
            last_name : {
                required : "Please enter last name"
            },
            agree : {
                required : "You must accept the terms and conditions"
            },
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },

        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init:function(){
            validation();
        }
    }


}();

