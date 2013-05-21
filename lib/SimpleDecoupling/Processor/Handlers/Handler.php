<?php
namespace SimpleDecoupling\Processor\Handlers;

class Handler  {
    // envelope reader...
    public function process($message){
        echo exec($message->data);
    }
}