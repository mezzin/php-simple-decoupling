<?php
/* 
 * @copyright Justin Kieft
 * @license MIT License (see LICENSE.md) 
 */
namespace SimpleDecoupling\Processor;
require_once dirname(__FILE__) . '/Handlers/Handler.php';
require_once dirname(__FILE__) . '/Handlers/SystemHandler.php';
require_once dirname(__FILE__) . '/Handlers/WebserviceHandler.php';


class Processor {
    // envelope reader...
    protected function _doProcess($message){
        $handlerClass = "SimpleDecoupling\Processor\Handlers\\".ucfirst(strtolower($message->type)) . "Handler";
        $handler = new $handlerClass;
        return $handler->process($message);
    
    }
}