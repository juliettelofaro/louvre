<?php

namespace OC\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use OC\ShopBundle\Entity\Ticket;
use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\formType\InitialisationBookingType;
use OC\ShopBundle\formType\AddBookingTicketsType;
use OC\ShopBundle\formType\TicketType;
use OC\ShopBundle\Services\OutilPayment;
use OC\ShopBundle\Services\EnvoiMail;
use Symfony\Component\Form\FormView;

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
            return $this->redirectToRoute('oc_shop_new');
        }
        return $this->render('shop/start.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function selectTicketsAction(Request $request, OutilPayment $outilPayment)
    {
        $session = $request->getSession();
        $booking = $session->get('Booking');
        for ($i = 1; $i <= $booking->getNbTickets(); $i++) {
            $ticket = new Ticket();
            $booking->addTicket($ticket);
        }

        $form = $this->createForm(AddBookingTicketsType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //appel service de paiement
            $outilPayment->calculPrixCommande($booking);

            
            $this->get('session')->set('Booking', $booking);
            $this->addFlash('notice', 'La réservation a bien été effectuée!');
            return $this->redirectToRoute('oc_shop_payment', array(
            'Booking' => $booking,
            ));

        }

        return $this->render('shop/new.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function recapAction(Request $request, SessionInterface $session, EnvoiMail $envoiMail)
    {
        $booking = $session->get('Booking');
        $this->get('session')->set('PrixTotal', $booking->getPrixTotal());
echo 'cest booking: '. $booking->getPrixTotal();

        if ($request->isMethod('POST')){
             try {
                 $token = $request->get('stripeToken');
                 $prixTotal = $booking->getPrixTotal();
                 \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));
                 $charge = \Stripe\Charge::create(
                     array(
                         "amount" => $prixTotal*100,
                         //(int)$booking->getPrixTotal()
                         //$booking->getPrixTotal()
                         //$this->get('session')->get('PrixTotal')
                         "currency" => "eur",
                         "source" => "tok_mastercard",
                         "description" => "Paiement de test"
                     ));



                 /*sauvegarde en bbd*/
                 $em = $this->getDoctrine()->getManager();
                 $em->persist($booking);
                 $em->flush();
                 dump($em);

                 //envoie du mail

                 $mailer = $this->container->get('mailer');

                 $envoiMail->checkAction($booking->getEmail());

                 return $this->redirectToRoute('oc_shop_end');

             } catch (\Exception $e) {

                 // retourner sur la meme page en GET
                 $this->addFlash("error", "Votre commande n'a pas été validée, nous vous invitons à refaire votre demande.");
                 $token = $request->get('stripeToken');

                 return $this->redirectToRoute('oc_shop_payment');
             }


        }
        else
        {

            return $this->render('shop/paymentForm.html.twig', [
                'Booking' => $booking
            ]);
        }
    }


    public function confirmationAction(Request $request, SessionInterface $session)
    {
        //recuperer booking depuis session
        $booking = $session->get('Booking');

        // vide la session
        $session = $request->getSession();

        $session->invalidate();

        return $this->render('shop/end.html.twig', [
                'booking' => $booking
            ]
        );


    }


}