<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /*  $user = new User();
        $user->setName('admin');
        $user->setEmail('admin@admin.fr');
        $user->setAdresse('rue admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $hash = $encoder->encodePassword($user, $user->setPassword('admin'));
        $user->setPassword($hash);
        $manager->persist($user);

        $user2 = new User();
        $user2->setName('user');
        $user2->setEmail('user@user.fr');
        $user2->setAdresse('rue user');
        $user->setRoles(array('ROLE_USER'));
        $hash = $encoder->encodePassword($user, $user->setPassword('user'));
        $user2->setPassword($hash);
        $manager->persist($user2);*/

        $manager->flush();
    }
}
