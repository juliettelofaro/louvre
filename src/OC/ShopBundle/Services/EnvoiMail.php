<?php


namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\Exception\Exception;

class EnvoiMail
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
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
        ->setBody($this->renderView('shop/booking_billet.html.twig'));

     $this->mailer->send($message);


}
}


