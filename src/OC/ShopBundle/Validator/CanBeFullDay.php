<?php

//validateur pour les 14H


namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class CanBeFullDay extends Constraint
{
    public $message = "Il n'est pas possible de commander un billet journée après 14H00";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}


?>