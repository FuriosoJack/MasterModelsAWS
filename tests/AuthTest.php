<?php
namespace FuriosoJack\MasterModelsAWS\Tests;
use PHPUnit\Framework\TestCase;

use FuriosoJack\MasterModelsAWS\Operations\Clients\EC2;
use FuriosoJack\MasterModelsAWS\Operations\Clients\DirectoryService;
use FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\PutObject;
use Dotenv\Dotenv;
/**
 * Class AuthTest
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class AuthTest extends TestCase
{

    private $pathFile;
    
    public function setUp()
    {
        parent::setUp();
        
        //Cargar las configuraciones del entorno
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
        
        $apthFile = __DIR__;
        $apthFile = realpath($apthFile . "../../../../../Pictures/Captura");  
        $this->pathFile = $apthFile . rand(1, 15) . ".png";
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
           $this->assertTrue($getVp->getResonse()->hasKey('Vpcs'));
       }else{
           var_dump($getVp->getErrors());
       }
    }
    
    public function testS3Upload()
    {
             
        //Se crea el cliente
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        
        $reques = new PutObject($client);
        $reques->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/archivo.png',
            'SourceFile' => $this->pathFile,
            'Metadata' => [
                'namePerson' => 'Codigo de javascript'
            ]
        ]);
        
        if(!$reques->thereAreErrors()){
            var_dump($reques->getResonse());
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }


}
