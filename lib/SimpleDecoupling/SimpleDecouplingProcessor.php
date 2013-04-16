<?php
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';


class SimpleDecouplingProcessor extends SimpleDecoupling {
    private $_processor;
    
    function __construct($processor){
        $this->_processor = $processor;
    }
    
    public function process(){
        $data = $this->_processor->process();
        if($data != null){
            $envelope = $this->_readDataEnvelope($data);
            //$envelope = json_decode($envelope);
            print_r($envelope);
        }
    }
    
}