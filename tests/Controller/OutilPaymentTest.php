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
        //GRATUIT

        $booking = new Booking();
        $ticket = new Ticket();

        $dateDeNaissance = new DateTime('02/31/2015');


        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);

        $dateDeVisite = new DateTime('06/06/2018');



        $booking->setDatedevisite($dateDeVisite);
        $ticket->setBooking($booking);

        $outilPayment = new OutilPayment();
        $prixTotal = $outilPayment->calculPrixCommande($booking);

        $this->assertSame(0, $prixTotal);
        $booking->removeTicket($ticket);


        $dateDeNaissance = new DateTime('02/31/1995');
        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);
        $prixTotal = $outilPayment->calculPrixCommande($booking);
        $this->assertSame(16, $prixTotal);
        $booking->removeTicket($ticket);


        //TARIF ENFANT
        $dateDeNaissance = new DateTime('02/31/2009');
        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);
        $prixTotal = $outilPayment->calculPrixCommande($booking);
        $this->assertSame(8, $prixTotal);
        $booking->removeTicket($ticket);

        //TARIF NORMAL
        $dateDeNaissance = new DateTime('02/31/1995');
        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);
        $prixTotal = $outilPayment->calculPrixCommande($booking);
        $this->assertSame(16, $prixTotal);
        $booking->removeTicket($ticket);

        //TARIF SENIOR
        $dateDeNaissance = new DateTime('02/31/1950');
        $ticket->setDatedenaissance($dateDeNaissance);
        $booking->addTicket($ticket);
        $prixTotal = $outilPayment->calculPrixCommande($booking);
        $this->assertSame(12, $prixTotal);
        $booking->removeTicket($ticket);

        //TARIF REDUIT
        $reduit = true;
        $ticket->setReduit($reduit);
        $booking->addTicket($ticket);
        $prixTotal = $outilPayment->calculPrixCommande($booking);
        $this->assertSame(10, $prixTotal);
        $booking->removeTicket($ticket);
    }
}
