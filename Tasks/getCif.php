<?php
declare(strict_types=1);

use Bpmn\App;
use Bpmn\Requests\ExternalTaskRequest;

class getCif extends App
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute($_task)
    {
        $locktask = $this->externelTask->fetchAndLock($_task);

        $app = false;

        if($app)
        {
            $this->externelTask->complete($locktask->getID(), 
                function (ExternalTaskRequest $request) use ($locktask) {
                    $request->setWorkerId($locktask->getWorkerID(), false)
                            ->setVariable('responseGetCustomerInfoFromGni', 'Success')
                            ->setVariable('customer', 'Farid Kazimzade')
                            ->setVariable('phone', '997706620312');
                    
                return $request->iterate();
            });
        }
        else
        {
            $this->externelTask->complete($locktask->getID(), 
                function (ExternalTaskRequest $request) use ($locktask) {
                    $request->setWorkerId($locktask->getWorkerID(), false)
                            ->setVariable('responseGetCustomerInfoFromGni', 'Error');
                
                return $request->iterate();
            }); 


            print_r($this->variable->getVariable('globalError', $locktask));
            print_r($this->variable->getVariable('globalErrorMessage', $locktask));

            $var = $this->processInstance->getProcessVariable($locktask, 'globalError');
            $var2 = $this->processInstance->getProcessVariable($locktask, 'globalErrorMessage');

            // echo json_encode($var);
            return false;
        }
    }
}