<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
        ->onlyOnIndex();
        yield Field::new('email');
        yield Field::new('nombre');
        yield Field::new('apellido1');
        yield Field::new('apellido2');
        yield Field::new('telefono');
        //imagen
        yield  ChoiceField::new('roles')->setChoices(['ADMIN' => 'ROLE_ADMIN', 'USER' => 'ROLE_USER' ])->allowMultipleChoices();
        
    }

}