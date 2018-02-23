<?php

namespace OC\ShopBundle\formType;

use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('prenom', TextType::class, array('label' => 'Prénom : '));
        $builder->add('nom', TextType::class, array('label' => 'Nom : '));
        $builder->add('datenaissance',DateType::Class, array(
            'widget' => 'choice',
            'years' => range(1918, 2017),
            'months' => range(date('m'), 12),
            'days' => range(1, 31),
            'label' => 'Date de naissance :',
        ));
        $builder->add('reduit', CheckboxType::class, array('label' => 'Tarif réduit ', 'required' => false));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }
}