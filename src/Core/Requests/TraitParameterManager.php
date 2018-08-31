<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;
use FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic;
/**
 * Trait Para el control de los parametros de envio que va a tener la solicitud, vpcid, instanceid, etc
 * 
 * @package FuriosoJack\MasterModelsAWS\Core\Requests
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 * 
 */
trait TraitParameterManager {
    
    /**
     * Parametros de la solicitud
     * @var FuriosoJack\MasterModelsAWS\Core\Requests\Parameters\ParameterBasic $parameter objetos parametros
     */
    private $parameter;
    
    /**
     * Añade el objeto de los parametros
     * @param ParameterBasic $parameter
     */
    private function setParameter(ParameterBasic $parameter)
    {
        $this->parameter = $parameter;
    }
    
    
    /**
     * Retorna el objeto de los parametros de la solicitud
     * @return ParameterBasic
     */
    private function getParameter(): ParameterBasic
    {
        return $this->parameter;
    }
    
    /**
     * Metodo encargado de devolver el parameter que se va a usar
     * Este metodo deber ser sobrecargado por los hijos
     * @return FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic $parameter
     */
    protected abstract function builderParameter():ParameterBasic;
}
