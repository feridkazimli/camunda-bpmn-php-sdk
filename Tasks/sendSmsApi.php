<?php
declare(strict_types=1);

use Bpmn\App;
use Bpmn\Requests\ExternalTaskRequest;

class sendSmsApi extends App
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute($task, ExternalTaskRequest $request)
    {
        $ltask = $this->app->externelTask->fetchAndLock(function () use ($task, $request)
        {
            $request->setWorkerId('cif_')
                    ->setMaxTasks(1)
                    ->setUsePriority(true)
                    ->setTopics([
                        'topicName' => $task[0]['topicName'],
                        'lockDuration' => 500,
                        'processDefinitionId' => $task[0]['processDefinitionId'], 
                        'processDefinitionKey' => $task[0]['processDefinitionKey'], 
                        'processInstanceId' => $task[0]['processInstanceId'], 
                        'businessKey' => $task[0]['businessKey']
                    ]);
            
            return $request->iterate();
        });

        $app = false;

        if($app)
        {
            $this->app->externelTask->complete($ltask->id, 
                function () use ($ltask, $request) {
                    $request->setWorkerId($ltask->workerId, false)
                            ->setVariable('responseSendMailAndSms', 'Success');
                    
                return $request->iterate();
            });
            echo json_encode($ltask);
            return false;
        }
        else
        {
            $this->app->externelTask->complete($ltask->id, 
                function () use ($ltask, $request) {
                    $request->setWorkerId($ltask->workerId, false)
                            ->setVariable('responseSendMailAndSms', 'Error');

                return $request->iterate();
            });  

            $var = $this->app->processInstance->getProcessVariable($ltask, 
                                                                'globalError');

            echo json_encode($var);
            return false;
        }
    }
}