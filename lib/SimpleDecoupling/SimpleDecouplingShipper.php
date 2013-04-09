<?php
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';


class SimpleDecouplingShipper extends SimpleDecoupling {
    private $_shipper;
    
    function __construct($shipper){
        $this->_shipper = $shipper;
    }
    
    public function send($type,$method,$endpoint,$header,$param,$data, $compression = "none"){
        $dataEnvelope = parent::send($type,$method,$endpoint,$header,$param,$data, $compression);
        $this->_shipper->ship($dataEnvelope);
    }
    
    public function sendraw($message){
        $this->_shipper->ship($message);
    }
    
}