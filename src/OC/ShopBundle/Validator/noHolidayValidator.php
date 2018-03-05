<?php

//validateur pour les jour fériés

namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use OC\ShopBundle\Entity\Ticket;
use OC\ShopBundle\Entity\Booking;

class noHolidayValidator extends ConstraintValidator
{
    protected $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($booking, Constraint $constraint)
    {
        $this->dateIsValid($booking->getDatedevisite(), $constraint);
    }



    public function getHolidayDays($orderVisitDate)
    {
        $year = $orderVisitDate->format('Y');
        $easterDate = new \DateTime();
        $easterDate = $easterDate->setTimestamp(easter_date($year));
        $easterMonday = $easterDate->modify('+1 day');
        $easterMonday = $easterMonday->format('d-m');
        $ascension = $easterDate->modify('+38 day');
        $ascension = $ascension->format('d-m');
        $pentecote = $easterDate->modify('+11 day');
        $pentecote = $pentecote->format('d-m');
        return ['01-01',$easterMonday,'08-05',$ascension,$pentecote,'14-07','15-08','11-11'];
    }
    public function getClosedDays()
    {
        return ['01-05','01-11','25-12'];
    }

    public function dateIsValid($orderVisitDate, $constraint)
    {
        $visitDate = $orderVisitDate->format('d-m');
        $visitDay = $orderVisitDate->format('N');
        $closedDays = $this->getClosedDays();
        $forbiddenDays = $this->getHolidayDays($orderVisitDate);
        if ($visitDay == 2 || in_array($visitDate, $closedDays)) {
            $this->context->buildViolation($constraint->messageClosedMuseum)->atPath('visitDate')->addViolation();
        } elseif ($visitDay == 7 || in_array($visitDate, $forbiddenDays)) {
            $this->context->buildViolation($constraint->messageClosedOrder)->atPath('visitDate')->addViolation();
        }
    }
}