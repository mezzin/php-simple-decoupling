<?php
/* 
 * @copyright Justin Kieft
 * @license MIT License (see LICENSE.md) 
 */
namespace SimpleDecoupling\Shipper;

require_once("AWSSDKforPHP/sdk.class.php");

class SQSShipper extends Shipper {
    private $_awsKey;
    private $_awsSecretKey;
    private $_queueUrl;
    private $_sqs;
    
    function __construct($awsKey,$awsSecretKey,$region,$queueUrl){
        $this->_awsKey = $awsKey;
        $this->_awsSecretKey = $awsSecretKey;
        $this->_queueUrl = $queueUrl;
        $this->_region = $region;
        $this->_sqs = new \AmazonSQS(array('key'=>$awsKey,'secret'=>$awsSecretKey));
        $this->_sqs->set_region(constant("AmazonSQS::".$region));
    }
    
    function ship($data){
        $response = $this->_sqs->send_message($this->_queueUrl, json_encode($data));
        if($response->status !=200){
            throw new ShipperException($response->body->Error->Message);
        }   
        
    }
}
