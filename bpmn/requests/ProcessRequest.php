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
    protected $sortBy;
    protected $sortOrder;
    protected $firstResult;
    protected $maxResults;
    protected $businessKey;
    protected $withVariablesInReturn;
    protected $variables;
    protected $caseInstanceId;
    protected $startInstructions;
    protected $skipCustomListeners;
    protected $skipIoMappings;

    public function setBusinessKey($prefix)
    {
        $this->businessKey = uniqid($prefix);
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

    public function setProcessDefinitionId($processDefinitionId)
    {
        $this->processDefinitionId = $processDefinitionId;
        return $this;
    }

    public function getProcessDefinitionId()
    {
        return $this->processDefinitionId;
    }

    public function setProcessDefinitionIdIn($processDefinitionIdIn)
    {
        $this->processDefinitionIdIn = $processDefinitionIdIn;
        return $this;
    }

    public function getProcessDefinitionIdIn()
    {
        return $this->processDefinitionIdIn;
    }

    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setNameLike($nameLike)
    {
        $this->nameLike = $nameLike;
        return $this;
    }

    public function getNameLike()
    {
        return $this->nameLike;
    }

    public function setDeploymentId($deploymentId)
    {
        $this->deploymentId = $deploymentId;
        return $this;
    }

    public function getDeploymentId()
    {
        return $this->deploymentId;
    }

    public function setDeployedAfter($deployedAfter)
    {
        $this->deployedAfter = $deployedAfter;
        return $this;
    }

    public function getDeployedAfter()
    {
        return $this->deployedAfter;
    }

    public function setDeployedAt($deployedAt)
    {
        $this->deployedAt = $deployedAt;
        return $this;
    }

    public function getDeployedAt()
    {
        return $this->deployedAt;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKeysIn($keysIn)
    {
        $this->keysIn = $keysIn;
        return $this;
    }

    public function getKeysIn()
    {
        return $this->keysIn;
    }

    public function setKeyLike($keyLike)
    {
        $this->keyLike = $keyLike;
        return $this;
    }

    public function getKeyLike()
    {
        return $this->keyLike;
    }

    
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        return $this->keyLike;
    }

    public function setCategoryLike($categoryLike)
    {
        $this->categoryLike = $categoryLike;
        return $this;
    }

    public function getCategoryLike()
    {
        return $this->categoryLike;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    
    public function setLatestVersion($latestVersion)
    {
        $this->latestVersion = $latestVersion;
        return $this;
    }

    public function getLatestVersion()
    {
        return $this->latestVersion;
    }
    
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
        return $this;
    }

    public function getResourceName()
    {
        return $this->resourceName;
    }

    
    public function setResourceNameLike($resourceNameLike)
    {
        $this->resourceNameLike = $resourceNameLike;
        return $this;
    }

    public function getResourceNameLike()
    {
        return $this->resourceNameLike;
    }
        
    public function setStartableBy($startableBy)
    {
        $this->startableBy = $startableBy;
        return $this;
    }

    public function getStartableBy()
    {
        return $this->startableBy;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
        return $this;
    }

    public function getSuspended()
    {
        return $this->suspended;
    }

    public function setIncidentId($incidentId)
    {
        $this->incidentId = $incidentId;
        return $this;
    }

    public function getIncidentId()
    {
        return $this->incidentId;
    }

    public function setIncidentType($incidentType)
    {
        $this->incidentType = $incidentType;
        return $this;
    }

    public function getIncidentType()
    {
        return $this->incidentType;
    }

    public function setIncidentMessage($incidentMessage)
    {
        $this->incidentMessage = $incidentMessage;
        return $this;
    }

    public function getIncidentMessage()
    {
        return $this->incidentMessage;
    }

    public function setIncidentMessageLike($incidentMessageLike)
    {
        $this->incidentMessageLike = $incidentMessageLike;
        return $this;
    }

    public function getIncidentMessageLike()
    {
        return $this->incidentMessageLike;
    }

    public function setTenantIdIn($tenantIdIn)
    {
        $this->tenantIdIn = $tenantIdIn;
        return $this;
    }

    public function getTenantIdIn()
    {
        return $this->tenantIdIn;
    }

    public function setWithoutTenantId($withoutTenantId)
    {
        $this->withoutTenantId = $withoutTenantId;
        return $this;
    }

    public function getWithoutTenantId()
    {
        return $this->withoutTenantId;
    }

    public function setIncludeProcessDefinitionsWithoutTenantId($includeProcessDefinitionsWithoutTenantId)
    {
        $this->includeProcessDefinitionsWithoutTenantId = $includeProcessDefinitionsWithoutTenantId;
        return $this;
    }

    public function getIncludeProcessDefinitionsWithoutTenantId()
    {
        return $this->includeProcessDefinitionsWithoutTenantId;
    }

    public function setVersionTag($versionTag)
    {
        $this->versionTag = $versionTag;
        return $this;
    }

    public function getVersionTag()
    {
        return $this->versionTag;
    }

    public function setVersionTagLike($versionTagLike)
    {
        $this->versionTagLike = $versionTagLike;
        return $this;
    }

    public function getVersionTagLike()
    {
        return $this->versionTagLike;
    }

    public function setWithoutVersionTag($withoutVersionTag)
    {
        $this->withoutVersionTag = $withoutVersionTag;
        return $this;
    }

    public function getWithoutVersionTag()
    {
        return $this->withoutVersionTag;
    }

    public function setStartableInTasklist($startableInTasklist)
    {
        $this->startableInTasklist = $startableInTasklist;
        return $this;
    }

    public function getStartableInTasklist()
    {
        return $this->startableInTasklist;
    }

    public function setNotStartableInTasklist($notStartableInTasklist)
    {
        $this->notStartableInTasklist = $notStartableInTasklist;
        return $this;
    }

    public function getNotStartableInTasklist()
    {
        return $this->notStartableInTasklist;
    }

    public function setStartablePermissionCheck($startablePermissionCheck)
    {
        $this->startablePermissionCheck = $startablePermissionCheck;
        return $this;
    }

    public function getStartablePermissionCheck()
    {
        return $this->startablePermissionCheck;
    }

    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    public function getSortBy()
    {
        return $this->sortBy;
    }

    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
        return $this;
    }

    public function getFirstResult()
    {
        return $this->firstResult;
    }

    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    public function getMaxResults()
    {
        return $this->maxResults;
    }
}
?>