var Cms = function(){

    $(window).on('load', function() {
        CKEDITOR.replace('content');
    });
    var privacy_policy = function(){

        var form = $('#privacy-policy');
        var rules = {
            editId: {required: true},
            // content: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            handleAjaxFormSubmit(form,true);
        });
    }

    var quiz_rules = function(){

        var form = $('#quiz-rules');
        var rules = {
            editId: {required: true},
            // content: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            handleAjaxFormSubmit(form,true);
        });
    }
    var terms_conditions = function(){

        var form = $('#terms-conditions');
        var rules = {
            editId: {required: true},
            // content: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            handleAjaxFormSubmit(form,true);
        });
    }
    var contact_us = function(){

        var form = $('#contact-us');
        var rules = {
            editId: {required: true},
            // content: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        privacypolicy:function(){
            privacy_policy();
        },
        quizrules:function(){
            quiz_rules();
        },
        termsconditions:function(){
            terms_conditions();
        },
        contactus:function(){
            contact_us()
        }
    }
}();
