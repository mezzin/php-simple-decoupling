<?php
namespace SimpleDecoupling;
//require_once dirname(__FILE__) . '/SimpleDecouplingException.php';


class SimpleDecoupling {
    private $_config;
    
    function __construct(){
        
        
    }
    
    private function _createDataEnvelope($type,$endpoint,$param,$data, $compression = "none"){
        $envelope = new \stdClass();
        $envelope->type = $type;
        $envelope->compression = $compression;
        $envelope->endpoint = $endpoint;
        switch($compression) {
            case true:
            case "gzip":
                $envelope->data = base64_encode(gzencode($data));
                break;
            default:
                $envelope->data = $payload;
                break;
        }
        return $envelope;
    }
    
    private function _readDataEnvelope($rawenvelope){
        $envelope json_decode($rawenvelope);
        
        $envelope->endpoint = $endpoint;
        switch($envelope->compression) {
            case "gzip":
                $envelope->data = base64_encode(gzencode($envelope->data));
                break;
            default:
                break;
        }
        return $envelope;
    }
    
    public function send($type,$endpoint,$param,$data, $compression = "none"){
        return $this->_createDataEnvelope($type,$endpoint,$param,$data, $compression);
    }
    
    
    
    
    
    
}