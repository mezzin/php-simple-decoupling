<?php
namespace SimpleDecoupling;
//require_once dirname(__FILE__) . '/SimpleDecouplingException.php';


class SimpleDecoupling {
    private $_config;
    
    function __construct(){
    }
    
    protected function _senddata($url,$postData = null,$header = null,$method = "get"){
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
    
    protected function _createDataEnvelope($type,$method,$endpoint,$header,$param,$data, $compression = "none"){
        $envelope = new \stdClass();
        $envelope->type = $type;
        $envelope->endpoint = $endpoint;
        $envelope->method = $method;
        if($header != null){
            $envelope->header = $header;
        }
        switch($compression) {
            case true:
            case "gzcompress":
                $envelope->compression = "gzcompress";
                $envelope->data = base64_encode(gzcompress($data));
                break;
            default:
                $envelope->compression = "none";
                $envelope->data = $data;
                break;
        }
        return $envelope;
    }
    
    protected function _readDataEnvelope($dataEnvelope){
        $envelope = json_decode($dataEnvelope);
        switch($envelope->compression) {
            case "gzcompress":
                $envelope->data = gzuncompress(base64_decode($envelope->data));
                break;
            default:
                break;
        }
        return $envelope;
    }
    
    public function send($type,$method,$endpoint,$header,$param,$data, $compression = "none"){
        return $this->_createDataEnvelope($type,$method,$endpoint,$header,$param,$data, $compression);
    }
    
    
    
    
    
    
}