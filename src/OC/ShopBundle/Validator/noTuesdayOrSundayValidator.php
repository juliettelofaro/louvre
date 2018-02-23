<?php
namespace ShopBundle\Validator

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;



class noTuesdayOrSundayValidator extends ConstraintValidator
{
    // Renvoie false si le billet est acheter pour un mardi ou un dimanche
    public function validate($dateTime, Constraint $constraint)
    {
        if (!$dateTime instanceof \DateTime){
            $dateTime = new \DateTime($dateTime);
        }
        $timestamp = $dateTime->getTimestamp();
        $date = strftime('%A %d %B', $timestamp);
        $tuesday = explode(" ", $date);
        if ($tuesday[0] === "Tuesday" || $tuesday[0] === "Sunday") {
            $this->context->addViolation($constraint->message);
        }
    }
}