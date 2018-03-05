<?php

//validateur pour les 1000 bookings


namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class NoFull extends Constraint
{
	public $message = 'Vous ne pouvez pas commander de billet car ce jour est complet.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}


?>