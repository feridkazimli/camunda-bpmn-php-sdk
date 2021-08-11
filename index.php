<?php

use App\Bpmn\App;
use App\Bpmn\Helpers\Response;
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
            // $request->setVariable('Test', 'test');
            // $request->setVariable('Test2', 'test 2');
            $request->setWithVariablesInReturn(true);

            return $request;
        }); 

        if ($process['code'] == 200) {
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