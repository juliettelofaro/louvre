<?php

namespace OC\ShopBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use OC\ShopBundle\Entity\Booking;

class NoFullValidator extends ConstraintValidator
{
//ta methode getNbTicketsPerDay() ne prend pas la date à tester en parametre

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Booking $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        $ticketsRepo = $this->em->getRepository(Ticket::class);
        $nbTodayTickets = $ticketsRepo->getNbTicketsPerDay();

        // Si nb de tickets vendus supérieur à 1000
        if (($nbTodayTickets + $booking->getNbTickets()) > Booking::MAX_TICKETS_PER_DAY) {
            $this->context->buildViolation($constraint->message)
                ->atPath('nbTickets')
                ->addViolation();
        }
    }
}