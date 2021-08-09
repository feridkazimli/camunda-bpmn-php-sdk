<?php
declare(strict_types=1);
namespace App\Bpmn\Services;

use App\Bpmn\Helpers\Response;
use App\Bpmn\Helpers\RequestApi;

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
        if(array_key_exists('type', $process) || !array_key_exists('id', $process))
        {
            echo json_encode($process);
            return false;
        }

        $task = static::get(
                    $this->url('external-task?processInstanceId=' . $process['id'])
                );
        
        if(count($task) > 0)
        {
            $classPath = 'Tasks/' . $task[0]['topicName'] . '.php'; 
            require $classPath;
            $class = new $task[0]['topicName'];
            $return = $class->execute($task);
            
            if (!is_null($return) && $return == 'success') 
            {
                return Response::setSuccess([
                    'status' => 'error',
                    'body' => $task
                ]);
            }

            $this->getExternalTask($process);
        }
        else
        {
            return false;
        }
    }

    public function subscribe($topicName, $callable)
    {
        return $callable();
    }

    public function fetchAndLock($callable)
    {
        $lockTask = static::post(
            $this->url('external-task/fetchAndLock'),
            $callable(),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        if (array_key_exists('type', $lockTask))
        {
            return Response::setError([
                'status' => 'error',
                'body' => $lockTask
            ]);
        }
        else
        {
            return Response::setSuccess([
                'status' => 'success',
                'body'   => $lockTask
            ]);
        }
    }

    public function complete($id, $callable)
    {
        $complete = static::post(
            $this->url('external-task/'.$id.'/complete'),
            $callable(),
            array('Content-Type:application/json', 'Accept:application/json')
        );

        if (isset($complete['type']) && !is_null($complete))
        {
            return Response::setError([
                'status' => 'error',
                'body' => $complete
            ]);
        }
        else
        {
            return $complete;
        }
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>