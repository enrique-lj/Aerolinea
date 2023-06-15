<?php

namespace App\Controller\Admin;

use App\Entity\Asiento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class AsientoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Asiento::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('avion');
        yield Field::new('fila');
        yield Field::new('columna');
        yield Field::new('clase');
    }

}