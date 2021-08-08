<?php
declare(strict_types=1);

namespace App\Bpmn;

use App\Bpmn\Services\ProcessDefinationServices;

require 'bpmn/helpers/RequestApi.php';
require 'bpmn/requests/IteratorRequest.php';
require 'bpmn/requests/ProcessRequest.php';
require 'bpmn/services/ProcessDefinationServices.php';
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
    public $apiUrl  = 'http://localhost:8080/engine-rest/';
    /**
     * Process object
     *
     * @var string
     */
    public $processDefination = '';
    /**
     * Externel Task object
     *
     * @var string
     */
    public $externelTask = '';
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
        // $this->externelTask = new ExternelTaskServices();
    }
}

?>