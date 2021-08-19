<?php

use Bpmn\App;
use Bpmn\Requests\ProcessRequest;
use Bpmn\Responses\ProcessResponse;

// require 'bpmn/App.php';
require './vendor/autoload.php';
class Action
{
    public function __construct()
    {
        $this->app = new App('http://camunda-platform.service.consul/engine-rest/');
        $process = $this->app->processDefination->startProcess([
            'key' => 'sms-mail',
            'tenant-id' => 'send-sms'
        ], function () {
            $request = new ProcessRequest();
            $request->setBusinessKey('bpmn_run_');
            // $request->setVariable('Test', 'test');
            // $request->setVariable('Test2', 'test 2');
            $request->setWithVariablesInReturn(true);

            return $request->iterate();
        }); 

        if ($process->code == null) {
            $this->app->externelTask->setPath('Tasks');
            $task = $this->app->externelTask->getExternalTask($process);
            echo json_encode($task);
        }
        else
        {
            echo json_encode($process);
        }
    }
}

$action = new Action();

?>