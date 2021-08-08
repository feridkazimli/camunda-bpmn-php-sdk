<?php

use App\Bpmn\App;
use App\Bpmn\Requests\ProcessRequest;
require 'bpmn/App.php';

class Action
{
    public function __construct()
    {
        $this->app = new App();
        $this->app->processDefination->startProcess([
            'key' => 'sms',
            'tenantId' => 'sms'
        ], function () {
            $request = new ProcessRequest();
            $request->setBusinessKey('sms_');
            $request->setWithVariablesInReturn(true);
            $request->setVariable('Test', 'test');
            $request->setVariable('Test2', 'test 2');

            return $request;
        }); 
    }
}

$action = new Action();

?>