<?php

namespace App\Controller\Admin;

use App\Entity\Publications;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PublicationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Publications::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Publications')
            ->setEntityLabelInSingular('Publication')
            ->setSearchFields(['titre', 'contenu', 'categorie.nom'])
            ->setDefaultSort(['createdAt' => 'DESC'], ['titre' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id')->hideOnForm();
        yield TextField::new('titre');
        yield SlugField::new('slug')->setTargetFieldName('titre')->hideOnIndex();
        yield TextareaField::new('contenu');
        yield AssociationField::new('users');
        yield BooleanField::new('isActive');
        yield BooleanField::new('isPublished');
        yield AssociationField::new('categorie');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}