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


  // For Index Page admin
  public function index()
  {  
    $result['graph'] = $this->Gold_model->getGraphRates();
    $this->load->view('includes/header');      
    $this->load->view('index', $result);     
    $this->load->view('includes/footer');      
  }
  
  
  public function xmlDataLoad(){
    //        $url = "http://aksols.com/API/GT/Data.php?cur1=USD&cur2=AED&cur3=GBP&cur4=YER&cur5=AFN";
            $url = "http://aksols.com/API/GT/Data.php?cur1=USD";
            $xml = simplexml_load_file($url);
            
            if(!empty($_GET['cron'])){
                $this->Gold_model->addGraphRates($xml->Gold->ASK, $xml->Silver->ASK, $xml->Plat->ASK);
                exit;
            }
            
            $a = json_encode($xml);
            print_r($a);
    }
  
  public function xmlData(){
            $met  = $_POST['metal'];
            $unit = $_POST['unit'];
            
            $url = "http://aksols.com/API/GT/Data.php?cur1=".$_POST['curr'];
            $xml = simplexml_load_file($url);
            
            if($unit == 'g'){
                echo $xml->$met->ASK * (28.35 * $_POST['weight']);                
            }else if($unit == 'kg'){
                echo $xml->$met->ASK * (28.35 * $_POST['weight']) / 1000;                
            }else if($unit == 'tola'){
                echo $xml->$met->ASK * (0.375 * $_POST['weight']);
            }else{
                echo $xml->$met->ASK * $_POST['weight'];
            }        
    }
    
    public function contactUs(){
        $subject = $_POST['subject'];
        $msg     = $_POST['message'];
        $from    = $_POST['email'];
        $to      = 'pk@synergistics.ae';
        
         mail($to, $subject, $msg, "From:" . $from);
        
//        $config_email = Array(
//                      'protocol'  => 'smtp',
//                      'smtp_host' => 'smtp.mail.yahoo.com',
//                      'smtp_port' => 465,
//                      'smtp_user' => 'hmabuzarali@yahoo.com', // change it to yours
//                      'smtp_pass' => 'HafizMAbuzar_1', // change it to yours
//                      'mailtype'  => 'html',
//                      'charset'   => 'iso-8859-1',
//                      'wordwrap'  => TRUE
//                  );
//
//        $this->load->library('email', $config_email);
//        $this->email->set_newline("\r\n");
//        $this->email->from($_POST['email']);
////        $this->email->to("info@synergistics.ae");
//        $this->email->to("hmabuzarali@yahoo.com");
//        $this->email->subject('test');
//        $this->email->message("Name : ".$_POST['username']."<br/>".$_POST['message']);
//        $this->email->send();
//        echo $this->email->print_debugger();
        

        redirect('gold/index');
//        $this->session->set_userdata('success', 'Your email has been sent !');
    }
    
    function iphone(){
//        session_start();
//        if (!isset($this->session->userdata('last_time'))) {
//            $this->session->set_userdata('last_time', date('Y-m-d h:i:s'));
//        } else {
//            $cur_date = date('Y-m-d h:i:s');
////            $cur_date = '2015-06-03 08:10:01';
//            $date1 = strtotime($this->session->userdata('last_time'));
//            $date2 = strtotime($cur_date);
//            $diff = round(abs($date1 - $date2) / (60 * 60));
//
//            if ($diff < 25) {
//                $result['graph'] = $this->Gold_model->getGraphRates();
//                $this->load->view('includes/header');
//                $this->load->view('index', $result);
//                $this->load->view('includes/footer');
//            } else {
//                $this->session->unset_userdata('last_time');
//                $this->session->set_userdata('last_time', date('Y-m-d h:i:s'));
//                $this->load->view('iphone');
//            }
            
            $this->load->view('iphone');
//        }

    }
      
 
  
}