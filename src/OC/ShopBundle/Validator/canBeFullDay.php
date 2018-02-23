<?php

//validateur pour les 14H


namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class canBeFullDay extends Constraint
{
	public $message = "Il n'est pas possible de commander un billet journée après 14H00";
}


?>