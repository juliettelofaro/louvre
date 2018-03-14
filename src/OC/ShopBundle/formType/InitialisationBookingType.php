<?php

namespace OC\ShopBundle\formType;

use OC\ShopBundle\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




 

class InitialisationBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datedevisite', DateType::class, array(
            'widget' => 'single_text',
            'label' => 'Date de la visite : '
        ))
        ->add('duree', ChoiceType::class, array(
            'label' => 'Durée : ',
            'choices'  => array(
                'Journée' => true,
                'Demi-journée' => false)))
                ->add('nbTickets',TextType::class, array('label' => 'Nombre de ticket (10 max.) : '))
                ->add('email', EmailType::class, array ('label' => 'Adresse e-mail :'));

    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,
        ));
    }
}