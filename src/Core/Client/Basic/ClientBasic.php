<?php
namespace FuriosoJack\MasterModelsAWS\Core\Client\Basic;
use Aws\AwsClient;
/**
 * 
 * Clase estructural de un cliente original de AWS
 * Se usa para tener un controltotal de las transacciones.
 * **De esta clase tiene que heradar todas las clases que seran clientes.**
 * @package FuriosoJack\MasterModelsAWS
 * @subpackage Core\Client\Basic
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @see MarkDown
 * @version 1.0.0
 * @access public
 * 
 * 
 */
abstract class ClientBasic{

  /**
   * Cliente aws
   * @var \Aws\AwsClient
   */
  private $awsClient;
  
  /**
   * Parametros de configiguracion de inicio
   * @var array $parameters
   * 
   */
  private $parameters;

  /**
   * @param array $parameters parametros para la creacion del cliente
   */
  public function __construct(array $parameters)
  {
    $this->parameters = $parameters;
  }

  /**
   * Devuelve los parametros de configuracion, key, secret,region, etc.
   * @return array Parametros
   */
  private function getParameters()
  {
      return $this->parameters;
  }

  /**
   * Retorna el cliente AWS
   * @return Aws\AwsClient Cliente de conexion AWS
   */
  public function getClientAWS():AwsClient
  {
     
     //Se comprueba que si existe el aws cliente que no e vuelva a crear
     if(is_null($this->awsClient)){
         
          //Se obtiene la clase del cliente
         $clientClass = $this->getClientClass();
         
         //se devuelve uns nueva instancia de la clase del cliente con los parametros de configuracion
         $this->awsClient = new $clientClass($this->getParameters());
     }
     
     return $this->awsClient;     
     
  }
  
  ////////////////Metodos a sobrecargar
  
  
  /**
   * Metodo encargado de devolver la clase del cliente AWS que va usar este objeto
   * 
   * **Este es el metodo que se tiene que sobrecargar los hijos**
   * 
   * @see MarkDown
   * @return string|null Nombre de la Clase de cliente AWS
   */
  protected abstract function getClientClass();



}
