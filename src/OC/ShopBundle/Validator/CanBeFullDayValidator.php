<?php

namespace OC\ShopBundle\Validator;

use OC\ShopBundle\Entity\Booking;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

//journée demi-journée

class CanBeFullDayValidator extends ConstraintValidator
{
    public function validate($booking, Constraint $constraint)
    {
        $today = new \DateTime();
        if ($booking->getDatedevisite()->format('Ymd') == $today->format('Ymd') &&
            $today->format('H') >= Booking::LIMIT_HALF_DAY_HOUR &&
            $booking->getDuree() === true
        ) {
            $this->context->buildViolation($constraint->message)
                ->atPath('duree')
                ->addViolation();
        }
    }
}