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
    
    
    public function __construct()
    {
        parent::__construct();
         $this->fileNameUp = 'chuck.jpg';
    }


    public function setUp()
    {
        parent::setUp();
        
        //Cargar las configuraciones del entorno
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
        
        $apthFile = __DIR__;
        $this->pathFile = realpath($apthFile . "../../../../../Pictures/chuck.jpg");  
       
       
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
        
        $resquest = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\GetObject($client);
        $resquest->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/'.$this->fileNameUp,            
        ]);
        
        if($resquest->thereAreErrors()){
            var_dump($resquest->getErrors());
            $this->assertTrue(false);
        }else{
         //   var_dump($resquest->getResonse());
            $this->assertTrue(true);
        }
        
    }
    
    
    
    
    public function testPutObjectTagging()
    {
        //Se crea el cliente
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\Tagging\PutObjectTagging($client);
        $request->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/'.$this->fileNameUp,
            'Tagging' => [
                'TagSet' => [
                    [
                        'Key' => 'nombreEmpreado',
                        'Value' => "juan carlos"
                    ]
                ]
            ]
        ]);
        
        if($request->thereAreErrors()){
            var_dump($request->getErrors());
            $this->assertTrue(false);           
        }else{
            $this->assertTrue(true);
        }
        
    }
    
    public function testgetObjectTaggin()
    {
          //Se crea el cliente
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\Tagging\GetObjectTagging($client);
        
        $request->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/'.$this->fileNameUp,            
        ]);
        
        if($request->thereAreErrors()){
            var_dump($request->getErrors());
            $this->assertTrue(false);
        }else{
            //var_dump($request->getResonse());
            $this->assertTrue(true);
        }                
    }
    
    public function testDeleteTagObjectS3()
    {
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\Tagging\DeleteObjectTagging($client);
        
        $request->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/'.$this->fileNameUp,            
        ]);
        
        if($request->thereAreErrors()){
            var_dump($request->getErrors());
            $this->assertTrue(false);
        }else{
            //var_dump($request->getResonse());
            $this->assertTrue(true);
        }
               
    }
        
    
    public function testIndexFacesRekognition()
    {
         $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\Rekognition([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2016-06-27']);
         $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\IndexFaces($client);
         
         $request->run([
             'CollectionId' => getenv('AWS_REKOGNITION_COLLECTIONID'),
             'Image' => [
                 'S3Object' => [
                     'Bucket' => getenv('AWS_S3_BUCKET'),
                     'Name' => 'album/'.$this->fileNameUp
                 ]
             ],
             'ExternalImageId' => 'UNIQUEEXTERNAID',
             'DetectionAttributes' => [
                 'DEFAULT'
                 ]             
         ]);
         
         if($request->thereAreErrors()){
             var_dump($request->getErrors());
             $this->assertTrue(false);
         }else{
             //var_dump($request->getResonse());
             $this->assertTrue(true);
         }
    }
    
   
    
    public function testListFacesRekognition()
    {
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\Rekognition([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2016-06-27']);
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\ListFaces($client);
        
        $request->run([
            'CollectionId' => getenv('AWS_REKOGNITION_COLLECTIONID'),
            'MaxResults' =>20
        ]);
        
        if($request->thereAreErrors()){
            var_dump($request->getErrors());
            $this->assertTrue(false);
        }else{
            //var_dump($request->getResonse());
            $this->assertTrue(true);            
        }
    }
    
    public function testSeachAndDeleteFacesRekognition()
    {
        
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\Rekognition([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2016-06-27']);
        
        $requestSearchByImage = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\SearchFacesByImage($client);
        $requestSearch = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\SearchFaces($client);
        $requestDelete = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\DeleteFaces($client);
 
        $requestSearchByImage->run([
            'CollectionId' => getenv('AWS_REKOGNITION_COLLECTIONID'),
            'Image' => [
                'S3Object' => [
                     'Bucket' => getenv('AWS_S3_BUCKET'),
                     'Name' => 'album/'.$this->fileNameUp
                 ]
            ],
            'MaxFaces' => 1
            
        ]);
        if($requestSearchByImage->thereAreErrors()){
            var_dump($requestSearchByImage->getErrors());
            $this->assertTrue(false);
        }else{
            $response = $requestSearchByImage->getResonse();
            $facesMatchs = $response->get('FaceMatches');
            $faceELement = $facesMatchs[0]['Face'];
            $faceID = $faceELement['FaceId'];           
            $this->assertTrue(strlen($faceID) > 0);  
            
            
            $requestSearch->run([
                'CollectionId' => getenv('AWS_REKOGNITION_COLLECTIONID'),
                'FaceId' => $faceID
            ]);
            
            
            $this->assertTrue(!$requestSearch->thereAreErrors());
            
            
            $requestDelete->run([
                'CollectionId' => getenv('AWS_REKOGNITION_COLLECTIONID'),
                'FaceIds' => [
                    $faceID
                ]
            ]);
            
            $this->assertTrue(!$requestDelete->thereAreErrors()); 
            
        }        
        
    }
    
    
    public function testDetectFacesRekognition()
    {
        
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\Rekognition([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2016-06-27']);
        
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\Rekognition\Faces\DetectFaces($client);
        
        $request->run([
            'Image' => [
                 'S3Object' => [
                     'Bucket' => getenv('AWS_S3_BUCKET'),
                     'Name' => 'album/'.$this->fileNameUp
                 ]
             ]
        ]);
        
        $this->assertTrue(!$request->thereAreErrors());
        
    }
    public function testDeleteObjectS3()
    {
        $client = new \FuriosoJack\MasterModelsAWS\Operations\Clients\S3([
           'region' => getenv('AWS_REGION'),
           'credentials' => [
                'key' => getenv('AWS_S3_KEY'),
                'secret' => getenv('AWS_S3_SECERT')
            ],           
           'version' => '2006-03-01']);
        $request = new \FuriosoJack\MasterModelsAWS\Operations\Requests\S3\Object\DeleteObject($client);
        
        $request->run([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key' => 'album/'.$this->fileNameUp,            
        ]);
        
        if($request->thereAreErrors()){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    
    
    
    
    


}
