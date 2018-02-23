<?php


namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class EnvoiMail
{

    private $email;
    private $booking;
    private $total_price;

	   $message = \Swift_Message::newInstance()->setSubject('Billet de réservation')
        ->setFrom([
            'juliette.lofaro@gmail.com' => 'Vos billets - Confirmation de votre commande '
        ])
        ->setTo($email)
        ->setCharset('utf-8')
        ->setContentType('text/html')
        ->setBody($this->renderView('OCShopBundle:Emails:booking_billet.html.twig', [
            'booking' => $booking,
            'total_price' => $total_price
        ]));        
        return $this->get('mailer')->send($message);
}