<?php
declare(strict_types=1);

namespace App\Bpmn\Requests;

use App\Bpmn\Requests\IteratorRequest;

class ProcessRequest extends IteratorRequest
{
    protected $processDefinitionId;
    protected $processDefinitionIdIn;
    protected $name;
    protected $nameLike;
    protected $deploymentId;
    protected $deployedAfter;
    protected $deployedAt;
    protected $key;
    protected $keysIn;
    protected $keyLike;
    protected $category;
    protected $categoryLike;
    protected $version;
    protected $latestVersion;
    protected $resourceName;
    protected $resourceNameLike;
    protected $startableBy;
    protected $active;
    protected $suspended;
    protected $incidentId;
    protected $incidentType;
    protected $incidentMessage;
    protected $incidentMessageLike;
    protected $tenantIdIn;
    protected $withoutTenantId;
    protected $includeProcessDefinitionsWithoutTenantId;
    protected $versionTag;
    protected $versionTagLike;
    protected $withoutVersionTag;
    protected $startableInTasklist;
    protected $notStartableInTasklist;
    protected $startablePermissionCheck;
    protected $businessKey;
    protected $withVariablesInReturn;
    protected $variables;
    protected $caseInstanceId;
    protected $startInstructions;
    protected $skipCustomListeners;
    protected $skipIoMappings;

    public function setBusinessKey(string|int $business_key)
    {
        $this->businessKey = $business_key;
        return $this;
    }

    public function getBusinessKey()
    {
        return $this->businessKey;
    }

    public function setWithVariablesInReturn(bool $bool)
    {
        $this->withVariablesInReturn = $bool;
        return $this;
    }

    public function getWithVariablesInReturn()
    {
        return $this->withVariablesInReturn;
    }

    public function setVariable($key, $value, $value_info = '', $local = false)
    {
        $this->variables[$key] = [
            'value' => $value,
            'type' => gettype($value),
            'valueInfo' => $value_info,
            'local' => $local
        ];
        
        return $this;
    }

    public function getVariable()
    {
        return $this->variables;
    }

    // public function setstartInstructions()
    // {
    //     $this->startInstructions =  '';
    // }
}
?>