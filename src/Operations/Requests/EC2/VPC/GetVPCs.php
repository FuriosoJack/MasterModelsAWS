<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC;

use FuriosoJack\MasterModelsAWS\Core\Requests\BasicRequest;
use FuriosoJack\MasterModelsAWS\Core\Requests\ParameterBasic;
 /**
 *  Solicitud de obtener VPCs
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.1
 * @access public
 */
class GetVPCs extends BasicRequest {
    
    
    protected function getMethodName(): String
    {
        return 'describeVpcs';       
    }
    
    protected function builderParameter(): ParameterBasic
    {        
        return new  ParameterBasic([
            'optional' => [
                'Filters'
            ]
        ]);
    }
}
