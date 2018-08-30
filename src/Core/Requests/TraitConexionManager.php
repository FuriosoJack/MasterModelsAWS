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
    public function getClientConexion(): ClientBasic
    {
        return $this->clientConexion;
    }

    /*
     * Debe devolver el nombre de metodo que se desea ejecutar
     * @return string nombre del metodo a ejecutar en el cliente
     */
    protected abstract function getMethodName(): String;
  


   






}
