<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function encrypt(UserPasswordEncoderInterface $encoder)
    {
        // whatever *your* User object is
        $user = new User();
        $plainPassword = '';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            TextField::new('name'),
            TextField::new('email'),
            TextField::new('password'),
            BooleanField::new('isVerified'),
//            TextEditorField::new('description'),
        ];
    }
}
