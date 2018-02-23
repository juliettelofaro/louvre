<?php

//validateur pour les jour fériés


namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class noHoliday extends Constraint
{
	 public $message = 'Vous ne pouvez pas commander de billet un jour férié.'; 
}


?>