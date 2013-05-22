<?php
namespace SimpleDecoupling\Processor\Handlers;

class SystemHandler extends Handler  {
    function __construct(){
        
    }
    
    public function process($message){
        echo date("Y-m-d H:i:s") . " Execute the script: " . $message->data . "\n";
        $outputString =  exec($message->data,$output,$returnVar);
        if($returnVar>0){
            throw new Exception("Exec failled with return value $returnVar while executing $message->data the last message $outputString");
        }
        echo date("Y-m-d H:i:s") . " Done: $outputString\n";
    }
    
}
