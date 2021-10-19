<?php
declare(strict_types=1);

namespace Bpmn;

use stdClass;
use Bpmn\Services\HistoryServices;
use Bpmn\Services\VariablesServices;
use Bpmn\Services\ExternelTaskServices;
use Bpmn\Services\ProcessInstanceServices;
use Bpmn\Services\ProcessDefinationServices;

// require 'bpmn/helpers/Response.php';
// require 'bpmn/helpers/RequestApi.php';
// require 'bpmn/requests/IteratorRequest.php';
// require 'bpmn/requests/ProcessRequest.php';
// require 'bpmn/requests/ExternalTaskRequest.php';
// require 'bpmn/services/ProcessDefinationServices.php';
// require 'bpmn/services/ExternelTaskServices.php';
// require 'bpmn/services/HistoryServices.php';
// require 'bpmn/services/ProcessInstanceServices.php';
/**
 * App class
 * @category App_Class
 * @package  Camunda-php-sdk
 * @author   Farid Kazimzade <ferid.kazimli@gmail.com>
 * @license  MIT
 * @link     http://faridkhan.info
 */
class App
{
    /**
     *  Rest api url
     *
     * @var string
     */
    public $apiUrl  = 'http://localhost:8080/engine-rest';
    /**
     * Process object
     *
     * @var object
     */
    public $processDefination;
    /**
     * Externel Task object
     *
     * @var object
     */
    public $externelTask;
    /**
     * History object
     *
     * @var object
     */
    public $history;
    /**
     * Process Instance object
     *
     * @var object
     */
    public $processInstance;
    /**
     * Construct function
     *
     * @param  string $apiUrl
     * @return void
     */
    public function __construct(string $apiUrl = NULL)
    {
        if (!is_null($apiUrl)) {
            $this->apiUrl = $apiUrl;
        }

        $this->processDefination = new ProcessDefinationServices($this->apiUrl);
        $this->externelTask = new ExternelTaskServices($this->apiUrl);
        $this->history = new HistoryServices($this->apiUrl);
        $this->processInstance = new ProcessInstanceServices($this->apiUrl);
        $this->variable = new VariablesServices($this->apiUrl);
    }
}

?>