<?php

namespace OC\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\NotBlank;
use OC\ShopBundle\Entity\Ticket;
use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\formType\InitialisationBookingType;
use OC\ShopBundle\formType\AddBookingTicketsType;
use OC\ShopBundle\formType\TicketType;

class BookingController extends Controller
{
    public function homeAction(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm(InitialisationBookingType::class, $booking);
        $form->handleRequest($request);
         /*if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();          
            $this->get('session')->set('Booking', $booking);
            return $this->redirectToRoute('oc_shop_ticket');
             }*/
        return $this->render('shop/start.html.twig', array(
        'form' => $form->createView()
        ));       
    }

    public function selectTicketsAction(Request $request)
    {
        $ticket = new Ticket();
         $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        return $this->render('shop/new.html.twig', array(
        'form' => $form->createView()
        ));
    }



    public function sendBillet()
    {
        $sendmail = $this->container->get('oc_shop.envoimail');
    }




     public function recapAction(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_E7H0GHx7r68yjVjBdhxxFF7f");

        $charge = \Stripe\Charge::create(

    array(
            "amount" => 2000,
            "currency" => "eur",
            "source" => "tok_mastercard", // obtained with Stripe.js
            "description" => "Paiement de test"
        ));

        return $this->render('shop/paymentForm.html.twig');   
    }




















/*

    public function sendBillet($email, $booking, $total_price)
    {
        $message = \Swift_Message::newInstance()->setSubject('Billet de réservation')
        ->setFrom([
            'juliette.lofaro@gmail.com' => 'Vos billets - Confirmation de votre commande '
        ])
        ->setTo($email)
        ->setCharset('utf-8')
        ->setContentType('text/html')
        ->setBody($this->renderView('shop/booking_billet.html.twig', [
            'booking' => $booking,
            'total_price' => $total_price
        ]));        
        return $this->get('mailer')->send($message);
    }

*/

    public function confirmationAction(Request $request)
    {       
        return $this->render('shop/end.html.twig');
    }
}
