<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;


/**
 * Clase de la estrutura basica de una solicitud al cliente de AWS
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
    use TraitRequestManager;
    
    public function __construct($conexion = null)
    {
        $this->clientConexion = $conexion;
    }

    protected function getMethodName()
    {
        return null;       
    }
    
    
    /**
     * Envia la peticion, ejecuta la peticion con el cliente indicado y el metodo indicado
     * 
     */
    public function sendRequest()
    {
        try {
            //Llama al metodo del objeto del cliente AWS, para llamarlo se usa el nombre del metodo y se pasa los parametros necesarios para el funcionamiento
            $this->setResponse(call_user_func([$this->getClientConexion()
                    ->getClientAWS(),$this->getMethodName()]));
        } catch (\Exception $e) {
            //Se setean los errores
            $this->setErros($e->getMessage());
        }
        
    }
}
