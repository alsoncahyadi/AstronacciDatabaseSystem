<?php

namespace App\Http;

class QueryModifier {
    private static $master_table_name = "master_clients";
    private static $query_view_CAT = " SELECT * 
                                FROM master_clients
                                INNER JOIN cats 
                                ON cats.master_id = master_clients.master_id";


    public static function queryViewCAT($json_filter, $json_sort) {
        
        $query = array('text' => self::$query_view_CAT,
                        'variables' => array());
        $query = self::addFilterSubquery_2($query, $json_filter);
        $query = self::addSortSubquery($query, $json_sort, 'cats');
        // echo($query_x['text']);
        dd($query);

        return $query;
    }

    public static function addFilterSubquery_2($query, $json_filter) {
        $filter = json_decode($json_filter, true);
        if (empty($filter)) {
            return $query;
        }

        // add 'where' of query
        $query['text'] = $query['text'].' WHERE ';        
        $is_first = True;

        foreach ($filter as $key_filter => $values_filter) {
            if (!$is_first) {
                $query['text'] = $query['text']." and ";
            }
            $idx_filter = 0;
            $query['text'] = $query['text'].'(';

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
                    $variable_name = "filter".$idx_value;
                    $query['text'] = $query['text']."MONTH(".$key_filter.")"." = :".$variable_name."";
                    $query['variables'][$variable_name] = $value_filter;
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query['text'] = $query['text']." or ";
                    }   
                 }
            } else {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $variable_name = "filter".$idx_value;
                    $query['text'] = $query['text'].$key_filter." = :".$variable_name."";
                    $query['variables'][$variable_name] = $value_filter;
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query['text'] = $query['text']." or ";
                    }
                 }
            }
            $query['text'] = $query['text'].')';
            $is_first = false;
        }   

        // get result
        return $query;
    }


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
            $query['text'] = $query['text']." ORDER BY ".$created_at;
            return $query;
        }
        
        $subquery = " ORDER BY ";
        $idx_sort = 0;
        foreach ($sort as $key_sort => $value_sort) {
            $variable_name = 'sort'.$idx_sort;
            if ($value_sort == true) {
                $subquery = $subquery.':'.$variable_name." ASC";            
            } else {
                $subquery = $subquery.':'.$variable_name." DESC";                            
            }
            $subquery = $subquery.", ";
            $idx_sort = $idx_sort + 1;
            $query['variables'][$variable_name] = $key_sort;
        }
        $subquery = $subquery.$created_at;

        $query['text'] = $query['text'].$subquery;
        dd($query);
        return $query;
    }
} 

?>