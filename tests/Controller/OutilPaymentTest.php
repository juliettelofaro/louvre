<?php

namespace OC\ShopBundle\Tests\Controller;
use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use OC\ShopBundle\Services\OutilPayment;
use PHPUnit\Framework\TestCase;
use \Datetime;

class OutilPaymentTest extends TestCase
{
    public function testcalculPrixCommande()
    {
        //creation d'un tiket
        //
        $booking = new Booking();
        $ticket = new Ticket();

        $dateDeNaissance = new DateTime('02/31/2015');
        echo gettype($dateDeNaissance).'<br>';

        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);

        $dateDeVisite = new DateTime('06/06/2018');
        echo gettype($dateDeVisite).'<br>';

        $booking->setDatedevisite($dateDeVisite);
        $ticket->setBooking($booking);

        $outilPayment = new OutilPayment();
        $prixTotal = $outilPayment->calculPrixCommande($booking);


        $this->assertSame(0, $prixTotal);



    }
}
