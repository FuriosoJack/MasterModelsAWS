<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC\Parameters;
use FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic;

/**
 * Parametros para Obtener las VPCS
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC\Parameters
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.1
 * @access public
 */
class ParameterGetVPC extends ParameterBasic{
 
    protected function initParametersRequired()
    {
        $this->parametersOptional = [
            'Filters'
        ];
    }
}
