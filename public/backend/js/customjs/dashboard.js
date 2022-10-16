var  Dashboard = function(){
    var dash= function(){
        var places = new google.maps.places.Autocomplete(document.getElementById('get_api_details'));

        google.maps.event.addListener(places, 'place_changed', function() {

            // exit;
            var place = places.getPlace();
            var address = place.formatted_address;

        $(".txtPostalCode,.txtState,.txtCountry,.txtCity").removeAttr('readonly');
        $(".txtPostalCode,.txtState,.txtCountry,.txtCity").val('');
            console.log(place);

        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        if (latitude != '') {
            $(".latitude").val(latitude);
            $(".latitude").attr('readonly', 'readonly').focus();
        }
        if (longitude != '') {
            $(".longitude").val(longitude);
            $(".longitude").attr('readonly', 'readonly').focus();
        }
    });

        var form = $('#business-detail');
        var rules = {
            business_name : {required: true},
            business_number : {required: true},
            business_address : {required: true},
            business_email: {required: true,email:true},
        };

        var message = {
            business_name : {required: "Please enter your business name"},
            business_number : {required: "Please enter your business phone number"},
            business_address : {required: "Please enter your business address"},
            business_email :{
                required : "Please enter your business email address",
                email: "Please enter valid email address"
            },

        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var update = function(){
        var form = $('#update-profile');
        var rules = {
            first_name : {required: true},
            last_name : {required: true},
            email: {required: true,email:true},
        };

        var message = {
            first_name : {required: "Please enter your first name"},
            last_name : {required: "Please enter your last name"},
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },

        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var password = function(){
        var form = $('#change-password');
        var rules = {
            old_password: {required: true},
            new_password: {required: true},
            new_confirm_password: {required: true,equalTo: "#password"},

        };

        var message = {
            old_password: {required: "Please enter your password"},
            new_password: {required: "Please enter your new password"},
            new_confirm_password: {
                required: "Please enter confirm password",
                equalTo: "New Password and confirmn password not match"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init:function(){
            dash();
        },
        edit_profile:function(){
            update();
        },
        change_password:function(){
            password();
        }
    }
}();
