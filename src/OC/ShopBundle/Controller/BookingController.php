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
         if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData(); 
            //ici faire le rray collection des tickets vides
            $this->get('session')->set('Booking', $booking);
            return $this->redirectToRoute('oc_shop_ticket');
        }
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
         if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();          
            $this->get('session')->set('Booking', $booking);
            $totalPrice = 0;
            foreach ($booking->getTickets() as $ticket) {
                $totalPrice += $ticket->getAgeType();
            }
           
            $this->get('session')->set('TotalPrice', $totalPrice);
            $this->get('session')
            ->getFlashBag()
            ->add('notice', 'La réservation a bien été effectuée!');
            return $this->redirectToRoute('oc_shop_payment');
        }
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



    public function confirmationAction(Request $request)
    {       
        /*$session = $request->getSession();
        $booking = $session->get('Booking');
        $booking->setDate(new \DateTime($session->get('date')));

        $booking->setType($session->get('day'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();
        $this->container->get('oc_shop.envoimail')->($booking->getEmail(), $booking, $session->get('TotalPrice'));
        return $this->render('shop/end.html.twig');*/
    }
}