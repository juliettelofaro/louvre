<?php

//validateur pour les jour fériés

namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class noHolidayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un jour férié
    public function validate($dateTime, Constraint $constraint)
    {
        $holidays = ['2016-05-01', '2016-11-01', '2016-12-25'];
        $holiday = [];
        if (!$dateTime instanceof \DateTime){
            $dateTime = new \DateTime($dateTime);
        }
        $timestamp = $dateTime->getTimestamp();
        $date = strftime('%d %B', $timestamp);
        for ($i = 0; $i < count($holidays); $i++) {
            $holiday[$i] = strftime('%d %B', strtotime($holidays[$i]));
        }
        if ($date === $holiday[0] || $date === $holiday[1] || $date === $holiday[2]) {
            $this->context->addViolation($constraint->message);
        }
    }
}