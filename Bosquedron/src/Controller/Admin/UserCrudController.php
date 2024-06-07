<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $photoField = ImageField::new('userphoto', 'Foto del parque')
        ->setBasePath('/storageDB/images/users')
        ->setUploadDir('public/storageDB/images/users')
        ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
        ->setRequired(true);

        // VERIFICAMOS SI ESTAMOS EN EDITAR PARA CORREGIR EL FALLO DEL CAMPO IMAGEN CON REQUIRE
        if ($pageName === Crud::PAGE_EDIT) {
            $photoField->setRequired(false);
        }

        return [
            IdField::new('id')
                ->hideOnForm(),

            $photoField,

            TextField::new('username')
                ->setMaxLength(50)
                ->setRequired(true),
                
            TextField::new('password')
                ->setFormType(PasswordType::class)
                ->setRequired(true)
                ->setHelp('Debe ser una contraseña segura'),
            
            ChoiceField::new('roles')
                ->setChoices([
                    'Admin' => 'ROLE_ADMIN',  
                    'Worker' => 'ROLE_WORKER',
                    'User' => 'ROLE_USER'])
                ->allowMultipleChoices()
                ->setRequired(true)
                ->setHelp('Puede ser "rolUser", "rolWorker" o "rolAdmin"'),

            EmailField::new('email')
                ->setRequired(true)
                ->setHelp('Debe ser un email válido'),
        ];
    }
}
