var Bgimage = function(){

    var image = function (){
        var form = $('#landing-page-image');
        var rules = {
            editId: {required: true},
            image: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    var res_image = function (){
        var form = $('#res-page-image');
        var rules = {
            editId: {required: true},
            image: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        init:function(){
            image();
        },
        result:function(){
            res_image();
        }
    }
}();
