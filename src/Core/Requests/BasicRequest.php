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
class BasicRequest
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
       $objectParameter = $this->builderParameter();
       //Se le añaden los parametros
       $objectParameter->addAllValuesForParameters($params);
       //Se establece el parameter a este objeto
       $this->setParameter($objectParameter);
       $this->sendRequest();        
              
    }
    
    
    //////////////////////////
    // Metodos a sobrecargar por los hijos
    //////////////////////
    
    /**
     * Metodo encargado de devolver el paramer que se va a usar
     * Este metodo deber ser sobrecargado por los hijos
     * @return FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic $parameter
     */
    protected function builderParameter(): ParameterBasic
    {
        
    }

    /*
     * Debe devolver el nombre de metodo que se desea ejecutar para lasolicitud
     * Este metodo debser ser sobrecargado por los hijo
     * @return string nombre del metodo a ejecutar en el cliente
     */
    protected function getMethodName(): String {
        
    }
    
    

}
