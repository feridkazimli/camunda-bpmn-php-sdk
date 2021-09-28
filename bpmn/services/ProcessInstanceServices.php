<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\RequestApi;
use Bpmn\Responses\ProcessInstanceResponse;

/**
 * Undocumented class
 */
class ProcessInstanceServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        $this->processInstanceResponse = new ProcessInstanceResponse();
    }

    public function getProcessVariable($task, $var_name)
    {
        $processVariable = static::get(
            $this->url('process-instance/'.$task->processInstanceId.'/variables/'.$var_name.'?deserializeValue=true')
        );

        $processVariable['id'] = $task->processInstanceId; 
        return $this->processInstanceResponse->cast($this->processInstanceResponse, $processVariable);
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>