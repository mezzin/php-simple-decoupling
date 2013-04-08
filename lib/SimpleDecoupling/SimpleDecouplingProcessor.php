<?php
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';


class SimpleDecouplingShipper extends SimpleDecoupling {
    private $_shipper;
    
    function __construct($processor){
        $this->_shipper = $shipper;
    }
    
    public function send($type,$endpoint,$param,$data, $compression ){
        $dataEnvelope = parent::send($type,$endpoint,$param,$data, $compression);
        $this->_shipper->ship($dataEnvelope);
    }
    
    public function sendraw($message){
        $this->_shipper->ship($message);
    }
    
}