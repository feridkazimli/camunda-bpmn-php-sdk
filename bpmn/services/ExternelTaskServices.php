<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Closure;
use Bpmn\Helpers\RequestApi;
use Bpmn\Services\HistoryServices;
use Bpmn\Responses\ProcessResponse;
use Bpmn\Requests\ExternalTaskRequest;
use Bpmn\Responses\ExternelTaskResponse;

/**
 * Undocumented class
 */
class ExternelTaskServices extends RequestApi
{
    protected $apiUrl;
    protected $path;
    protected $externelTaskResponse;

    public function __construct($apiUrl = '')
    {
        $this->apiUrl = $apiUrl;
        $this->externelTaskResponse = new ExternelTaskResponse();
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
                $execute = new $task[0]['topicName'];
                call_user_func_array([$execute, 'execute'], [$task, new ExternalTaskRequest()]);
            }
            else
            {
                return false;
            }
            return $this->getExternalTask($process);
        }
    }

    public function fetchAndLock($callable) : ExternelTaskResponse
    {
        $lockTask = static::post(
            $this->url('external-task/fetchAndLock'),
            $callable(),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        return $this->externelTaskResponse->cast($this->externelTaskResponse, $lockTask);
    }

    public function complete($id, $request)
    {   
        $complete = static::post(
            $this->url('external-task/'.$id.'/complete'),
            $request(),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        return $complete;
    }

    public function getTaskVariable($var_name)
    {
        $variable = $this->get(
            $this->url('variable-instance?variableName=' . $var_name)
        );

        return $variable;
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>