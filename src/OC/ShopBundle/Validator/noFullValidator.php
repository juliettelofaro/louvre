

<?php

//validateur pour les 1000bookings

namespace OC\ShopBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class noFullValidator extends ConstraintValidator
{
     public function quotaAction(Booking $booking){
        define("MAX_BOOKING_DATE", 1000);

         $datedevisite = $booking->getDatedevisite();
         $totalReservations = $this->commandGateway->countReservationAt($datedeisit);
         if ($command->getNumberOfVisitors() + $totalReservations > 1000) {
             throw new TooManyReservationsException(1000 - $totalReservations);
    }
}