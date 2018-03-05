

<?php

//validateur pour les 1000bookings

namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class noFullValidator extends ConstraintValidator
{
    public function ticketsNumberValidation(Booking $booking, $constraint)
    {
        $tickets = $booking->getTickets();
        $ticketsRepo = $this->em->getRepository('OC\ShopBundle\Repository\TicketRepository');
        $nbTodayTickets = $ticketsRepo->getNbTicketsPerDay();

        // Si nb de tickets vendus supérieur à 1000
        if (($nbTodayTickets + $order->getNbTickets()) > 1000) {
            $this->context->buildViolation($constraint->message);
        }
    }
}