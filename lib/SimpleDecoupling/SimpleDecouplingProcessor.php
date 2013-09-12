<?php
/* 
 * @copyright Justin Kieft
 * @license MIT License (see LICENSE.md) 
 */
namespace SimpleDecoupling;
require_once dirname(__FILE__) . '/SimpleDecoupling.php';


class SimpleDecouplingProcessor extends SimpleDecoupling {
    private $_processor;
    
    function __construct($processor){
        $this->_processor = $processor;
    }
    
    public function process(){
        $message = $this->_processor->process();

    }
    
}
