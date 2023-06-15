<?php

namespace App\Controller\Admin;

use App\Entity\Avion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class AvionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('codigo');
        yield Field::new('modelo');
       
    }

}