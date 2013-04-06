<?php
namespace SimpleDecoupling\Common; 

class Common {
    public static function createEnvelope($type,$endpoint,$param,$payload, $compression = "none"){
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
    
?>