var Partnerus = function(){

    var check_form = function(){
        var form = $('#contactForm');
        var rules = {
            name: "required",
            subject: "required",
            email: {
                required: true,
                email: true
            },
            message: {
                required: true,
                minlength: 5
            }
        };

        handleFormValidate(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        init:function(){
            check_form();
        }
    }
}();
