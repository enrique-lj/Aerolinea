<?php

namespace App\Controller\Admin;

use App\Entity\Aeropuerto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class AeropuertoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aeropuerto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('nombre');
        yield Field::new('localidad');
    }

}