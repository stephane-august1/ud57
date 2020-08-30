<?php

namespace App\DataFixtures;

use App\Entity\User;

use App\Entity\Article;

use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager as DoctrinePersistenceObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(
        DoctrinePersistenceObjectManager $manager
    ) {
        // $product = new Product();
        // $manager->persist($product);
        //user admin
        $user = new User();
        $user->setName('admin');
        $user->setEmail('admin@admin.fr');
        $user->setAdresse('rue admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $manager->persist($user);
        //user simple
        $user2 = new User();
        $user2->setName('user');
        $user2->setEmail('user@user.fr');
        $user2->setAdresse('rue user');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $manager->persist($user2);

        for ($i = 0; $i < 4; $i++) {
            $article = new Article();
            $article->setTitle("le titre n°" . $i);
            $article->setContent("ici le contenu de l'article n°" . $i);
            $article->setImage("https://placehold.it/500x200");


            $manager->persist($article);
        }

        $manager->flush();
    }
}
