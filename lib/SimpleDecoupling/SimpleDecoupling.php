<?php
namespace SimpleDecoupling;
//require_once dirname(__FILE__) . '/SimpleDecouplingException.php';


class SimpleDecoupling {
    private $_config;
    
    function __construct($shipper){
        
        
    }
    public function send(){
       
    }
    
    
    public function createEnvelope($type,$endpoint,$param,$payload, $compression = "none"){
        $envelope = new \stdClas();
        $envelope->type = type;
        $envelope->compression = $compression;
        $envelope->endpoint = $endpoint;
        switch($compression){
            case "gzip":
                $envelope->payload = base64_encode(gzencode($payload));
                break;
            defaul:
                $envelope->payload = $payload;
        }
        return json_encode($envelope);
    }
    
}