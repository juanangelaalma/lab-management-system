<?php


if(!function_exists('timestamp_to_indo_date')){
  function timestamp_to_indo_date($date) {
    $current_date = date('Y-m-d', strtotime($date));

    $months = array (1 =>   'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agust',
        'Sept',
        'Okt',
        'Nov',
        'Des'
    );

    $split = explode('-', $current_date);
    return $split[2] . ' ' . $months[ (int)$split[1] ] . ' ' . $split[0];
  }
}