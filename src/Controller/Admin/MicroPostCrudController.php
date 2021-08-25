<?php

namespace App\Controller\Admin;

use App\Entity\MicroPost;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class MicroPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MicroPost::class;
    }


    public function configureFields(string $pageName): iterable
    {
//        $user = $this->getUser();
        return [
            IdField::new('id'),
            TextField::new('subject'),
            TextField::new('text'),
//            TimeField::new('date', 'Date'),
            DateField::new('date' , 'date')
        ];
    }

}
