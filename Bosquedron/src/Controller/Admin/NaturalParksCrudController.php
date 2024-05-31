<?php

namespace App\Controller\Admin;

use App\Entity\NaturalParks;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NaturalParksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NaturalParks::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $photoField = ImageField::new('photo', 'Foto del parque')
        ->setBasePath('/storageDB/images/naturalParks')
        ->setUploadDir('public/storageDB/images/naturalParks')
        ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]');

        // VERIFICAMOS SI ESTAMOS EN EDITAR PARA CORREGIR EL FALLO DEL CAMPO IMAGEN CON REQUIRE
        if ($pageName === Crud::PAGE_EDIT) {
            $photoField->setRequired(false);
        }

        return [
            IdField::new('id')
                ->hideOnForm(),
            
            TextField::new('name', 'Nombre del parque'),
            
            $photoField,

            TextField::new('location', 'Localización del parque'),

            TextField::new('phone', 'Teléfono del parque'),

            TextField::new('email', 'Email del parque'), 

            TextField::new('website', 'Página web del parque'),
            
            TextField::new('presentation', 'Presentación del parque'),

            TextField::new('opening_times', 'Horario del parque'), 

            TextField::new('entry_fee', 'Precio de entrada del parque'),
            
            TextField::new('declared_in', 'Fecha de declaración del parque')
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::deleteEntity($entityManager, $entityInstance);

        // ELIMINAR LA IMAGEN ASOCIADA AL PRODUCTO
        $photo = $entityInstance->getImage();
        $photoPath = "../public/storageDB/images/naturalParks/" . $photo;
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }
}
