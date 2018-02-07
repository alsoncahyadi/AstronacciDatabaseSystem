<?php

namespace App\Http;

class QueryModifier {
    public static function addFilterSubquery($query, $json_filter) {
        $filter = json_decode($json_filter, true);

        if (empty($filter)) {
            return $query;
        }

        // add 'where' of query
        $query = $query.' WHERE ';        
        $is_first = true;
        foreach ($filter as $key_filter => $values_filter) {
            if (!$is_first) {
                $query = $query." and ";
            }
            $idx_filter = 0;
            $query = $query.'(';

            if (in_array($key_filter, ['birthdate', #all
            							'payment_date', #all
            							'start_date', #aclub
            							'masa_tenggang', #mrg
            							'join_date', #mrg
            							'DP_date', #cat
            							'payment_date', #cat 
            							'tanggal_opening_class', #cat
            							'tanggal_end_class', #cat
            							'tanggal_ujian',#cat
            							'tanggal_rdi_done', #uob
            							'tanggal_top_up', #uob
            							'tanggal_trading' #uob
                                        ])) {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $query = $query."MONTH(".$key_filter.")"." = '".$value_filter."'";
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query = $query." or ";
                    }   
                 }
            } else {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $query = $query.$key_filter." = '".$value_filter."'";
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query = $query." or ";
                    }
                 }
            }
            $query = $query.')';
            $is_first = false;
        }   

        // get result
        return $query;
    }

    public static function addSortSubquery($query, $json_sort, $table_name) {
        $sort = json_decode($json_sort, true);
        $created_at = $table_name.".created_at DESC";

        if (empty($sort)) {
            return $query." ORDER BY ".$created_at;
        }
        
        $subquery = " ORDER BY ";
        $idx_sort = 0;
        foreach ($sort as $key_sort => $value_sort) {
            if ($value_sort == true) {
                $subquery = $subquery.$key_sort." ASC";            
            } else {
                $subquery = $subquery.$key_sort." DESC";                            
            }
            $subquery = $subquery.", ";
        }
        $subquery = $subquery.$created_at;

        $query = $query.$subquery;
        return $query;
    }
} 

?>