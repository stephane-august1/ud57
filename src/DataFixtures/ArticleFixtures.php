<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectManager as DoctrinePersistenceObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(DoctrinePersistenceObjectManager $manager)
    {

        /*   for ($i = 0; $i < 4; $i++) {
            $article = new Article();
            $article->setTitle("le titre n°" . $i);
            $article->setContent("ici le contenu de l'article n°" . $i);
            $article->setImage("https://placehold.it/500x200");
            //$article->setDate(New::DateTime());




            $manager->persist($article);
        }*/
        $manager->flush();
    }
}
