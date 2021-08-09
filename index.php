<?php

use App\Bpmn\App;
use App\Bpmn\Requests\ProcessRequest;
require 'bpmn/App.php';

class Action
{
    public function __construct()
    {
        $this->app = new App();
        $process = $this->app->processDefination->startProcess([
                        'key' => 'sms-mail',
                        'tenant-id' => 'send-sms'
                    ], function () {
                        $request = new ProcessRequest();
                        $request->setBusinessKey('bpmn_run_');
                        $request->setVariable('Test', 'test');
                        $request->setVariable('Test2', 'test 2');
                        $request->setWithVariablesInReturn(true);

                        return $request;
                    }); 
        
        // echo json_encode($process);
        $this->app->externelTask->getExternalTask($process);
        // $this->app->externelTask->getExternalTask('ece2753f-f8e7-11eb-8a7c-18602482400d');
    }
}

$action = new Action();

?>