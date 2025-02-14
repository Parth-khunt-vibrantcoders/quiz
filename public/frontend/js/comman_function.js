function getDataTableNoAjax(tableID, extraOption) {
    if (typeof extraOption === 'undefined') {
        extraOption = {};
    }
    var grid = new Datatable();
    var options = {
        src: $(tableID),
        loadingMessage: 'Loading...',
        dataTable: {
            "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'f<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
            //            "bStateSave": true,
            "lengthMenu": [
                [10, 20, 50, 100, 150, -1],
                [10, 20, 50, 100, 150, "All"]
            ],
            "pageLength": 50,
            "order": [
                [0, "asc"]
            ],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [2, 3]
            }],
            "serverSide": false,
            "ajax": null
        }
    };
    options = $.extend(true, options, extraOption);
    grid.init(options);
    return grid;
}

function getQueryString(field, url) {
    var href = url ? url : window.location.href;
    var reg = new RegExp('[?&]' + field + '=([^&#]*)', 'i');
    var string = reg.exec(href);
    return string ? string[1] : null;
}


function CKupdate() {
    for (instance in CKEDITOR.instances)
        CKEDITOR.instances[instance].updateElement();
}

if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.on('instanceCreated', function(ev) {
        CKEDITOR.dtd.$removeEmpty['a'] = 0;
    })
}

function ajaxcall(url, data, callback) {
    //  App.startPageLoading();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        async: false,
        success: function(result) {
            //   App.stopPageLoading();
            callback(result);
        }
    })
}

function handleAjaxFormSubmit(form, type) {

    if (typeof type === 'undefined') {
        ajaxcall($(form).attr('action'), $(form).serialize(), function(output) {
            handleAjaxResponse(output);
        });
    } else if (type === true) {
        // App.startPageLoading();
        var options = {
            resetForm: false, // reset the form after successful submit
            success: function(output) {
                //   App.stopPageLoading();
                handleAjaxResponse(output);
            }
        };
        $(form).ajaxSubmit(options);
    }
    return false;
}
function handleAjaxFormMySubmit(form, type) {
    $(".submitbtn:visible").attr("disabled", "disabled");
    $("#loader").show();

    if (typeof type === 'undefined') {
        ajaxcall($(form).attr('action'), $(form).serialize(), function(output) {
            handleAjaxResponse(output);
        });
    } else if (type === true) {
        // App.startPageLoading();
        var options = {
            resetForm: false, // reset the form after successful submit
            success: function(output) {
                //   App.stopPageLoading();
                handleAjaxResponse(output);
            }
        };
        $(form).ajaxSubmit(options);
    }
    return false;
}

function showToster(status, message) {
    // alert("Hello");
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    if (status == 'success') {
        toastr.success(message, 'Success');
    }
    if (status == 'error') {
        toastr.error(message, 'Fail');

    }
    if (status == 'warning') {
        toastr.warning(message, 'Warning');

    }
}

function handleAjaxResponse(output) {

    output = JSON.parse(output);
    $('#deleteModel').removeClass('show');
    $("#deleteModel").css({ 'display': 'none' });
    var html = "";




    if (output.status == 'success') {
        html = '<div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">' +
            '<div class="alert-icon">' +
            '<i class="fa fa-check-circle-o"></i>' +
            '</div>' +
            '<div class="alert-text">' + output.message + '</div>' +

            '</div>';
    }
    if (output.status == 'error') {
        html = '<div class="alert alert-custom alert-notice alert-light-danger fade show mb-5" role="alert">' +
            '<div class="alert-icon">' +
            '<i class="fa fa-close"></i>' +
            '</div>' +
            '<div class="alert-text">' + output.message + '</div>' +
            '</div>';
    }
    if (output.status == 'warning') {
        html = '<div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">' +
            '<div class="alert-icon">' +
            '<i class="fa fa-exclamation-triangle"></i>' +
            '</div>' +
            '<div class="alert-text">A simple warning alert—check it out!</div>' +
            '</div>';
    }
    $("#alertDiv").html(html);
    if (typeof output.redirect !== 'undefined' && output.redirect != '') {
        setTimeout(function() {
            window.location.href = output.redirect;
        }, 2000);
    }

    if (typeof output.jscode !== 'undefined' && output.jscode != '') {
        eval(output.jscode);
    }

}

