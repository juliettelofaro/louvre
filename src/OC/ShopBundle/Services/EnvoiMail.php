<?php


namespace OC\ShopBundle\Services;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class EnvoiMail //extends \Twig_Extension
{
    protected $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function checkAction($email)
    {
	    $message = \Swift_Message::newInstance()
        ->setSubject('Billet de réservation')
        ->setFrom('juliette.lofaro@gmail.com')
        ->setTo($email)
        ->setCharset('utf-8')
        ->setContentType('text/html')
        ->setBody($this->twig->render('shop/booking_billet.html.twig'));
        $this->mailer->send($message);
    }
}


