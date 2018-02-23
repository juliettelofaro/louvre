<?php

//validateur pour les 1000 bookings


namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class noFull extends Constraint
{
	public $message = 'Vous ne pouvez pas commander de billet car ce jour est complet.'; 
}


?>