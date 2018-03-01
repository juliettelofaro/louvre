<?php

namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

//journée demi-journée

class canBeFullDayValidator extends ConstraintValidator
{
  
    
    public function validate($booking, Constraint $constraint)
    {
        $today = new \DateTime();
        if ($booking->getDatedevisite()->format('Ymd') == $today->format('Ymd')&&
           $today->format('H') >= 14 &&
            $booking->getDuree() === true
            ) {
            $this->context->buildViolation($constraint->message)
            ->atPath('duree')
            ->addViolation();
        }
    }
}