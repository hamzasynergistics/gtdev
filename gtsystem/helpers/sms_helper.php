<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
       ********************************************************************************
       ********************************************************************************
       ****                    S M S  A P I        (SendSMS.pk)                    ****
       ********************************************************************************
       ********************************************************************************
       ****              Developer:                   Danial (Dee Jay')            ****
       ****              Personal Website:            http://www.dj.com.pk         ****
       ****              Official Website:            http://www.RedMutex.com      ****
       ****              Product:                     http://www.SendSMS.pk        ****
       ****              Support Email:               admin@SendSMS.pk             ****
       ****              Help Line:                   +923333560511/+97333310892   ****
       ****              Date:                        31/01/2011                   ****
       ****              Description:                                              ****
       ****                 This sms API is developed to work with SendSMS.pk.     ****
       ****                 Currently the website is offering to send free sms     ****
       ****                 in Pakistan only. Please check your SMS API Key before ****
       ****                 you start using this API.                              ****
       ****                                                                        ****
       ****      By Using this SMS API, you agree to abide by the conditions       ****
       ****      of SendSMS.pk and RED MUTEX. SendSMS.pk and RED MUTEX             ****
       ****      reserves the right to suspend or completly ban your activity      ****
       ****      on the products of RED MUTEX.                                     ****
       ****      CopyRights:                RED MUTEX(c)2007-2013, Pakistan        ****
       ********************************************************************************
       ********************************************************************************
*/

class sendsmsdotpk{
       
/*
       ********************************************************************************
       ****                                   Private Variables for API's use                                          ****
       ********************************************************************************
*/
       
       private $apikey;
       private $apiUrl = "http://api.SendSMS.pk/";
/*
       ********************************************************************************
*/       
/*
       ********************************************************************************
       ****                                   Public Functions for APP's use                                          ****
       ********************************************************************************
*/       
       /*              ****              Deafult Constructor                     ****       */
       function sendsmsdotpk($ak){
              $this->apikey = $ak;
       }
       
       /*              ****              Check Validity of the API KEY                     ****       */
       function isValid(){
              $response = $this->fetch_url( $this->api_url("isValid") );
              $obj=json_decode($response);
              if ($obj->isvalid == "Valid")
                     return 1;
              return 0;
       }
       
       /*              ****              Get Messages from Inbox                     ****       */
       function getInbox(){
              $response = $this->fetch_url( $this->api_url("inbox") );
              return json_decode($response);
       }
       
       /*              ****              Get Messages from Outbox                     ****       */
       function getOutbox(){
              $response = $this->fetch_url( $this->api_url("outbox") );
              return json_decode($response);
       }
       /*              ****              Send SMS                     ****       
              Accepts 
              $phone; example 03001234567
              $msg; of max 300 characters
              $tyoe; 0 for regular and 1 for flash sms
       */
       function sendsms($phone, $msg, $type = 0, $sender){
              if (strlen($phone)!=11 || substr($phone, 0, 2) != "03"){
                     $data['error'] = "Phone number you entered is not valid. It should be of 11 characters like 03451234567";
                     return false;
              }
              $msg = wordwrap($msg, 300);              //not more than 300 characters
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $this->api_url("sendsms")); 
              curl_setopt($ch, CURLOPT_FAILONERROR, 1);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1); 
              curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=$phone&msg=$msg&type=$type&sender=$sender");
              $result = curl_exec($ch);
              curl_close($ch);
              return $result;
       }
/*
       ********************************************************************************
*/       
/*
       ********************************************************************************
       ****                                   Private Functions for API's use                                          ****
       ********************************************************************************
*/
       /*              ****              Make An API URL                     ****       */
       private function api_url($u){
              return $this->apiUrl . $u . "/" . $this->apikey . ".json";
       }
       /*              ****              CUrl based fetching                     ****       */
       private function fetch_url($url){           
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url); 
              curl_setopt($ch, CURLOPT_FAILONERROR, 1);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              //curl_setopt($ch, CURLOPT_POST, 1); 
              //curl_setopt($ch, CURLOPT_POSTFIELDS, "a=384gt8gh&p=$phone&m=$msg");
              $result = curl_exec($ch);
              curl_close($ch);
              return $result;
       }
/*
       ********************************************************************************
*/

}

?>