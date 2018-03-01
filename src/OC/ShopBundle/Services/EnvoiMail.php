<?php


namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class EnvoiMail
{

public function indexAction($name)
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


