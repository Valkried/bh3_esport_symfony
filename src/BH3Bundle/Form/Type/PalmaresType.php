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
                    'Battlefield' => 'Battlefield',
                    'Call of Duty' => 'Call of Duty',
                    'CS:GO' => 'CS:GO',
                    'DragonBall FighterZ' => 'DragonBall FighterZ',
                    'Fifa' => 'Fifa',
                    'Halo' => 'Halo',
                    'Overwatch' => 'Overwatch',
                    'Rainbow Six Siege' => 'Rainbow Six Siege',
                    'Rocket League' => 'Rocket League',
                    'Street Fighter 5' => 'Street Fighter 5',
                    'Titanfall' => 'Titanfall',
                    'Versus Fighting' => 'Versus Fighting',
                ),
            ))
            ->add('roster', TextType::class)
            ->add('event', TextType::class)
            ->add('localisation', TextType::class)
            ->add('geography', TextType::class)
            ->add('ranking', TextType::class)
            ->add('datetime', TextType::class)
            ->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BH3Bundle\Entity\Palmares',
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
