<?php

namespace BH3Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PalmaresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game', ChoiceType::class, array(
                'choices' => array(
                    'CS:GO' => 'CS:GO',
                    'Rocket League' => 'Rocket League',
                    'Call of Duty' => 'Call of Duty',
                    'Fifa' => 'Fifa',
                    'Battlefield' => 'Battlefield',
                    'Halo' => 'Halo',
                    'Titanfall' => 'Titanfall'
                )
            ))
            ->add('roster', TextType::class)
            ->add('event', TextType::class)
            ->add('localisation', TextType::class)
            ->add('ranking', TextType::class)
            ->add('date', IntegerType::class)
            ->add('submit', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BH3Bundle\Entity\Palmares'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bh3bundle_palmares';
    }


}
