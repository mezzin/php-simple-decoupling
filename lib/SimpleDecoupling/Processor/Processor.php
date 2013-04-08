<?php
namespace SimpleDecoupling\Processor;

class Processor  {
    public function senddata($url,$postData = null,$method = "get"){
        $method = strtolower($method);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($method=="put") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        } else if ($method =="post") {
            curl_setopt($ch, CURLOPT_POST, 1);
        } else if ($method == "delete"){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        if($postData!=null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            $errors = array(curl_error($ch));
            echo "Error $url:\n";
            print_r($errors);
        }
        curl_close($ch);
        return $output;
    }
    
    // envelope reader...
}