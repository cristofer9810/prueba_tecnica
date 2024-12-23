<?php

namespace App\Form;

use App\Entity\Estudiantes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class EstudianteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nombre', TextType::class, [
            'label' => 'Nombre del Estudiante',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('salon', TextType::class, [
            'label' => 'Salón',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('acudiente', TextType::class, [
            'label' => 'Acudiente',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('edad', IntegerType::class, [
            'label' => 'Edad',
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                    new NotBlank(['message' => 'La edad no puede estar vacía']),
                    new Range([
                        'min' => 1,
                        'max' => 16,
                        'minMessage' => 'La edad no puede ser menor a {{ limit }}',
                        'maxMessage' => 'La edad no puede ser mayor a {{ limit }}',
                    ])
                ]
            ])
        ->add('genero', ChoiceType::class, [
            'choices' => [
                'Masculino' => 'Masculino',
                'Femenino' => 'Femenino',
            ],
            'label' => 'Género',
            'expanded' => true, 
            'attr' => ['class' => 'form-check'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estudiantes::class,
        ]);
    }
}
