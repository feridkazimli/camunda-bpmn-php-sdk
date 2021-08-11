<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\RequestApi;
use Bpmn\Helpers\Response;

/**
 * Undocumented class
 */
class ProcessDefinationServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function startProcess($config, $callable)
    {
        $url = $this->url('process-definition/key/'.$config['key'].'/tenant-id/'.$config['tenant-id'].'/start');
        $data = static::post($url, $callable()->iterate(), 
                            ['Content-Type:application/json',
                             'Accept:application/json'
                            ]);
        
        return $data;
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>