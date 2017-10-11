<?php

namespace BH3Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('rank', TextType::class, array('required' => false))
            ->add('twitter', TextType::class, array('required' => false))
            ->add('profile', UrlType::class, array('required' => false))
            ->add('picture', FileType::class, array('required' => false))
            ->add('plateforme', ChoiceType::class, array(
                'choices' => array(
                    'Xbox' => 'xbox',
                    'PC' => 'steam',
                    'Site web' => 'website'
                )
            ))
            ->add('staff', CheckboxType::class, array('required' => false))
            ->add('roster', EntityType::class, array(
                'class' => 'BH3Bundle:Roster',
                'choice_label' => 'name'
            ))
            ->add('submit', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BH3Bundle\Entity\Membre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bh3bundle_membre';
    }


}
