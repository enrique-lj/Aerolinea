<?php

namespace App\Controller\Admin;

use App\Entity\Ruta;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class RutaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ruta::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield AssociationField::new('origen');
        yield AssociationField::new('destino');
        yield AssociationField::new('vuelos');
    }

}