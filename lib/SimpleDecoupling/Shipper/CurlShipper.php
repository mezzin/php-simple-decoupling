<?php
/* 
 * @copyright Justin Kieft
 * @license MIT License (see LICENSE.md) 
 */
namespace SimpleDecoupling\Shipper;

class CurlShipper extends Shipper {
    private $_awsKey;
    private $_awsSecretKey;
    private $_endPoint;
    private $_sqs;
    
    function __construct($endPoint){
        $this->_endPoint = $endPoint;
    }
    
    function ship($message){
        //$response = $this->_sqs->send_message($this->_queueUrl, $message);
        //print_r(json_decode(json_encode($response)));
        //echo $this->_queueUrl;
    }
}
