<?php
namespace App\Helpers;

class Transformer {
    public static function dateToBank($date){
        return empty($date) ?
                NULL :
                implode( '-', array_reverse( explode( '/', $date ) ) );
    }

    public static function dateToView($date){
        return empty($date) ?
                NULL :
                implode( '/', array_reverse( explode( '-', $date ) ) );
    }
}
