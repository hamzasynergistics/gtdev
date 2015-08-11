<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Gold extends CI_Controller {

  public function __construct() {

    parent::__construct();

    $this->load->model('Gold_model');
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  
  public function index()
  {
    $result['graph'] = $this->Gold_model->getGraphRates();
    $this->load->view('includes/header');      
    $this->load->view('index', $result);     
    $this->load->view('includes/footer');      
  }
  
  
  public function xmlDataLoad(){
    //        $url = "http://aksols.com/API/GT/Data.php?cur1=USD&cur2=AED&cur3=GBP&cur4=YER&cur5=AFN";
//            $xml = simplexml_load_file($url);
            
        $urlG = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=GoldJBAO";
        $urlS = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=SilverJBAO";
        $urlP = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=PlatinumJBAO";
        
        $jsonG = file_get_contents($urlG);
        $jsonS = file_get_contents($urlS);
        $jsonP = file_get_contents($urlP);
        $g = json_decode($jsonG);
        $s = json_decode($jsonS);
        $p = json_decode($jsonP);
       
        $data = array(
            'gold_ask'   => $g->GoldPrice->USD->ask,
            'gold_bid'   => $g->GoldPrice->USD->bid,
            'silver_ask' => $s->SilverPrice->USD->ask,
            'silver_bid' => $s->SilverPrice->USD->bid,
            'plat_ask'   => $p->PlatinumPrice->USD->ask,
            'plat_bid'   => $p->PlatinumPrice->USD->bid,
            'created_date'   => date('Y-m-d')
        );
        
        if (!empty($_GET['cron'])){
            $this->Gold_model->addGraphRates($g->GoldPrice->USD->ask, $s->SilverPrice->USD->ask, $p->PlatinumPrice->USD->ask);
            exit;
        }
        
        echo json_encode($data);
    }
  
  public function xmlData(){
        $unit = $_POST['unit'];
        $curr = $_POST['curr'];
        
        $urlG = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=GoldJBAO";
        $urlS = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=SilverJBAO";
        $urlP = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=PlatinumJBAO";
        
        $jsonG = file_get_contents($urlG);
        $jsonS = file_get_contents($urlS);
        $jsonP = file_get_contents($urlP);
        $g = json_decode($jsonG);
        $s = json_decode($jsonS);
        $p = json_decode($jsonP);
        
        $url2="http://openexchangerates.org/api/latest.json?app_id=ee89b65276fa47d7ae6d12d6606d7590";
        $json2 = file_get_contents($url2);
        $j2 = json_decode($json2);    
        $currency = $j2->rates->$curr;
        
        if($unit == 'g'){
            $wt = $_POST['weight'] / 28.35;
        }else if($unit == 'kg'){
            $wt = $_POST['weight'] / 28.35 * 1000;
        }else if($unit == 'tola'){
            $wt = $_POST['weight'] * 3.75;
        }else{
            $wt = $_POST['weight'] * 1;
        }
//        echo ($g->GoldPrice->USD->ask .'*'. $currency * $wt).'---'.$g->GoldPrice->USD->ask * $currency * $wt;
//            die;

        $data = array(
            'gold_ask'   => $g->GoldPrice->USD->ask * $currency * $wt,
            'gold_bid'   => $g->GoldPrice->USD->bid * $currency * $wt,
            'silver_ask' => $s->SilverPrice->USD->ask * $currency * $wt,
            'silver_bid' => $s->SilverPrice->USD->bid * $currency * $wt,
            'plat_ask'   => $p->PlatinumPrice->USD->ask * $currency * $wt,
            'plat_bid'   => $p->PlatinumPrice->USD->bid * $currency * $wt
        );
        echo json_encode($data);}        
    
    
//  public function xmlData(){
//        $met  = $_POST['metal'];
//        $unit = $_POST['unit'];
//        $curr = $_POST['curr'];
//        $type = $met."Price";
//
////        $url = "http://aksols.com/API/GT/Data.php?cur1=".$_POST['curr'];
////        $xml = simplexml_load_file($url);
//        
//        // get Rates
//        $url1 = "http://xml.dgcsc.org/xml.cfm?password=205A870A8BCADBE8C7EC18B8EF12CB4A7EB88239&action=".$met."JBAO";
//        
//        // Convert to selected Currency
//        $url2="http://openexchangerates.org/api/latest.json?app_id=ee89b65276fa47d7ae6d12d6606d7590";
//        
//        $json1 = file_get_contents($url1);
//        $json2 = file_get_contents($url2);
//        $j1 = json_decode($json1);
//        $j2 = json_decode($json2);
//        
//        if($unit == 'g'){
//            echo $j1->$type->USD->ask * $j2->rates->$curr * (28.35 * $_POST['weight']);                
//        }else if($unit == 'kg'){
//            echo $j1->$type->USD->ask * $j2->rates->$curr * (28.35 * $_POST['weight']) / 1000;                
//        }else if($unit == 'tola'){
//            echo $j1->$type->USD->ask * $j2->rates->$curr * (0.375 * $_POST['weight']);
//        }else{
//            echo $j1->$type->USD->ask * $j2->rates->$curr * $_POST['weight'];
//        }        
//    }
    
    public function contactUs(){
        $subject = $_POST['subject'];
        $msg     = $_POST['message'];
        $from    = $_POST['email'];
        $to      = 'pk@synergistics.ae';
        
        mail($to, $subject, $msg, "From:" . $from);
         
        redirect('gold/index');
    }
    
    public function save_user(){
                
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('url', 'Website URL', 'required');

        if ($this->form_validation->run() == FALSE) {            
            $this->load->view('includes/header');
            $this->load->view('signup');
            $this->load->view('includes/footer');
        } 
        else{
            $user_data = array(
                'username' => $_POST['username'],
                'email'    => $_POST['email'],
                'address'  => $_POST['url']
            );

            $res = $this->Book_model->saveUser($user_data);
            if($res){
                $this->session->userdata('success', 'Your information hass been sent for Approval !');
                redirect('users');
            }
            else{
                $this->session->userdata('error', "Your account couldn't be created !");
                redirect('signup');                
            }                
        }
    }

    public function get_users(){
        $result['users'] = $this->Gold_model->getAllUsers();
        
        $this->load->view('includes/header');
        $this->load->view('users', $result);
        $this->load->view('includes/footer');
    } 
    
    public function update_user_status(){
        $result = $this->Gold_model->updateUserStatus($this->uri->segment(3));
        if($result != 0){
            $this->session->userdata('success', 'User Successfully Approved !');
            redirect('users');
        }
        else{
            $this->session->userdata('error', "User couldn't be Approved !");
            redirect('users');                
        }
    }
    
    public function widget_verify(){
//        $res = $this->Gold_model->checkUser($_POST['url']);
//        if($res){
            $url = "http://muslimsalat.com/daily.json?key=f42d1ffabf360f269de7bf4032baaa28";
            $j = json_decode(file_get_contents($url));

            $hijri_date = "http://www.thaghra.com/hijri_date/api.php?d=10&m=6&y=2015&month_number=1";
            $d = json_decode(file_get_contents($hijri_date));
//            $a = explode('|', $j);
            
//            echo '<pre>';
//            print_r($j); die;
            

//            echo 'Success';            
//        }else{
//            echo 'Error';
//        }
    }
    
    
    function api(){          
        $address = 'Lahore, Pakistan';
        $new_address = str_replace(" ", "+", $address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$new_address&sensor=false";
        $json = file_get_contents($url);
        $j = json_decode($json);
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        
        echo '<pre>'; print_r($j); die;
        
//        if ($mapLat == '' && $mapLong == '') {
            // Get lat long from google
            $latlong = get_lat_long('Lahore, Pakistan'); // create a function with the name "get_lat_long" given as below
            $map = explode(',', $latlong);
            echo $mapLat = $map[0];
            echo $mapLong = $map[1]; die;
//        }

// function to get  the address
        function get_lat_long($address) {

            $address = str_replace(" ", "+", $address);

            $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
            $json = json_decode($json);

            return $lat . ',' . $long;
        }

//        $this->load->view('api');
    }
    
    function graphRate(){
        
        $type = $_POST['type'];
        $metal = strtolower($type).'_rate';
        $day  = $_POST['day'];
        $cur  = $_POST['cur'];
        $unit = $_POST['unit'];
        
//        if($cur != 'USD'){
//            $url2="http://openexchangerates.org/api/latest.json?app_id=ee89b65276fa47d7ae6d12d6606d7590";
//            $json2 = file_get_contents($url2);
//            $j2 = json_decode($json2);            
//            $currency = $j2->rates->$cur;
//        }else{
//            $currency = 1;            
//        }
        
        if($unit == 'gram'){
            $wt = 28.35;            
        }else if($unit == 'kg'){
            $wt = $wt = 28.35 * 1000;;           
        }else{
            $wt = 1;
        }
        
        $graph_rates    = $this->Gold_model->getGraphRateByFilter($metal, $day);
        $currency_rates = $this->Gold_model->getCurrencyRates($day); 
        
        foreach($currency_rates as $c){
            foreach($graph_rates as $res){
                if($res['created_date'] == $c['created_date']){
                    $rates[] = round($res[$metal] * $c[$cur] * $wt, 2);
                }
            }
        }   
        
        echo json_encode($rates);
    }
    
    
    public function currency_rate(){
        $date = date('Y-m-d');
        $url ="http://openexchangerates.org/api/latest.json?app_id=ee89b65276fa47d7ae6d12d6606d7590";
        $json = file_get_contents($url);
        $j = json_decode($json);  
                       
        $query = "insert into currency_rates (";        
        foreach($j->rates as $key => $r){            
            $query.= "`".$key."`,";            
        }        
        $query.= ")";
        $field_rep = str_replace(",)", ", `created_date`)", $query);
        $field_rep.=" values (";
        foreach($j->rates as $key => $r){            
            $field_rep.= $r.",";            
        }        
        $field_rep.= ")";
        
        $new_query = str_replace(",)", ", '$date')", $field_rep);
               
        $this->Gold_model->addCurrencyRates($new_query);
    }
    
  
}