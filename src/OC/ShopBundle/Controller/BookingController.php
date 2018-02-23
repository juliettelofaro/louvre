<?php

namespace OC\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingController extends Controller
{
    public function startAction()
    {
        return $this->render('shop/start.html.twig');
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
        return $this->render('OCShopBundle:Form:paymentForm.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ]);
    }
}
