<?php
declare(strict_types=1);

namespace Bpmn\Responses;

use Bpmn\Helpers\Iterator;

class ExternelTaskResponse extends Iterator
{
    public $code;
    public $id;
    public $processDefinitionId;
    public $variables;
    protected $definitionId;
    protected $errorMessage;
    protected $errorDetails;
    protected $executionId;
    protected $activityId;
    protected $activityInstanceId;
    protected $processDefinitionKey;
    protected $retries;
    protected $suspended;
    protected $topicName;
    protected $workerId;
    protected $tenantId;
    protected $priority;
    protected $businessKey;
    protected $extensionProperties;
    protected $type;
    protected $message;

    public function __set($isim, $değer)
    {
        $this->$isim = $değer;
        return $this;
    }

    public function __get($isim)
    {
        if ($this->$isim) {
            return $this->$isim;
        }

        $trace = debug_backtrace();
        trigger_error(
            $trace[0]['file'] . ' dosyasının ' .
            $trace[0]['line'] . '. satırında ' .
            '__get() ile tanımsız özellik istendi: ' . $isim,
            E_USER_NOTICE);
        return null;
    }
}
?>