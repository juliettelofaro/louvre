

<?php

//validateur pour les 1000bookings

namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class noHolidayValidator extends ConstraintValidator
{
     public function quotaAction(Request $request){
        define("MAX_BOOKING_DATE", 1000);

     if ("MAX_BOOKING_DATE" >= 1000) {
            $this->context->addViolation($constraint->message);
        }
    }
}