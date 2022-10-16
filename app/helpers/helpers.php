<?php

function date_formate($date){
    return date("d-M-Y", strtotime($date));
}

function date_time_formate($date){
    return date("d/m/Y h:i:s A", strtotime($date));
}


function remaing_days($start_date, $end_date){
    return abs(round((strtotime($start_date) - strtotime($end_date)) / (60 * 60 * 24)));
}

function find_date($days, $start_date){
    return date('Y-m-d', strtotime($days." day", strtotime($start_date)));
}

function ccd($value){
    echo "<pre>"; print_r($value); die();
}

function numberformat($value){
    return number_format((float)$value, Config::get('constants.DECIMAL_POINT'), '.', '');
}

?>