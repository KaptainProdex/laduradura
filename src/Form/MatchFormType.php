<?php

namespace App\Form;


use App\Dto\Form\MatchDto;
use App\Entity\Hero;
use App\Entity\Map;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'heroes',
                EntityType::class,
                [
                    'class' => Hero::class,
                    'multiple' => true,
                ]
            )
            ->add(
                'season',
                EntityType::class,
                [
                    'class' => Season::class,
                ]
            )
            ->add(
                'map',
                EntityType::class,
                [
                    'class' => Map::class,
                ]
            )
            ->add(
                'season_rank',
                IntegerType::class
            );
    }

    public function getName(): string
    {
        return 'match';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MatchDto::class,
            'csrf_protection' => false,
        ]);

    }
}
