<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Clients;

use Aws\Ec2\Ec2Client;
use FuriosoJack\MasterModelsAWS\Core\Client\Basic\ClientBasic;

/**
 * Clase de Cliente para EC2
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Clients
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
class EC2 extends ClientBasic{

  protected function getClientClass()
  {
    return Ec2Client::class;
  }

}
