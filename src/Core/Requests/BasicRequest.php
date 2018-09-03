<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;


/**
 * Estrutura basica de una solicitud hacia un cliente AWS
 *
 * @package FuriosoJack\MasterModelsAWS\Core\Requests
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
abstract class BasicRequest
{
  
    use TraitConexionManager;
    use TraitParameterManager;
    use TraitErrorsManager;
    use TraitResponseManager;
    
    
    /**
     *  Espera una conexion en caso de que no se le asige la establece en nulla
     *  @var \FuriosoJack\MasterModelsAWS\Core\Client\Basic\ClientBasic | null
     *  
     * 
     */
    public function __construct($conexion = null)
    {
        $this->clientConexion = $conexion;
    }

   
    
   
    /**
     * Envia la peticion, ejecuta la peticion con el cliente indicado y el metodo indicado
     * 
     */
    private function sendRequest()
    {                
        try {
            //Llama al metodo del objeto del cliente AWS, para llamarlo se usa el nombre del metodo y se pasa los parametros necesarios para el funcionamiento
            $this->setResponse(call_user_func([$this->getClientConexion()
                    ->getClientAWS(),$this->getMethodName()],$this->getParameter()->getParametersFinally()));
        } catch (\Exception $e) {
            //Se setean los errores
            $this->setErros($e->getMessage());
        }        
    }
    
    /**
     * Ejecuta la solicitud 
     * @param array $params paratros de envio
     */
    public function run(array $params = [])
    {
       // Se obtiene el paramer a usar
       $objectParameter = new ParameterBasic($this->getParameters());
       //Se le añaden los parametros
       $objectParameter->addAllValuesForParameters($params);
       //Se establece el parameter a este objeto
       $this->setParameter($objectParameter);
       $this->sendRequest();        
              
    }  
    
    /**
     * Devuelve el nombre del metodo que se a usar en la solicitud
     * @return string $metodo
     */
    protected abstract function getMethodName():string;

}
