<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;

use FuriosoJack\MasterModelsAWS\Core\Requests\TraitConexionManager;
use FuriosoJack\MasterModelsAWS\Core\Requests\TraitParameterManager;

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
        //Llama al metodo del objeto del cliente AWS, para llamarlo se usa el nombre del metodo y se pasa los parametros necesarios para el funcionamiento
        return call_user_func([$this->getClientConexion()
                ->getClientAWS(),$this->getMethodName()]);       

    }
}
