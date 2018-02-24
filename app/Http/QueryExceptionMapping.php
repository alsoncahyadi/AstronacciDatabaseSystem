<?php

namespace App\Http;

class QueryExceptionMapping {
    public static function mapQueryException($raw_exception, $line) {
        $msg = preg_split('/\s+/', $raw_exception); 

        if ($msg[4] == '1048') { # column cannot be null
            $column = $msg[6];
            $friendly_message = "In line {$line}, column {$column} cannot be empty.";
        } else if ($msg[4] == '1062') { # duplicate key
            $column = $msg[7];
            $friendly_message = "In line {$line}, value {$column} already in database and must be unique.";
        } else { 
            $friendly_message = $raw_exception;
        }

        return collect(array('msg' => $friendly_message, 'ex'=> $raw_exception, 'line' => $line));
    }
} 

?>