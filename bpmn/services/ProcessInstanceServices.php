<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\RequestApi;
use Bpmn\Helpers\Response;

/**
 * Undocumented class
 */
class ProcessInstanceServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getProcessVariable($task, $var_name)
    {
        $processVariable = static::get(
            $this->url('process-instance/'.$task[0]['processInstanceId'].'/variables/'.$var_name.'?deserializeValue=true')
        );

        $data = [
            'code' => $processVariable['code'],
            'status' => 'error',
            'body' => [
                'id' => $task[0]['processInstanceId'],
                'errorCode' => $processVariable['body']['value'],
                'valueInfo' => $processVariable['body']['valueInfo']
            ]
        ];

        return $data;
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>