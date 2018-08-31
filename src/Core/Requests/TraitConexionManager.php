<?php

namespace FuriosoJack\MasterModelsAWS\Core\Requests;

use FuriosoJack\MasterModelsAWS\Core\Client\Basic\ClientBasic;
/**
 * Trait del cliente de conexion de la solicitud
 *
 * @package FuriosoJack\MasterModelsAWS\Core\Requests\Parameters
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
trait TraitConexionManager
{

    /*
     * Cliente de conexion
     */
    protected $clientConexion;

 
    /*
     * Establece el cliente de conexion
     * @param FuriosoJack\MasterModelsAWS\Core\Client\Basic\ClientBasic cliente de conexion
     */
    public function setClientConexion(ClientBasic $conexion)
    {
        $this->clientConexion = $conexion;

    }

    /**
     * Retorna la conexion
     * @return App\Repository\Structures\Amazon\Abstracts\AbstractClientAmazon $conexion
     */
    protected function getClientConexion(): ClientBasic
    {
        return $this->clientConexion;
    }

    
   
}
