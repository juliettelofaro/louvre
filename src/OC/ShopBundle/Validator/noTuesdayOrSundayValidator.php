<?php


namespace OC\ShopBundle\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;



class noTuesdayOrSundayValidator extends ConstraintValidator
{

    public function day($booking, Constraint $constraint)
    {
       /*
        $daytime = new \DateTime();
        $day = $datetime->format('N');
        if ($booking->getDatedevisite()->format('N') == $day=== 2 || $day === 7)
        {
            $this->context->addViolation($constraint->message);

        }*/
    }

    public function getClosedDays() {
        return $this->closedDays;
    }
}