<?php
namespace FuriosoJack\MasterModelsAWS\Tests;
use PHPUnit\Framework\TestCase;

use FuriosoJack\MasterModelsAWS\Operations\Clients\EC2;
use FuriosoJack\MasterModelsAWS\Operations\Clients\DirectoryService;
use FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\PutObject;
use FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\GetObject;
use Dotenv\Dotenv;

/**
 * Class AuthTest
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class AuthTest extends TestCase
{

    private $pathFile;
    private $fileNameUp;
    
    public function setUp()
    {
        parent::setUp();
        
        //Cargar las configuraciones del entorno
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
        
        $apthFile = __DIR__;
        $this->pathFile = realpath($apthFile . "../../../../../Pictures/Captura.png");  
       
        $this->fileNameUp = rand(1,60). 'Captura.png';
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
            'Key' => 'album/'. $this->fileNameUp,
            'SourceFile' => $this->pathFile
        ]);
        
        if($reques->thereAreErrors()){
            var_dump($reques->getErrors());
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    
    public function testS3Get()
    {
          //Se crea el cliente
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        
        $resquest = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\GetObjectTagging($client);
        $resquest->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/20Captura.png',            
        ]);
        
        if($resquest->thereAreErrors()){
            var_dump($resquest->getErrors());
            $this->assertTrue(false);
        }else{
            var_dump($resquest->getResonse());
            $this->assertTrue(true);
        }
        
    }
    
    
    


}
