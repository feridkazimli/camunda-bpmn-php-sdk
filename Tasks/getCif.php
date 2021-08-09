<?php
declare(strict_types=1);

use App\Bpmn\App;
use App\Bpmn\Helpers\Response;
use App\Bpmn\Requests\ExternelTaskRequest;

class getCif 
{
    public function __construct()
    {
        $this->app = new App();
    }

    public function execute($task)
    {
        $exec = $this->app->externelTask->subscribe('getCif', function () use ($task){
                $request = new ExternelTaskRequest();
                
                $lockTask = $this->app->externelTask->fetchAndLock(function () use ($task, $request)
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

                $app = true;

                if($app && !Response::getError())
                {
                    $task = Response::getSuccess();
                    $this->app->externelTask->complete($task['body'][0]['id'], 
                        function () use ($task, $request) {
                            $request->setWorkerId($task['body'][0]['workerId'], false)
                                    ->setVariable('responseGetCustomerInfoFromGni', 'Success')
                                    ->setVariable('customer', 'Farid Kazimzade')
                                    ->setVariable('phone', '997706620312');
                            
                        return $request->iterate();
                    });
                }
                else
                {
                    $this->app->externelTask->complete($lockTask[0]['id'], 
                        function () use ($lockTask, $request) {
                            $request->setWorkerId($lockTask[0]['workerId'], false)
                                    ->setVariable('responseGetCustomerInfoFromGni', 'Error');

                        return $request->iterate();
                    }); 
                }

                // return $done;
            });
    }
}