<?php
declare(strict_types=1);

namespace Bpmn\Requests;

use Exception;
use Bpmn\Requests\IteratorRequest;

class ExternalTaskRequest extends IteratorRequest
{
    protected $topicName;
    protected $sorting;
    protected $workerId;
    protected $maxTasks;
    protected $usePriority;
    protected $topics;
    protected $variables;

    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;
        return $this;
    }

    public function getTopicName()
    {
        return $this->topicName;
    }

    public function setSorting($sort_key, $sort_value)
    {
        $this->sorting[$sort_key] = $sort_value;
        return $this;
    }

    public function getSorting()
    {
        return $this->sorting;
    }

    public function setWorkerId($prefix_or_id = 'RA_', $change_id = true)
    {
        if ($change_id) 
        {
            $this->workerId = uniqid($prefix_or_id);
        }
        else
        {
            $this->workerId = $prefix_or_id;
        }
        
        return $this;
    }

    public function getWorkerId()
    {
        return $this->workerId;
    }

    public function setMaxTasks($count)
    {
        $this->maxTasks = $count;
        return $this;
    }

    public function getMaxTasks()
    {
        return $this->maxTasks;
    }

    public function setUsePriority($bool = false)
    {
        $this->usePriority = (bool)$bool;
        return $this;
    }

    public function getUsePriority()
    {
        return $this->usePriority;
    }

    public function setTopics($filters)
    {
        $this->topics = [$filters];
        return $this;
    }

    public function getTopics()
    {
        return $this->topics;
    }

    public function setVariable($key, $value, $value_info = [], $local = false)
    {
        $this->variables[$key] = [
            'value' => $value,
            'type' => gettype($value),
            'valueInfo' => (object)[],
            'local' => $local
        ];
        
        return $this;
    }

    public function getVariable()
    {
        return $this->variables;
    }
}
?>