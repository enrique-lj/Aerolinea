<?php

namespace App\Form;

use App\Entity\Vuelo;
use App\Entity\Avion;
use App\Entity\Ruta;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\Persistence\ManagerRegistry;





class VueloType extends AbstractType
{
    public function __construct(private ManagerRegistry $doctrine)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avion',EntityType::class, [
                'attr' => ['class' => 'form-control'],
                'class' => Avion::class,
                'choices' => $this->doctrine->getRepository(Avion::class)->findAll(),
                ])
            ->add('ruta',EntityType::class, [
                'attr' => ['class' => 'form-control'],
                'class' => Ruta::class,
                'choices' => $this->doctrine->getRepository(Ruta::class)->findAll(),                    
                ])
            ->add('fecha_salida', DateTimeType::class, [
                'attr' => ['class' => 'borderradius'],
                'label_attr' => ['class' => 'text-primary'],
                'date_label' => false,
                'time_label' => false,
                'widget' => 'single_text',             
                ])
            ->add('fecha_llegada', DateTimeType::class, [
                'attr' => ['class' => 'borderradius'],
                'label_attr' => ['class' => 'text-primary'],
                'date_label' => false,
                'time_label' => false,
                'widget' => 'single_text',             
                ])
                          
            ->add('estado', TextType::class, [
                    'attr' => ['placeholder' => 'Máximo 75 caracteres','class' => 'borderradius'],
                    'label_attr' => ['class' => 'text-primary'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Por favor introduzca un estado.',
                        ]),
                        new Length([
                            'maxMessage' => 'El estado es demasiado largo. Maximo  {{ limit }} caracteres.',
                            // max length allowed by Symfony for security reasons
                            'max' => 75,
                        ]),
                    ],
                ])
            ->add('precio_base', TextType::class,[
                'attr' => ['placeholder' => 'Debe ser en cms','class' => 'borderradius'],
                'label_attr' => ['class' => 'text-primary'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduzca un precio mínimo.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vuelo::class,
        ]);
    }
}
