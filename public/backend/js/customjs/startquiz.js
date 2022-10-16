var Startquiz = function(){

    var image = function (){

        var form = $('#start-quiz-image');
        var rules = {
            editId: {required: true},
            image: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return{
        init:function(){
            image();
        }
    }
}();
