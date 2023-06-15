<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class,[
        'attr' => ['placeholder' => 'example@gmail.com','class' => 'ml-75 borderradius mt-3'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor introduzca un correo.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'required' => false,
            'attr' => ['autocomplete' => 'new-password','placeholder' => 'Mínimo 6 caracteres','class' => 'ml-50 mt-3 borderradius'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor introduzca una contraseña.',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Su contraseña es demasiado corta',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('dni', TextType::class, [
            'attr' => ['class' => 'ml-90 mt-3 borderradius'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor introduzca un dni.',
                ]),
                new Length([
                    'maxMessage' => 'Su dni es demasiado largo.',
                    // max length allowed by Symfony for security reasons
                    'max' => 75,
                ]),
            ],
        ])
        ->add('nombre', TextType::class, [
            'attr' => ['class' => 'ml-60 mt-3 borderradius'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor introduzca un nombre.',
                ]),
                new Length([
                    'maxMessage' => 'Su nombre es demasiado largo.',
                    // max length allowed by Symfony for security reasons
                    'max' => 75,
                ]),
            ],
        ])
        ->add('apellido1',  TextType::class,[
            'attr' => ['class' => 'ml-55 mt-3 borderradius'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor introduzca un apellido.',
                ]),
                new Length([
                    'maxMessage' => 'Su apellido es demasiado largo.',
                    // max length allowed by Symfony for security reasons
                    'max' => 75,
                ]),
            ],
        ])
        ->add('apellido2',  TextType::class,[
            'attr' => ['class' => 'ml-65 mt-3 borderradius'],
            'label_attr' => ['class' => 'ml-75 colorwhite'],
            'required' => false,
            'constraints' => [
                new Length([
                    'maxMessage' => 'Su apellido es demasiado largo.',
                    // max length allowed by Symfony for security reasons
                    'max' => 75,
                ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

