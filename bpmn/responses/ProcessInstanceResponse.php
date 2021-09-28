<?php
declare(strict_types=1);

namespace Bpmn\Responses;

use Bpmn\Helpers\Iterator;

class ProcessInstanceResponse extends Iterator
{
    public $code;
    public $id;
    public $value;
    // public $variables;
    // public $message;
    protected $type;
    protected $definitionId;
    protected $businessKey;
    protected $caseInstanceId;
    protected $ended;
    protected $suspended;
    protected $tenantId;

    public function __set($isim, $değer)
    {
        $this->$isim = $değer;
        return $this;
    }

    public function __get($isim)
    {
        if (!is_null($this->$isim)) {
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