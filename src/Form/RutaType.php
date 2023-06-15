<?php

namespace App\Form;

use App\Entity\Ruta;
use App\Entity\Aeropuerto;
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





class RutaType extends AbstractType
{
    public function __construct(private ManagerRegistry $doctrine)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('origen',EntityType::class, [
                'attr' => ['class' => 'form-control'],
                'class' => Aeropuerto::class,
                'choices' => $this->doctrine->getRepository(Aeropuerto::class)->findAll(),
                ])
            ->add('destino',EntityType::class, [
                'attr' => ['class' => 'form-control'],
                'class' => Aeropuerto::class,
                'choices' => $this->doctrine->getRepository(Aeropuerto::class)->findAll(),                    
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ruta::class,
        ]);
    }
}
