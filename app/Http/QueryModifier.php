<?php

namespace App\Http;

class QueryModifier {
    private static $master_table_name = "master_clients";
    private static $query_view_CAT = "SELECT * 
                                      FROM master_clients
                                      INNER JOIN cats 
                                      ON cats.master_id = master_clients.master_id";

    private static $query_view_UOB = "SELECT * 
                                      FROM master_clients 
                                      INNER JOIN uobs 
                                      ON uobs.master_id = master_clients.master_id";


    private static $query_view_AClub = 
        "SELECT *, 
        (masa_tenggang-expired_date) as bonus, 
        IF(masa_tenggang > NOW(), 'Aktif', 'Tidak Aktif') as aktif 
        FROM 
        master_clients 
        INNER JOIN aclub_informations ON master_clients.master_id = aclub_informations.master_id 
        INNER JOIN aclub_members ON master_clients.master_id = aclub_members.master_id 
        LEFT JOIN (SELECT  T1.user_id as user_id, transaction_id, payment_date, kode, status, 
                 start_date, expired_date, T1.masa_tenggang, yellow_zone, red_zone, sales_name 
                    FROM 
                        ( SELECT user_id, max(masa_tenggang) as masa_tenggang 
                            FROM aclub_transactions 
                            GROUP BY user_id) as T1 
                    INNER JOIN 
                        ( SELECT *
                           FROM aclub_transactions) as T2 
                            ON T1.user_id = T2.user_id 
                            AND T1.masa_tenggang = T2.masa_tenggang) as last_transaction 
        ON aclub_members.user_id = last_transaction.user_id ";

    private static $query_view_MRG = 
        "SELECT * 
        FROM  
        master_clients  
        INNER JOIN mrgs ON master_clients.master_id = mrgs.master_id  
        LEFT JOIN (SELECT  accounts_number, T1.master_id, account_type,  
                    sales_name, T1.created_at, updated_at, created_by, updated_by 
                    FROM  
                        ( SELECT master_id, max(created_at) as created_at  
                            FROM mrg_accounts 
                            GROUP BY master_id) as T1  
                    INNER JOIN  
                        ( SELECT * 
                           FROM mrg_accounts) as T2  
                            ON T1.master_id = T2.master_id  
                            AND T1.created_at = T2.created_at) as last_transaction  
        ON master_clients.master_id = last_transaction.master_id ";

    private static $query_view_AShop = 
        "SELECT * FROM master_clients 
        INNER JOIN (SELECT T1.master_id, transaction_id, product_type, product_name,  
                    nominal, T1.created_at, updated_at, created_by, updated_by 
                    FROM  
                        ( SELECT master_id, max(created_at) as created_at  
                            FROM ashop_transactions 
                            GROUP BY master_id) as T1  
                    INNER JOIN  
                        ( SELECT * 
                           FROM ashop_transactions) as T2  
                            ON T1.master_id = T2.master_id  
                            AND T1.created_at = T2.created_at) as last_transaction  
        ON master_clients.master_id = last_transaction.master_id ";

    private static $query_view_Green = 
        "SELECT * 
        FROM green_prospect_clients 
        LEFT JOIN (SELECT  
                    progress_id, T1.green_id as green_id, date, sales_name,  
                    status, nama_product, nominal, keterangan, created_at, updated_at 
                    FROM  
                        ( SELECT green_id, max(created_by) as created_by  
                            FROM green_prospect_progresses  
                            GROUP BY green_id) as T1  
                    INNER JOIN  
                        ( SELECT * 
                           FROM green_prospect_progresses) as T2  
                            ON T1.green_id = T2.green_id  
                            AND T1.created_by = T2.created_by) as last_transaction  
        ON green_prospect_clients.green_id = last_transaction.green_id";

    private static $query_view_master = "SELECT master_id, name, master_clients.created_at,
             IF (master_clients.master_id IN (SELECT master_id FROM cats), 1, 0) as cat,
             IF (master_clients.master_id IN (SELECT master_id FROM mrgs), 1, 0) as mrg, 
             IF (master_clients.master_id IN (SELECT master_id FROM uobs), 1, 0) as uob,
             IF (master_clients.master_id IN (SELECT DISTINCT master_id FROM aclub_members
                                              INNER JOIN aclub_transactions ON aclub_members.user_id = aclub_transactions.user_id 
                                              where LEFT(kode, 1) = 'S'), 1, 0) as stock,
             IF (master_clients.master_id IN (SELECT master_id from aclub_members 
                                              inner join aclub_transactions on aclub_members.user_id = aclub_transactions.user_id 
                                              where LEFT(kode, 1) = 'F'), 1, 0) as future 
             FROM master_clients";