function handleAjaxResponse(output) {

    output = JSON.parse(output);

    if (output.message != '') {
        showToster(output.status, output.message, '');
    }
    if (typeof output.redirect !== 'undefined' && output.redirect != '') {
        setTimeout(function() {
            window.location.href = output.redirect;
        }, 4000);
    }
    if (typeof output.reload !== 'undefined' && output.reload != '') {
        window.location.href = location.reload();
    }
    if (typeof output.jscode !== 'undefined' && output.jscode != '') {
        eval(output.jscode);
    }
}

function _fn_getQueryStringValue(name) {
    var regex = new RegExp("[\\?&]" + name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]") + "=([^&#]*)"),
        results = regex.exec(window.location.search);
    return results ? decodeURIComponent(results[1].replace(/\+/g, " ")) : '';
}

function handleFormValidate(form, rules, submitCallback, showToaster) {

    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: ":hidden",
        rules: rules,
        invalidHandler: function(event, validator) { //display error alert on form submit
            success.hide();
            error.show();
            //            App.scrollTo(error, -200);
            if (typeof showToaster !== 'undefined' && showToaster) {
                Toastr.init('warning', 'Some fields are missing!.', '');
            }
        },
        showErrors: function(errorMap, errorList) {
            if (typeof errorList[0] != "undefined") {
                var position = $(errorList[0].element).offset().top - 70;
                $('html, body').animate({
                    scrollTop: position
                }, 300);
            }
            this.defaultShowErrors(); // keep error messages next to each input element
        },
        highlight: function(element) { // hightlight error inputs

            $(element).closest('.input-group').addClass('has-error'); // set error class to the control group
            $(element).closest('.form-control').addClass('has-error'); // set error class to the control group

            $(element).parent().parent().find('.select2').addClass('has-error');

        },
        unhighlight: function(element) { // revert the change done by hightlight
            $(element)
                .closest('.input-group').removeClass('has-error'); // set error class to the control group
            $(element)
                .closest('.form-control').removeClass('has-error'); // set error class to the control group
            $(element)
                .closest('.input-group').removeClass('is-valid'); // set error class to the control group
        },
        success: function(label) {
            label.closest('.input-group').removeClass('has-error'); // set success class to the control group
            label.closest('.form-control').removeClass('has-error'); // set success class to the control group
            label.closest('.input-group').removeClass('is-valid'); // set error class to the control group
        },
        errorPlacement: function(error, element) {
            return true;
        },

        submitHandler: function(form) {
            $(".submitbtn:visible").attr("disabled", "disabled");
            $("#loader").show();
            // form.submit();
            if (typeof submitCallback !== 'undefined' && typeof submitCallback == 'function') {
                submitCallback(form);
            } else {
                handleAjaxFormSubmit(form);
            }
            return false;
        }
    });

    $('.select2me', form).change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
    $('.date-picker .form-control').change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    })
}

function handleFormValidateWithMsg(form, rules, messages, submitCallback, showToaster) {

    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: ":hidden",
        rules: rules,
        invalidHandler: function(event, validator) { //display error alert on form submit
            success.hide();
            error.show();

            //            App.scrollTo(error, -200);
            if (typeof showToaster !== 'undefined' && showToaster) {
                Toastr.init('warning', 'Some fields are missing!.', '');
            }
            //            Toastr.init('warning', 'Some fields are missing!.', '');
        },
        highlight: function(element) { // hightlight error inputs
            $(element)
                    .closest('.form-control').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function(element) { // revert the change done by hightlight
            $(element)
                    .closest('.form-control').removeClass('has-error'); // set error class to the control group
        },
        success: function(label) {
            label
                    .closest('.form-control').removeClass('has-error'); // set success class to the control group
        },
        messages: messages,
        submitHandler: function(form) {
            // $("#overlay").fadeIn(300);
            $('#loader').show();
            $('.btnsubmit').attr("disabled", "disabled");
            if (typeof submitCallback !== 'undefined' && typeof submitCallback == 'function') {
                submitCallback(form);
            } else {
                handleAjaxFormSubmit(form);
            }
            return false;
        },
        errorPlacement: function(error, element) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                element = $("#select2-" + elem.attr("id") + "-container").parent();
                error.insertAfter(element);
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('.select2me', form).change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
    $('.date-picker .form-control').change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    })
}

function gritter(title, text, sticky, time) {
    $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: title,
        // (string | mandatory) the text inside the notification
        text: text,
        // (string | optional) the image to display on the left
        //                    image1: './assets/img/avatar1.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: sticky,
        // (int | optional) the time you want it to be alive for before fading out
        time: time,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
    });

}

