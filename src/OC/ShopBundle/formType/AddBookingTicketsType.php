<?php

namespace OC\ShopBundle\formType;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AddBookingTicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $booking = new Booking();
            $ticket = new Ticket();
            $booking->getTickets()->add($ticket);
    }
   
}