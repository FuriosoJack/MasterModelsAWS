<?php
namespace FuriosoJack\MasterModelsAWS\Tests;


use FuriosoJack\MasterModelsAWS\Operations\Clients\EC2;
use FuriosoJack\MasterModelsAWS\Operations\Clients\DirectoryService;

/**
 * Class AuthTest
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class AuthTest extends TestCase
{

    /**
     * Disabled test
     * @test
     */
    public function authBasic()
    {

       $client = new EC2([
           'region' => 'us-east-1',

           'credentials' => [
                
            ],           
           'version' => 'latest']);
       $parameters = new \FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC\Parameters\ParameterGetVPC();
       $parameters->addValueForParameter('Filters', []);
       
       $getVp = new \FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC\GetVPCs();
       $getVp->setPrameter($parameters);
       $getVp->setClientConexion($client);
       dd($getVp->sendRequest());

    }


}
