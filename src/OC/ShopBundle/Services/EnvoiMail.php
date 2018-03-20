<?php


namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class EnvoiMail
{
    protected $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

public function checkAction($email)
{

	   $message = \Swift_Message::newInstance()
        ->setSubject('Billet de réservation')
        ->setFrom('juliette.lofaro@gmail.com')
        ->setTo($email)
        ->setCharset('utf-8')
        ->setContentType('text/html')
        ->setBody(
            $this->renderView('shop/booking_billet.html.twig')); 

      $this->get('mailer')->send($message);


}
}


