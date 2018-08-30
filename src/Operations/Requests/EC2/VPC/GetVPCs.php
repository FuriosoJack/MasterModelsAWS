<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Requests\EC2\VPC;

use FuriosoJack\MasterModelsAWS\Core\Requests\BasicRequest;
 /**
 * Parametros para Obtener las VPCS
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
}
