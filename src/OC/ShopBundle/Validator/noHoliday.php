<?php

//validateur pour les jour fériés


namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */

class noHoliday extends Constraint
{
    public $messageClosedMuseum = "Impossible de réserver ce jour, le musée étant fermé.";
    public $messageClosedOrder  = "Impossible de réserver ce jour, les résevations en ligne étant fermées pour les jours fériés et les dimanches";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}


?>