<?php
declare(strict_types=1);
namespace Bpmn\Services;

use Bpmn\Helpers\Response;
use Bpmn\Helpers\RequestApi;

/**
 * Undocumented class
 */
class HistoryServices extends RequestApi
{
    protected $apiUrl;

    public function __construct($apiUrl = '')
    {
        $this->apiUrl = $apiUrl;
    }

    public function finishProcess($id)
    {
        $instance = static::get(
            $this->url('history/process-instance?processInstanceId=' . $id)
        );

        return $instance;
    }

    protected function url($path)
    {
        return $this->apiUrl . $path;
    }
}
?>