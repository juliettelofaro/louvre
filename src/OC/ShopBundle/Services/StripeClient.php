<?php

/*Un service est juste une class que l'on appelle. Pourquoi ne pas le mettre dans le controller ? Pour faire plus propre . bref. On le déclare ensuite au conteneur de services. Pour récupérer ce service ds le controller on fait :
$antispam = $this->container->get('oc_platform.antispam');*/

namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class StripeClient
{
	
}