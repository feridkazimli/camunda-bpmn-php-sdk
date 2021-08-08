<?php
declare(strict_types=1);
namespace App\Bpmn\Services;

use App\Bpmn\Helpers\RequestApi;
/**
 * Undocumented class
 */
class ProcessDefinationServices extends RequestApi
{
    public function startProcess($config, $callable)
    {
        echo json_encode($callable()->iterate());
    }
}
?>