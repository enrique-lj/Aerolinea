<?php

namespace App\Controller\Admin;

use App\Entity\Tarifables;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class TarifablesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tarifables::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('extra_asiento');
        yield Field::new('factura_maleta');
        yield Field::new('extra_seguro');
        yield Field::new('business');
    }

}