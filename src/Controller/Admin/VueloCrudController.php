<?php

namespace App\Controller\Admin;

use App\Entity\Vuelo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class VueloCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vuelo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('avion');
        yield Field::new('ruta');
        yield Field::new('fecha_salida');
        yield Field::new('fecha_llegada');
        yield Field::new('precio_base');
        yield Field::new('estado');
        yield Field::new('reservas');
    }

}