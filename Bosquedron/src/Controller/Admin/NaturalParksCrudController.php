<?php

namespace App\Controller\Admin;

use App\Entity\NaturalParks;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

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
        ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
        ->setRequired(true);

        // VERIFICAMOS SI ESTAMOS EN EDITAR PARA CORREGIR EL FALLO DEL CAMPO IMAGEN CON REQUIRE
        if ($pageName === Crud::PAGE_EDIT) {
            $photoField->setRequired(false);
        }

        return [
            IdField::new('id')
                ->hideOnForm(),
            
            TextField::new('name', 'Nombre del parque')
                ->setMaxLength(50)
                ->setRequired(true),
            
            $photoField,

            TextField::new('location', 'Localización del parque')
                ->setMaxLength(200)
                ->setRequired(true),

            TelephoneField::new('phone', 'Teléfono del parque')
                // ->setMaxLength(9)
                ->setHelp('Introduce solo números, hasta un máximo de 9')
                ->setRequired(true),

            EmailField::new('email', 'Email del parque')
                ->setHelp('Debe incluir "texto@texto.texto"')
                ->setRequired(true),

            UrlField::new('website', 'Página web del parque')
                ->setRequired(true)
                ->setHelp('Debe ser una URL válida'),
            
            TextareaField::new('presentation', 'Presentación del parque')
                ->setMaxLength(4000)
                ->setRequired(true)
                ->setHelp('Presentación del parque, hasta un máximo de 4000 caracteres')
                ->onlyOnForms(),

            TextField::new('opening_times', 'Horario del parque')
                ->setRequired(true),

            MoneyField::new('entry_fee', 'Precio de entrada del parque')
                ->setCurrency('EUR')
                ->setNumDecimals(2)
                ->setRequired(true)
                ->setHelp('Solo números, hasta dos decimales'),
            
            IntegerField::new('declared_in', 'Fecha de declaración del parque')
                ->setRequired(true)
                ->setHelp('Año de declaración del parque, hasta 4 números')
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
