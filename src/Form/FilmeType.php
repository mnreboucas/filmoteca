<?php

namespace App\Form;

use App\Entity\Filme;
use App\Entity\Genero;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FilmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class, [
                'label' => 'Título do filme'
            ])
            ->add('ano', IntegerType::class, [
                'label' => 'Ano'
            ])
            ->add('pais', CountryType::class, [
                'label' => 'País de origem',
                'placeholder' => 'Selecione o país...'
            ])
            ->add('diretor', TextType::class, [
                'label' => 'Diretor'
            ])
            ->add('observacao', TextType::class, [
                'label' => 'Observação',
                'required' => false
            ])
            ->add('localizacao', TextType::class, [
                'label' => 'Guardado onde?'
            ])
            ->add('genero', EntityType::class, [
                'class' => Genero::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.descricao', 'ASC');
                },
                'choice_label' => 'descricao',
                'label' => 'Gênero',
                'placeholder' => 'Escolha o gênero',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filme::class,
        ]);
    }
}
