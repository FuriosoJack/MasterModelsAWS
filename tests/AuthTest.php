<?php
namespace FuriosoJack\MasterModelsAWS\Tests;
use PHPUnit\Framework\TestCase;

use FuriosoJack\MasterModelsAWS\Operations\Clients\EC2;
use FuriosoJack\MasterModelsAWS\Operations\Clients\DirectoryService;
use Dotenv\Dotenv;
/**
 * Class AuthTest
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class AuthTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        
        //Cargar las configuraciones del entorno
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
    }
    /**
     * Disabled test
     * @test
     */
    public function testAuthBasic()
    {
       //Se crea el cliente
        $client = new EC2([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_KEY'),
                'secret' => getenv('AWS_SECRET')
            ],           
           'version' => getenv('AWS_VERSION')]);
       
       //Se crea la solicitud con el cliente
       $getVp = new \FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC\GetVPCs($client);     
       $getVp->run([
           'Filters' => [[
               'Name' => 'tag-value',
               'Values' => ['default']
           ]]
       ]);
       if(!$getVp->thereAreErrors()){
           var_dump($getVp->getResonse()->get('Vpcs'));
       }else{
           var_dump($getVp->getErrors());
       }
       
       
            
       
       

    }


}
