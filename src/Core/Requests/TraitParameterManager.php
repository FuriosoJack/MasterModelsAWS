<?php
namespace FuriosoJack\MasterModelsAWS\Core\Requests;
use FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic;
/**
 * Trait Para el control de los parametros que se le van a pasar al metodo del cliente
 * 
 * @package FuriosoJack\MasterModelsAWS\Core\Requests
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
trait TraitParameterManager {
    
    /**
     * Objeto que represena los parametros de la solicitud
     * @var FuriosoJack\MasterModelsAWS\Core\Requests\Parameters\ParameterBasic $parameter objetos parametros
     */
    protected $parameter;
    
    /**
     * Añade el objeto de los parametros
     * @param ParameterBasic $parameter
     */
    public function setPrameter(ParameterBasic $parameter)
    {
        $this->parameter = $parameter;
    }
    
    
    /**
     * Retorna el objeto de los parametros de la solicitud
     * @return ParameterBasic
     */
    protected function getParameter(): ParameterBasic
    {
        return $this->parameter;
    }
}