    private static $query_view_master_all = "SELECT *,
             IF (master_clients.master_id IN (SELECT master_id FROM cats), 1, 0) as cat,
             IF (master_clients.master_id IN (SELECT master_id FROM mrgs), 1, 0) as mrg, 
             IF (master_clients.master_id IN (SELECT master_id FROM uobs), 1, 0) as uob,
             IF (master_clients.master_id IN (SELECT DISTINCT master_id FROM aclub_members
                                              INNER JOIN aclub_transactions ON aclub_members.user_id = aclub_transactions.user_id 
                                              where LEFT(kode, 1) = 'S'), 1, 0) as stock,
             IF (master_clients.master_id IN (SELECT master_id from aclub_members 
                                              inner join aclub_transactions on aclub_members.user_id = aclub_transactions.user_id 
                                              where LEFT(kode, 1) = 'F'), 1, 0) as future 
             FROM master_clients";


    public static function queryView($viewName, $json_filter, $json_sort) {
        if ($viewName == 'CAT') { 
            $query_text = self::$query_view_CAT;
            $sort_table_name = 'cats';
        } else if ($viewName == 'UOB') { 
            $query_text = self::$query_view_UOB;
            $sort_table_name = 'uobs';
        } else if ($viewName == 'AClub') { 
            $query_text = self::$query_view_AClub;
            $sort_table_name = 'aclub_members';
        } else if ($viewName == 'MRG') { 
            $query_text = self::$query_view_MRG;
            $sort_table_name = 'mrgs';
        } else if ($viewName == 'AShop') { 
            $query_text = self::$query_view_AShop;
            $sort_table_name = 'master_clients';
        } else if ($viewName == 'Green') { 
            $query_text = self::$query_view_Green;
            $sort_table_name = 'green_prospect_clients';
        } else if ($viewName == 'Master') { 
            $query_text = self::$query_view_master;
            $sort_table_name = 'master_clients';
        } 

        $query = array('text' => $query_text,
                        'variables' => array());
        $query = self::addFilterSubquery($query, $json_filter);
        $query = self::addSortSubquery($query, $json_sort, $sort_table_name);
        $query['text'] = $query['text'].";";

        return $query;
    }

    public static function addFilterSubquery($query, $json_filter) {
        $filter = json_decode($json_filter, true);
        if (empty($filter)) {
            return $query;
        }

        // add 'where' of query
        $query['text'] = $query['text'].' WHERE ';        
        $is_first = True;

        $idx_filter = 0;
        foreach ($filter as $key_filter => $values_filter) {
            if (!$is_first) {
                $query['text'] = $query['text']." and ";
            }

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
                    $variable_name = "filter".$idx_filter;
                    $query['text'] = $query['text']."MONTH(".$key_filter.")"." = :".$variable_name."";
                    $query['variables'][$variable_name] = $value_filter;
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query['text'] = $query['text']." or ";
                    }
                    $idx_filter = $idx_filter + 1;
                 }
            } else {
                $idx_value = 0;
                foreach ($values_filter as $value_filter) {
                    $variable_name = "filter".$idx_filter;
                    $query['text'] = $query['text'].$key_filter." = :".$variable_name."";
                    $query['variables'][$variable_name] = $value_filter;
                    $idx_value += 1;
                    if ($idx_value != count($values_filter)) {
                        $query['text'] = $query['text']." or ";
                    }
                    $idx_filter = $idx_filter + 1;
                 }
            }
            $query['text'] = $query['text'].')';
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
            if ($value_sort == true) {
                $subquery = $subquery.$key_sort." ASC";            
            } else {
                $subquery = $subquery.$key_sort." DESC";                            
            }
            $subquery = $subquery.", ";
        }
        $subquery = $subquery.$created_at;
        $query['text'] = $query['text'].$subquery;
        return $query;
    }

    public static function queryAClubClientDetailSearch($master_id, $keyword) {
        $query = "SELECT * FROM aclub_members WHERE (master_id = ".$master_id.")
        AND ( user_id like '%".$keyword."%') ";
        return $query;
    }

    public static function queryMRGClientDetailSearch($master_id, $keyword) {
        $query = "SELECT * FROM mrg_accounts 
        WHERE (master_id = ".$master_id.") AND ( accounts_number like '%".$keyword."%' 
                        OR account_type like '%".$keyword."%' OR sales_name like '%".$keyword."%')";
        return $query;        
    }

    public static function queryMasterExport() {
        return self::$query_view_master_all;
    }

    public static function queryGetTransactions($user_id) {
        $query = "SELECT * FROM aclub_transactions WHERE user_id = '".$user_id."' ORDER BY created_at DESC;";
        return $query;
    }

    public static function queryGetAclubMember($user_id) {
        $query = "SELECT * FROM aclub_members WHERE master_id = ".$user_id." ORDER BY created_at DESC";
        return $query;
    }
} 

?>