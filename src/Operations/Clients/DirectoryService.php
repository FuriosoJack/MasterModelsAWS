<?php
namespace FuriosoJack\MasterModelsAWS\Operations\Clients;

use FuriosoJack\MasterModelsAWS\Core\Client\Basic\ClientBasic;

/**
 * Clase cliente de directorio activo
 *
 * @package FuriosoJack\MasterModelsAWS\Operations\Clients
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 * @version 1.0.0
 * @access public
 */
class DirectoryService extends ClientBasic{

  public function getClientClass()
  {
    return DirectoryServiceClient::class;
  }

}
