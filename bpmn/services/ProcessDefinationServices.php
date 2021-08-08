<?php
declare(strict_types=1);
namespace App\Bpmn\Services;

use App\Bpmn\Helpers\RequestApi;
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
        // $url = 'http://localhost:8080/engine-rest/process-definition/key/sms-mail/tenant-id/sms/start';
        // echo $url;
        $data = static::post($url, $callable()->iterate(), 
                            ['Content-Type:application/json',
                             'Accept:application/json'
                            ]);

        echo json_encode($data);
        // echo json_encode($callable()->iterate());
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>