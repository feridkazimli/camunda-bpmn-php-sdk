<?php

use Bpmn\App;
use Bpmn\Requests\ProcessRequest;
use Bpmn\Responses\ProcessResponse;

// require 'bpmn/App.php';
require './Tasks/getCif.php';
require './Tasks/sendSmsApi.php';
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
            $request->setWithVariablesInReturn(true);

            return $request->iterate();
        }); 

        $this->app->externelTask->setPath('Tasks');
        $this->app->externelTask->getExternalTask($process);
        // return $task;
    }
}

$action = new Action();

?>