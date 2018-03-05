<?php

namespace OC\ShopBundle\formType;

use OC\ShopBundle\Entity\Booking;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            'entry_type' => TicketType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            'label'        => 'Liste des tickets :')
        );
    }
   
   public function configureOptions(OptionsResolver $resolver)
    {
         $resolver->setDefaults(array(
             'data_class' => Booking::class,
         ));
    }
}