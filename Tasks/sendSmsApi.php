<?php
declare(strict_types=1);

use App\Bpmn\App;
use App\Bpmn\Helpers\Response;
use App\Bpmn\Requests\ExternelTaskRequest;

class sendSmsApi 
{
    public function __construct()
    {
        $this->app = new App();
    }

    public function execute($task)
    {
        $request = new ExternelTaskRequest();

        $task = $this->app->externelTask->fetchAndLock(function () use ($task, $request)
        {
            $request->setWorkerId('cif_')
                    ->setMaxTasks(1)
                    ->setUsePriority(true)
                    ->setTopics([
                        'topicName' => $task['0']['topicName'],
                        'lockDuration' => 500,
                        'processDefinitionId' => $task['0']['processDefinitionId'], 
                        'processDefinitionKey' => $task['0']['processDefinitionKey'], 
                        'processInstanceId' => $task['0']['processInstanceId'], 
                        'businessKey' => $task['0']['businessKey']
                    ]);
            
            return $request->iterate();
        });

        $app = false;

        if($app && $task['code'] == 200)
        {
            $done = $this->app->externelTask->complete($task['body'][0]['id'], 
                function () use ($task, $request) {
                    $request->setWorkerId($task['body'][0]['workerId'], false)
                            ->setVariable('responseSendMailAndSms', 'Success');
                    
                return $request->iterate();
            });

            return $done;
        }
        elseif($task['code'] == 200 && !$app)
        {
            $done = $this->app->externelTask->complete($task['body'][0]['id'], 
                function () use ($task, $request) {
                    $request->setWorkerId($task['body'][0]['workerId'], false)
                            ->setVariable('responseSendMailAndSms', 'Error');

                return $request->iterate();
            });  

            $var = $this->app->processInstance->getProcessVariable($task['body'], 
                                                                'globalError');

            return $var;
        }
        else
        {
            return $task;
        }
    }
}