var Toastr = function() {

    return {
        //main function to initiate the module
        init: function(type, title, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"

            }
            toastr[type](message, title);
        }

    };

}();

function handleDelete() {

    $('body').on('click', '#btndelete', function() {
        var data = '';
        var thumb = $(this).attr('data-thumb');
        if (thumb) {
            data = { 'id': $(this).attr('data-id'), 'thumb': thumb };
        } else {
            data = { 'id': $(this).attr('data-id'), '_token': $("input[name=_token]").val() };
        }
        ajaxcall($(this).attr('data-url'), data, function(output) {
            $('#myModal_autocomplete').modal('hide');
            handleAjaxResponse(output);
        });
    });
}

function handleDeleteData() {

    var delete_records_value = '';
    var delete_model_name = '';
    $('body').on('click', '.delete_confirmation_btn', function() {

        var checked_value = $('input[type="checkbox"].delete_checkbox_id:checked');
        if (checked_value.length > 0) {
            delete_model_name = $(this).attr('data-model-open');
            $(delete_model_name).modal('show');
            for (var i = 0; i < checked_value.length; i++) {
                delete_records_value += $(checked_value[i]).attr('data-id');
                if (i != checked_value.length - 1) {
                    delete_records_value += ",";
                }
            }
        } else {
            Toastr.init('warning', 'Please select atleast one record', '');
        }
    });
    $('body').on('click', '#multiple_delete_btn', function() {
        var data = { 'id': delete_records_value };
        ajaxcall($(this).attr('data-url'), data, function(output) {
            $(delete_model_name).modal('hide');
            var temp_array = delete_records_value.split(',');
            for (var i = 0; i < temp_array.length; i++) {
                $('input[type="checkbox"].delete_checkbox_id[data-id="' + temp_array[i] + '"]').parents('tr').hide();
            }
            handleAjaxResponse(output);
        });
    });
}

function handleTimePickers() {

    if (jQuery().timepicker) {
        $('.timepicker-default').timepicker({
            autoclose: true,
            //showSeconds: true,
            minuteStep: 1
        });

        $('.timepicker-no-seconds').timepicker({
            autoclose: true,
            minuteStep: 5
        });

        $('.timepicker-24').timepicker({
            autoclose: true,
            minuteStep: 5,
            showSeconds: true,
            showMeridian: false
        });

        // handle input group button click
        $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e) {
            e.preventDefault();
            $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
        });
    }
}

var check_checkbox = function() {

    return {
        init: function() {
            var checked_length = $(".checkboxes:checked").length;
            var id_array = new Array();
            $('.checkboxes:checked').each(function() {
                id_array.push($(this).attr('value'));
            });
            if (checked_length != 0) {
                return id_array;
            } else {
                Toastr.init('warning', 'Opps..', 'Please Select Atleast One Checkbox');
                return false;
            }
        }
    }
}();

// Handle Sidebar toggling
$('.page-sidebar-menu li').on('click', function() {
    $('.page-sidebar-menu li:not(.open)').each(function(i) {
        $(this).find('a .arrow').removeClass('open');
        $(this).find('ul.sub-menu').hide();
    });
});
// Handle Sidebar toggling

if (getQueryString('status') != null && getQueryString('message') != null) {
    Toastr.init(getQueryString('status'), '', decodeURIComponent(getQueryString('message')));
}
if (getQueryString('redirect') != null) {
    setTimeout(function() {
        window.location.href = getQueryString('redirect');
    }, 500);
}

// Handle Checkall Table
$('body').on('click', '.checkall', function() {
    if ($(this).prop('checked')) {
        $(this).closest('.groupcheckboxes').find('.checkallone').prop('checked', true);
        $.uniform.update(".checkallone");
    } else {
        $(this).closest('.groupcheckboxes').find('.checkallone').prop('checked', false);
        $.uniform.update(".checkallone");
    }
});
// Handle Checkall Table

function fileExists(url) {
    if (url) {
        var req = new XMLHttpRequest();
        req.open('GET', url, false);
        req.send();
        return req.status == 200;
    } else {
        return false;
    }
}

//jQuery.validator.addMethod("account_no", function (value, element) {
//    return this.optional(element) || /[0-9]{2}-[0-9]{4}-[0-9]{7}-[0-9]{2}/.test(value);
//}, "Enter valid account number");


function ordinal(number) {
    number = Number(number)
    if (!number || (Math.round(number) !== number)) {
        return number
    }
    var signal = (number < 20) ? number : Number(('' + number).slice(-1))
    switch (signal) {
        case 1:
            return number + 'st'
        case 2:
            return number + 'nd'
        case 3:
            return number + 'rd'
        default:
            return number + 'th'
    }
}

