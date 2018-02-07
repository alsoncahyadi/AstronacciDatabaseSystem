<?php

namespace App;

class MonthDropdownValidator {
    public static function is_month($parameter) {
        $months_name = array('January', 'February', 'March', 'April', 
                'May', 'June', 'July', 'August', 'September', 'October', 'November', 
                'December');
        if (in_array($parameter, $months_name)) {
            return True;
        } else {
            return False;
        }

    }
} 

?>