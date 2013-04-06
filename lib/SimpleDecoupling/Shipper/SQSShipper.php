<?php
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
    
    function ship($message){
        $response = $this->_sqs->send_message($this->_queueUrl, $message);
        //print_r(json_decode(json_encode($response)));
        //echo $this->_queueUrl;
    }
}
