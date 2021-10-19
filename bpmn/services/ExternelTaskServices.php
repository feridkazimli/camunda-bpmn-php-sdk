<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Closure;
use Bpmn\Helpers\RequestApi;
use Bpmn\Responses\ProcessResponse;
use Bpmn\Requests\ExternalTaskRequest;
use Bpmn\Responses\ExternelTaskResponse;

/**
 * Undocumented class
 */
class ExternelTaskServices extends RequestApi
{
    protected $task;
    protected $apiUrl;
    protected $path;
    protected $externelTaskResponse;

    public function __construct($apiUrl = '')
    {
        $this->apiUrl = $apiUrl;
        $this->externelTaskResponse = new ExternelTaskResponse();
        $this->request  = new ExternalTaskRequest();
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
    public function getExternalTask(ProcessResponse $process)
    {
        $task = static::get(
                    $this->url('external-task?processInstanceId=' . $process->id)
                );
        
        if ($task['code'] == 200 && isset($task[0]['topicName'])) 
        {
            $classPath = $this->path . '/' . $task[0]['topicName'] . '.php'; 
            if(file_exists($classPath) && is_file($classPath))
            {
                if(class_exists($task[0]['topicName']))
                {
                    $execute = new $task[0]['topicName'];
                    call_user_func_array([$execute, 'execute'], [$task, new ExternalTaskRequest()]);
                }
            }
            else
            {
                return false;
            }
            return $this->getExternalTask($process);
        }
    }

    public function fetchAndLock($task) : ExternelTaskResponse
    {
        $lockTask = static::post(
            $this->url('external-task/fetchAndLock'),
            $this->setLockData($task),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        return $this->externelTaskResponse->cast($this->externelTaskResponse, $lockTask);
    }

    protected function setLockData($task)
    {
        $this->request->setWorkerId('truva_')
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
        
        return $this->request->iterate();
    }

    public function complete($id, Closure $request)
    {   
        $complete = static::post(
            $this->url('external-task/'.$id.'/complete'),
            $request->call($this, $this->request),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        return $complete;
    }

    public function bpmnError($task_id, Closure $request)
    {
        $handle = static::post($this->url('external-task/'.$task_id.'/bpmnError'),
                                $request->call($this));
        return $handle;
    }

    public function getTaskVariable($task, $var_name)
    {
        $variable = $this->get(
            $this->url('process-instance/'.$task->processInstanceId.'/variables/' . $var_name)
        );

        return $variable;
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>