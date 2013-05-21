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
        $response = $this->_sqs->receive_message($this->_queueUrl,array(
            'VisibilityTimeout' => 43200
        ));
        if (isset($response->body->ReceiveMessageResult->Message)) {
            $message = new \stdClass;
            $message->body = json_decode((string)$response->body->ReceiveMessageResult->Message->Body);
            $message->receiptHandle = (string)$response->body->ReceiveMessageResult->Message->ReceiptHandle;
            return $message;
        } else {
            return null;
        }
    }
    
    private function _delete($receiptHandle){
        $this->_sqs->delete_message($this->_queueUrl, $receiptHandle);
    }
    
    public function process(){
        $message = $this->_pop();
        if($message!=null){
            echo "Message popped started processing...\n";
            $this->_doProcess($message->body);
            $this->_delete($message->receiptHandle);
        } else {
            echo "No message available...\n";
        }
    }
}