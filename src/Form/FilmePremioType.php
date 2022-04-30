<?php

namespace App\Form;

use App\Entity\Filme;
use App\Entity\Premio;
use App\Entity\FilmePremio;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FilmePremioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ano', IntegerType::class, [
                'label' => 'Ano'
            ])
            ->add('filme', EntityType::class, [
                'class' => Filme::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.titulo', 'ASC');
                },
                'choice_label' => 'titulo',
                'label' => 'Filme',
                'placeholder' => 'Escolha o filme.',
            ])
            ->add('premio', EntityType::class, [
                'class' => Premio::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.descricao', 'ASC');
                },
                'choice_label' => 'descricao',
                'label' => 'Prêmio',
                'placeholder' => 'Escolha o prêmio.',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilmePremio::class,
        ]);
    }
}