$("body").on('click', '.restoreWaiting', function() {
    var bookId = $(this).attr('data-id');

    var permit = $(this).attr("data-permit");
    var reason = $("#restoreWaitingPopupReason").val();
    if (permit == "N") {
        $("#restoreWaitingPopup").modal("hide");
        return false;
    }

    ajaxcall(tutorurl + 'booking/restoreWaiting', { id: bookId, is_accept: permit, reason: reason }, function(output) {
        var res = JSON.parse(output);
        $("#restoreWaitingPopupReason").val("");
        $(".booking_restored_success").attr("data-id", bookId);

        if (res.status == "deleteDay") {
            $("#restoreWaitingPopupReason").val("day");
            $("#restoreWaitingPopup").modal("show");
        } else if (res.status == "priceChange") {
            $("#restoreWaitingPopup").modal("show");
        } else {
            handleAjaxResponse(output);
        }
    });
});


$('body').on('click', '.booking_restored', function() {
    var orderId = $(this).attr("data-id");
    var dataurlid = $(this).attr("data-url-id");

    var permit = $(this).attr("data-permit");
    var reason = $("#popupreason").val();
    if (permit == "N") {
        $("#booking_restore_popup").modal("hide");
        return false;
    }

    $("#booking_restore_popup").modal("hide");
    ajaxcall(tutorurl + 'booking/restoreBooking', { orderId: orderId, is_accept: permit, reason: reason }, function(output) {
        var res = JSON.parse(output);
        $("#popupreason").val("");
        if (res.status == "deleteDay") {
            $("#booking_restore_popup").modal("show");
            $("#popupreason").val("day");
            $(".restoreConfMsg").text("The current class had some days or fees modified, you need to make sure the fee is correct on the restored booking. You can adjust the total invoice for this booking in the order details page or make a new booking instead for this student.");

            $(".booking_restored_success").attr("data-id", orderId);
            $(".booking_restored_success").attr("data-url-id", dataurlid);

        } else if (res.status == "priceChange") {
            $("#booking_restore_popup").modal("show");
            $(".restoreConfMsg").text("The current class had some days or fees modified, you need to make sure the fee is correct on the restored booking. You can adjust the total invoice for this booking in the order details page or make a new booking instead for this student.");

            $(".booking_restored_success").attr("data-id", orderId);
            $(".booking_restored_success").attr("data-url-id", dataurlid);

        } else {
            handleAjaxResponse(output);
        }
    });
});

$('body').on('click', '.camp_restore', function() {
    var orderId = $(this).attr("data-id");
    var dataurlid = $(this).attr("data-url-id");

    ajaxcall(tutorurl + 'holiday_programme/restoreBooking', { orderId: orderId }, function(output) {
        handleAjaxResponse(output);
    });
});

$('body').on('click', '.checkContactcookie', function() {
    Cookies.set('currentLoginType', $(this).attr('data-userType'));
});

var isValidTutor = true;
var isGettingSide = false;
var notifiSecs = 1;

$('body').on('click', '.notifOpen', function() {
    if (!isGettingSide) {
        isGettingSide = true;
        ajaxcall(baseurl + 'Notification/getSideNotification', { a: 'a' }, function(output) {
            isGettingSide = false;
            output = JSON.parse(output);
            $(".sideNotifDiv").html(output.htm);
            $('body').removeClass('page-quick-sidebar-open');
            $('body').addClass('page-quick-sidebar-open');
            getNotificationCount(true);
        });
    }
});

$('body').on('click', '.notifClose', function() {
    isGettingSide = false;
    $(".sideNotifDiv").html('');
    $('body').removeClass('page-quick-sidebar-open');
});


$('#show_notification').on('hidden.bs.modal', function() {
    $(".sideNotifDiv").html('');
    $(".allNotifDiv").html('');
    $('body').removeClass('page-quick-sidebar-open');
});

function dateFormate(field) {
    $(field).datepicker({
        autoclose: true,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    });
}


function checkNonWorkingDate(field) {
    var send = true;
    $(field).datepicker({
        format: 'dd-mm-yyyy',
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    }).on("changeDate", function(e) {
        if (send) {
            var date = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/task-ajaxAction",
                data: { 'action': 'checkDate', 'date': date },
                success: function(output) {
                    handleAjaxResponse(output);
                    var output = JSON.parse(output);
                    if (typeof output.counts != 'undefined' && output.counts != null && output.counts > 0) {
                        $(field).val('');
                        $(field).focus();
                    }
                }
            });
            send = false;
        }
        setTimeout(function() { send = true; }, 200);
    });
}

