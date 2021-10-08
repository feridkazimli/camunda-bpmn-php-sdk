<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\RequestApi;
use Bpmn\Requests\ProcessRequest;
use Bpmn\Responses\ProcessResponse;
/**
 * Undocumented class
 */
class ProcessDefinationServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl)
    {
        echo $this->apiUrl;
        $this->apiUrl = $apiUrl;
        $this->processResponse = new ProcessResponse();
    }

    public function startProcess($config, $callable)
    {
        $url = $this->url('process-definition/key/'.$config['key'].'/tenant-id/'.$config['tenant-id'].'/start');
        $data = static::post($url, $callable(), 
                            ['Content-Type:application/json',
                             'Accept:application/json'
                            ]);
        if($data['code'] == 200)
        {
            return $this->processResponse->cast($this->processResponse, $data);
        }
        else
        {
            trigger_error(json_encode($data), E_USER_ERROR);
        }
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>