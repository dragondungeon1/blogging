<?php

namespace App\Controller\Admin;

use App\Entity\MicroPost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MicroPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MicroPost::class;
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
