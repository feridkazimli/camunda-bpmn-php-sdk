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
            $this->url('process-instance/'.$task->processInstanceId.'/variables/'.$var_name)
        );

        $processVariable['id'] = $task->processInstanceId; 
        $data = $this->processInstanceResponse->cast($this->processInstanceResponse, $processVariable);
        return json_decode(json_encode($data), TRUE);
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>