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

// com

class InitialisationBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom', TextType::class, array('label' => 'Prénom : '));
        $builder->add('nom', TextType::class, array('label' => 'Nom : '));
        $builder->add('email', EmailType::class, array('label' => 'Adresse mail : ')); 
        $builder->add('datedevisite', TextType::class, array('label' => 'Date de visite : '));
        $builder->add('duree', TextType::class, array('label' => 'Durée : '));
        $builder->add('save', SubmitType::class, array('label' => 'Valider'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,
        ));
    }
}