/* START FOR LANGUAGE SET USING COOKIE */

//console.log(getCookie('language'));
$("body").on("change", "#languageSelection", function() {
    var lang = $(this).val();
    if (lang != '') {
        setCookie('language', lang, 365);
        window.location.reload();
    } else {
        lang = 'en';
        setCookie('language', lang, 365);
        window.location.reload();
    }
});
//    $("body").on("click", ".language",function(){
//        var lang = ($(this).attr('data-lang') !== '') ? $(this).attr('data-lang') : 'en';
//        if(lang){
//            setCookie('language', lang, 365);
//            window.location.reload();
//        }
//    });

$("body").on("change", ".language", function() {
    var lang = ($(this).val() !== '') ? $(this).val() : 'en';
    if (lang) {
        setCookie('language', lang, 365);
        window.location.reload();
    }
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/* END FOR LANGUAGE SET USING COOKIE */



/* Start manage datatable with Ajax & hide/show column dynamic */

function getDataTable(arr) {

    var dataTable = $(arr.tableID).DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "searching": true,
        "bLengthChange": true,
        "bInfo": true,
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        },
        "order": [
            [(arr.defaultSortColumn) ? arr.defaultSortColumn : '0', (arr.defaultSortOrder) ? arr.defaultSortOrder : 'desc']
        ],
        "columnDefs": [{
                "targets": arr.hideColumnList,
                "visible": false
            },
            {
                "targets": arr.noSortingApply,
                "orderable": false
            },
            {
                "targets": arr.noSearchApply,
                "searchable": false
            },
            (arr.setColumnWidth) ? arr.setColumnWidth : ''
        ],
        "ajax": {
            url: arr.ajaxURL,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: { 'action': arr.ajaxAction, 'data': arr.postData },
            error: function() { // error handling
                $(".row-list-error").html("");
                $(arr.tableID).append('<tbody class="row-list-error"><tr><td colspan="4" style="text-align: center;"><p style="color:red;">Sorry, No Record Found</p></td></tr></tbody>');
                $(arr.tableID + "processing").css("display", "none");
            }
        }
    });

    //    onLoadDefaultColumnSet(dataTable);
    //    hideShowDatatableColumn(dataTable);
}

function getDataTablenew(arr) {

    var dataTable = $(arr.tableID).DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bInfo": true,
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        },
        "order": [
            [(arr.defaultSortColumn) ? arr.defaultSortColumn : '0', (arr.defaultSortOrder) ? arr.defaultSortOrder : 'desc']
        ],
        "columnDefs": [{
                "targets": arr.hideColumnList,
                "visible": false
            },
            {
                "targets": arr.noSortingApply,
                "orderable": false
            },
            {
                "targets": arr.noSearchApply,
                "searchable": false
            },
            (arr.setColumnWidth) ? arr.setColumnWidth : ''
        ],
        "ajax": {
            url: arr.ajaxURL,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: { 'action': arr.ajaxAction, 'arraydata': arr.data, 'data': arr.postData },
            error: function() { // error handling
                $(".row-list-error").html("");
                $(arr.tableID).append('<tbody class="row-list-error"><tr><td colspan="4" style="text-align: center;"><p style="color:red;">Sorry, No Record Found</p></td></tr></tbody>');
                $(arr.tableID + "processing").css("display", "none");
            }
        }
    });

    //    onLoadDefaultColumnSet(dataTable);
    //    hideShowDatatableColumn(dataTable);
}

function onLoadDefaultColumnSet(dataTable) {
    $('.custom-column').each(function() {
        var column = dataTable.column($(this).attr('data-column'));
        var status = $(this).attr('data-default-status');

        if ($(this).is(":checked")) {
            column.visible(!column.visible());
        } else {
            column.visible(column.visible());
        }
        if (status == 'true') {
            column.visible(!column.visible());
        }
    });
}

function hideShowDatatableColumn(dataTable) {
    $('body').on('click', '.custom-column', function() {
        // Get the column API object
        var column = dataTable.column($(this).attr('data-column'));
        // Toggle the visibility
        column.visible(!column.visible());
    });
}

$(".onlyNumber").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //    $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});


$('body').on('click', '.logo', function(){
    var addid = $('#logoadd').val();
    window.location.href = baseurl + 'users/quiz-list?id=' + addid ;
});
