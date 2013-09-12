<?php
/* 
 * @copyright Justin Kieft
 * @license MIT License (see LICENSE.md) 
 */
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';
require_once dirname(__FILE__) . '/Shipper/Shipper.php';


class SimpleDecouplingShipper extends SimpleDecoupling {
    private $_shipper;
    
    function __construct($shipper){
        $this->_shipper = $shipper;
    }
    
    public function send($type,$meta,$data, $compression = "none"){
        $dataEnvelope = parent::send($type,$meta,$data, $compression);
        $this->_shipper->ship($dataEnvelope);
    }
    
}
