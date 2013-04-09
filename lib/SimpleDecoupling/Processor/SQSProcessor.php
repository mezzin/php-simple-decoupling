<?php
namespace SimpleDecoupling\Processor;

require_once("AWSSDKforPHP/sdk.class.php");

class SQSProcessor extends Processor {
    // pull from SQS
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
    
    private function _pop(){
        $response = $this->_sqs->receive_message($this->_queueUrl);
        if ((bool) $response->body->Message()) {
            return (string) $response->body->Body(0);
        } else {
            return NULL;
        }
    }
    
    function process(){
        return $this->_pop();
    }
}