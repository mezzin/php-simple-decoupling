<?php
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';


class SimpleDecouplingShipper extends SimpleDecoupling {
    private $_shipper;
    
    function __construct($shipper){
        
        $this->_shipper = $shipper;
    }
    public function send($message){
        //var_dump($this->_shipper);
        $this->_shipper->ship($message);
    }
    
}