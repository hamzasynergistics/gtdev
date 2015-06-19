<?php

class Gold_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    // Admin Login
    function adminLogin($login_data)
    {
        $query = $this->db->get_where('admin_login', $login_data);
        return $query->row();           
    }
    
    function addGraphRates($gold, $silver, $plat){
        $cur_date = date('Y-m-d');
        $this->db->query("insert into gold_graph (gold_rate, silver_rate, platinum_rate, created_date) value ($gold, $silver, $plat, '$cur_date')");
    }
    
    function getGraphRates(){
        $query = $this->db->query("select gold_rate, `created_date`                         
                            FROM `gold_graph`
                            WHERE `created_date` >= NOW() - INTERVAL 1 DAY
                            ORDER BY graph_id DESC
                        ");
        
        return $query->result_array();
    }
    
        
    function getGraphRateByFilter($metal, $day){        
        $query = $this->db->query("SELECT `$metal`, `created_date`
                            FROM `gold_graph`
                            WHERE `created_date` >= NOW() - INTERVAL $day DAY 
                            ORDER BY graph_id DESC
                        ");
        
        return $query->result_array();
    }
    
    function getCurrencyRates($day){
        $query = $this->db->query("SELECT *
                            FROM currency_rates
                            WHERE `created_date` >= NOW() - INTERVAL $day DAY
                            ORDER BY currency_rates_id DESC
                        ");
        
        return $query->result_array();        
    }
        
    
    function addCurrencyRates($query){
        $this->db->query($query);
    }
        
    
    
}