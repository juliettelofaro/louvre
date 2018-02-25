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
    public function startAction(Request $request)
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

    public function newAction(Request $request)
    {
         return $this->render('shop/new.html.twig');
    }



    public function sendBillet()
    {
        $sendmail = $this->container->get('oc_shop.envoimail');
    }


     public function paymentAction(Request $request)
    {
        dump($this->get('session')->get('TotalPrice'));
        $form = $this->get('form.factory')
        ->createNamedBuilder('payment-form')
        ->add('token', HiddenType::class, [
            'constraints' => [new NotBlank()],
        ])
        ->add('submit', SubmitType::class)
        ->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $this->get('oc_shop.stripeclient')->createCharge([
                        'email' => 'juliette.lofaro@gmail.com',
                        'amount' =>  $this->get('session')->get('TotalPrice')
                    ], $form->get('token')->getData()); 
                    return $this->redirectToRoute('oc_shop_submit');   
                } catch (\Stripe\Error\Base $e) {
                    $this->addFlash('warning', sprintf('Unable to take payment, %s', $e instanceof \Stripe\Error\Card ? lcfirst($e->getMessage()) : 'please try again.'));
                }
            }
        }
        return $this->render('shop/paymentForm.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ]);
    }

    public function endAction(Request $request)
    {
       
        return $this->render('shop/end.html.twig');
    }

}
