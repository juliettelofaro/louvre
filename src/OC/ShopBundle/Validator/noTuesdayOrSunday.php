<?php

//validateur pour mardis et dimanches


namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class noTuesdayOrSunday extends Constraint
{
	public $message = 'Vous ne pouvez pas commander de billet pour un mardi ou un dimanche.';
}


?>