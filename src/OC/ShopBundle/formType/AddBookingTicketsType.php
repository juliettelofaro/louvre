<?php

namespace OC\ShopBundle\formType;

use OC\ShopBundle\Entity\Booking;use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OC\ShopBundle\formType\TicketType;



class AddBookingTicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tickets', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type' => TicketType::class,
            ),
        ));
    }
   
   public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => Booking::class,
    ));
}
}