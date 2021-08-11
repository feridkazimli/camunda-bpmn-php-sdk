<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\Response;
use Bpmn\Helpers\RequestApi;
use Bpmn\Services\HistoryServices;

/**
 * Undocumented class
 */
class ExternelTaskServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl = '')
    {
        $this->apiUrl = $apiUrl;
    }

    public function getExternalTask($process)
    {
        $task = static::get(
                    $this->url('external-task?processInstanceId=' . $process['body']['id'])
                );

        if($task['code'] == 200 && count($task['body']) > 0)
        {
            $classPath = 'Tasks/' . $task['body'][0]['topicName'] . '.php'; 
            if(file_exists($classPath) && is_file($classPath))
            {
                require $classPath;
                $class = new $task['body'][0]['topicName'];
                $return = $class->execute($task['body']);
                
                if ($return['code'] != 200) {
                    // return $return;
                    $history = new HistoryServices($this->apiUrl);
                    return $history->finishProcess($process['body']['id']);
                }
                elseif (array_key_exists('status', $return)) 
                {
                    return $return;
                }
                elseif($return['code'] == 200)
                {
                    return $this->getExternalTask($process);
                }
                else
                {
                    return $return;
                }
            }
        }
        else
        {
            return $task;
        }
    }

    public function fetchAndLock($callable)
    {
        // print_r($callable()); die;
        $lockTask = static::post(
            $this->url('external-task/fetchAndLock'),
            $callable(),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        return $lockTask;
    }

    public function complete($id, $callable)
    {        
        $complete = static::post(
            $this->url('external-task/'.$id.'/complete'),
            $callable(),
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