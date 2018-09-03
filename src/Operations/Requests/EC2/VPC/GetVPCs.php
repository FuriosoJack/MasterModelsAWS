<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC;

use FuriosoJack\MasterModelsAWS\Core\Requests\BasicRequest;
use FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\AbstractRequestEC2;
 /**
 *  Solicitud de obtener VPCs
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.1
 * @access public
 */
class GetVPCs extends AbstractRequestEC2 {
    
    
    protected function getMethodName(): String
    {
        return 'describeVpcs';       
    }
    
    protected function getParameters(): array
    {        
        return [
            'optional' => [
                'Filters'
            ]
        ];
    }
}
