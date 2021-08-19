<?php
declare(strict_types=1);

use Bpmn\App;
use Bpmn\Requests\ExternalTaskRequest;
use Bpmn\Responses\ExternelTaskResponse;

class getCif 
{
    public function __construct()
    {
        $this->app = new App('http://camunda-platform.service.consul/engine-rest/');
    }

    public function execute($task)
    {
        $request = new ExternalTaskRequest();

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

        $app = true;

        if($app && $ltask->code == null)
        {
            $this->app->externelTask->complete($ltask->id, 
                function () use ($ltask, $request) {
                    $request->setWorkerId($ltask->workerId, false)
                            ->setVariable('responseGetCustomerInfoFromGni', 'Success')
                            ->setVariable('customer', 'Farid Kazimzade')
                            ->setVariable('phone', '997706620312');
                    
                return $request->iterate();
            });

            return $ltask;
        }
        elseif($ltask->code == null && !$app)
        {
            $this->app->externelTask->complete($ltask->id, 
            function () use ($ltask, $request) {
                $request->setWorkerId($ltask->workerId, false)
                        ->setVariable('responseGetCustomerInfoFromGni', 'Error');
                
                return $request->iterate();
            }); 

            $var = $this->app->processInstance->getProcessVariable($ltask, 
                                                                'globalError');

            return $var;
        }
        else
        {
            return $ltask;
        }
    }
}