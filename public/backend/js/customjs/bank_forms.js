var Bank_forms = function(){
    var add_form = function(){
        $('.select2').select2();

        $(".date-picker-form").datepicker({
            format: 'd-M-yyyy',
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom auto"
        });

        $('body').on('change', '.mcc_code', function() {
            var mcc_code = $(this).val();
            var data = { mcc_code: mcc_code, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl +"bank-form-ajaxcall",
                data: { 'action': 'get-mcc-title', 'data': data },
                success: function(data) {
                    output = JSON.parse(data);
                    // console.log(output);
                    $('#mcc_title').val(output[0]['title']);
                }
            });
        });

        $('body').on('focusout', '.cr_name', function() {
            var cr_name = $('#cr_name').val();
            $('#first_line').val(cr_name);

        });

        $('body').on('focusout', '.first_line', function() {
            var first_line = $('#first_line').val();
            $('#cr_name').val(first_line);

        });

        $('body').on('focusout', '.store_name', function() {
            var store_name = $('#store_name').val();
            $('#second_line').val(store_name);

        });

        $('body').on('focusout', '.second_line', function() {
            var second_line = $('#second_line').val();
            $('#store_name').val(second_line);

        });

        $('body').on('focusout', '.store_address', function() {
            var store_address = $(this).val();
            $('#third_line').val(store_address);

        });

        $('body').on('focusout', '.third_line', function() {
            var third_line = $(this).val();
            $('.store_address').val(third_line);

        });

        $('body').on('focusout', '.manager_mobile', function() {
            var manager_mobile = $(this).val();
            $('#fourth_line').val(manager_mobile);

        });

        $('body').on('focusout', '.fourth_line', function() {
            var fourth_line = $(this).val();
            $('#manager_mobile').val(fourth_line);

        });

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
        var places = new google.maps.places.Autocomplete(document.getElementById('get_apis_details'));

            google.maps.event.addListener(places, 'place_changed', function() {

            var place = places.getPlace();
            var address = place.formatted_address;

            $(".txtPostalCode,.txtState,.txtCountry,.txtCity").removeAttr('readonly');
            $(".txtPostalCode,.txtState,.txtCountry,.txtCity").val('');
                console.log(place);

            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            if (latitude != '') {
                $(".latitudes").val(latitude);
                $(".latitudes").attr('readonly', 'readonly').focus();
            }
            if (longitude != '') {
                $(".longitudes").val(longitude);
                $(".longitudes").attr('readonly', 'readonly').focus();
            }
        });

        var form = $('#merchant-detail');
        var rules = {            
            cr_name: {required: true},
            cr_number: {required: true},
            // aggregator: {required: true},
            cr_expiry_date: {required: true},
            brand_name: {required: true},
            address: {required: true},
            latitude: {required: true},
            longitude: {required: true},
            mcc_code: {required: true},
            // seasonal: {required: true},
            // incorporation_status: {required: true},
            // portal_access: {required: true},
            mcc_title: {required: true},
            total_stores: {required: true},
            total_pos: {required: true},
            note: {required: true},
            full_name: {required: true},
            position_title: {required: true},
            // telephone: {required: true},
            mobile: {required: true},
            email_statement: {required: true},
            nationality: {required: true},
            civil_id: {required: true},
            civil_expiry: {required: true},
            store_name: {required: true},
            store_address: {required: true},
            store_total_pos: {required: true},
            pos_profile: {required: true},
            // dcc_enabled: {required: true},
            first_line: {required: true},
            second_line: {required: true},
            third_line: {required: true},
            fourth_line: {required: true},
            store_manager_name: {required: true},
            store_manager_position_tile: {required: true},
            // manager_telephone: {required: true},
            manager_mobile: {required: true},
            email_pos_password: {required: true},
            local_debit_fees: {required: true},
            international_fees: {required: true},
            setup_fees: {required: true},
            monthly_fees: {required: true},
            other_fees: {required: true},
            bank_name: {required: true},
            swift_code: {required: true},
            account_name: {required: true},
            account_no: {required: true},
            month_transactions: {required: true},
            ticket_size: {required: true},
            merchant_manager_name: {required: true},
            merchant_manager_date: {required: true},
            cooardinator_name: {required: true},
            cooardinator_date: {required: true},
            supervisor_name: {required: true},
            supervisor_date: {required: true},
            existing_acquirer: {required: true},
            status: {required: true},
            
        };

        var message = {
            cr_name: {required: "Please enter CR number"},
            cr_number: {required: "Please enter CR name"},
            
            cr_expiry_date: {required: "Please enter CR expiry date"},
            brand_name: {required: "Please enter brand name"},
            address: {required: "Please enter address"},            
            mcc_code: {required: "Please select MCC code"},
            
            
            mcc_title: {required: "Please enter MCC title"},
            total_stores: {required: "Please enter total stores"},
            total_pos: {required: "Please enter total POS"},
            
            full_name: {required: "Please enter owner/authorized manager full name"},
            position_title: {required: "Please enter owner/authorized manager position title"},
            // telephone: {required: "Please enter owner/authorized manager telephone"},
            mobile: {required: "Please enter owner/authorized manager mobile"},
            email_statement: {required: "Please enter owner/authorized email statement"},
            nationality: {required: "Please select owner/authorized nationality"},
            civil_id: {required: "Please enter owner/authorized civil id"},
            civil_expiry: {required: "Please enter owner/authorized civil expiry"},

            store_name: {required: "Please enter store name"},
            store_address: {required: "Please enter store address"},
            store_total_pos: {required: "Please enter store total pos"},
            pos_profile: {required: "Please enter pos profile"},
            

            first_line: {required: "Please enter receipt details first line"},
            second_line: {required: "Please enter receipt details second line"},
            third_line: {required: "Please enter receipt details third line"},
            fourth_line: {required: "Please enter receipt details fourth line"},

            store_manager_name: {required: "Please enter store manager store manager name"},
            store_manager_position_tile: {required: "Please enter store manager store manager position tile"},
            // manager_telephone: {required: "Please enter store manager manager telephone"},
            manager_mobile: {required: "Please enter store manager manager mobile"},
            email_pos_password: {required: "Please enter store manager email pos password"},

            local_debit_fees: {required: "Please enter local debit fees"},
            international_fees: {required: "Please enter international fees"},
            setup_fees: {required: "Please enter setup fees"},
            monthly_fees: {required: "Please enter monthly fees"},
            other_fees: {required: "Please enter other fees"},

            bank_name: {required: "Please enter bank name"},
            swift_code: {required: "Please enter swift code"},
            account_name: {required: "Please enter account name"},
            account_no: {required: "Please enter account no"},

            month_transactions: {required: "Please enter month transactions"},
            ticket_size: {required: "Please enter ticket size"},

            merchant_manager_name: {required: "Please enter merchant manager name"},
            merchant_manager_date: {required: "Please enter merchant manager date"},
            cooardinator_name: {required: "Please enter cooardinator name"},
            cooardinator_date: {required: "Please enter cooardinator date"},
            supervisor_name: {required: "Please enter supervisor name"},
            supervisor_date: {required: "Please enter supervisor date"},
            existing_acquirer: {required: "Please enter existing acquirer"},
            status: {required: "Please enter existing acquirer"},
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
    }

    return {
        add: function(){
            add_form();
        }
    }
}();
