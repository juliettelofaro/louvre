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


 

class InitialisationBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       # $builder->add('prenom', TextType::class, array('label' => 'Prénom : '));
       # $builder->add('nom', TextType::class, array('label' => 'Nom : '));
       # $builder->add('email', EmailType::class, array('label' => 'Adresse mail : ')); 
        $builder->add('datedevisite', DateType::class, array(
            'widget' => 'choice',
            'years' => range(1918, 2017),
            'months' => range(1, 12),
            'days' => range(1, 31),
            'label' => 'Date de naissance :',
        ));
       # $builder->add('duree', TextType::class, array('label' => 'Durée : '));
       # $builder->add('save', SubmitType::class, array('label' => 'Valider'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,
        ));
    }
}