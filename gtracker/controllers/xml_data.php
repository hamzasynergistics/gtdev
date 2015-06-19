<?php
        
//        $url = "http://aksols.com/API/GT/Data.php?cur1=USD&cur2=AED&cur3=GBP&cur4=YER&cur5=AFN";
        $url = "http://aksols.com/API/GT/Data.php?cur1=AED";
        $xml = simplexml_load_file($url);
        
//        print_r($xml);
        
        echo $xml->Gold[0]->ASK;
        
//        foreach($xml->Gold as $row){
//            
//            echo $row->Currency;
//        }
        

?>