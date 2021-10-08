<?php
declare(strict_types=1);

namespace Bpmn\Responses;

use Bpmn\Helpers\Iterator;

class ExternelTaskResponse extends Iterator
{
    /**
     * Status code
     *
     * @var int
     */
    public $code;
    /**
     * UUID
     *
     * @var string
     */
    public $id;
    /**
     * Defination ID
     *
     * @var string
     */
    public $processDefinitionId;
    /**
     * Instance ID
     *
     * @var string
     */
    public $processInstanceId;
    /**
     * Variables
     *
     * @var object
     */
    protected $variables;
    /**
     * Definition ID
     *
     * @var string
     */
    protected $definitionId;
    /**
     * Error Message
     *
     * @var string
     */
    protected $errorMessage;
    /**
     * Error Details
     *
     * @var string
     */
    protected $errorDetails;
    /**
     * Execution ID
     *
     * @var string
     */
    protected $executionId;
    /**
     * Activity ID
     *
     * @var string
     */
    protected $activityId;
    /**
     * Activity Instance ID
     *
     * @var string
     */
    protected $activityInstanceId;
    /**
     * Process Definition Key
     *
     * @var string
     */
    protected $processDefinitionKey;
    /**
     * Retries
     *
     * @var string
     */
    protected $retries;
    /**
     * Suspended
     *
     * @var string
     */
    protected $suspended;
    /**
     * Topic Name
     *
     * @var string
     */
    protected $topicName;
    /**
     * Worker ID
     *
     * @var string
     */
    protected $workerId;
    /**
     * Tenant ID
     *
     * @var string
     */
    protected $tenantId;
    /**
     * Priority
     *
     * @var string
     */
    protected $priority;
    /**
     * Business Key
     *
     * @var string
     */
    protected $businessKey;
    /**
     * Extension Properties
     *
     * @var string
     */
    protected $extensionProperties;
    /**
     * Type
     *
     * @var string
     */
    protected $type;
    /**
     * Message
     *
     * @var string
     */
    protected $message;
    /**
     * Undocumented function
     *
     * @param string $property_name
     * @param mixed $property_value
     */
    public function __set($property_name, $property_value)
    {
        $this->$property_name = $property_value;
        return $this;
    }
    /**
     * Undocumented function
     *
     * @param string $property_name
     * @return void
     */
    public function __get($property_name)
    {
        if ($this->$property_name) {
            return $this->$property_name;
        }

        $trace = debug_backtrace();
        trigger_error(
            $trace[0]['file'] . ' faylında ' .
            $trace[0]['line'] . '. sətirində ' .
            '__get() ile bildirilməyən özəllik istifadə olundu: ' . $property_name,
            E_USER_NOTICE);
        return null;
    }
    /**
     * Get http status code
     *
     * @return void
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Get BPMN ID
     *
     * @return void
     */
    public function getID()
    {
        return $this->id;
    }
    /**
     * Get Defination ID
     *
     * @return void
     */
    public function getDefinitionID()
    {
        return $this->processDefinitionId;
    }
    /**
     * Get Instance ID
     *
     * @return void
     */
    public function getInstanceID()
    {
        return $this->processInstanceId;
    }
    /**
     * Get Worker ID
     *
     * @return void
     */
    public function getWorkerID()
    {
        return $this->workerId;
    }
}
?>