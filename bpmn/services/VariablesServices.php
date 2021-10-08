<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\RequestApi;
use Bpmn\Responses\ExternelTaskResponse;

/**
 * Undocumented class
 */
class VariablesServices extends RequestApi
{
    protected $apiUrl;
    protected $path;

    public function __construct($apiUrl = '')
    {
        $this->apiUrl = $apiUrl;
    }

    public function getVariable($var_name, ExternelTaskResponse $task)
    {
        $variable = $this->get(
            $this->url('variable-instance?variableName='.$var_name.'&processInstanceIdIn=' . $task->getInstanceID())
        );

        return $variable[0]['value'];
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>