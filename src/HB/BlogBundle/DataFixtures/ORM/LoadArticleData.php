<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadArticleData
 *
 * @author Marc
 */

namespace HB\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)    {
       
        $user1 = $this->getReference("user1"); 
        for ($i=1;$i<50;$i++)
        {
            $article = new Article();
            $article->setTitle('un article test '.$i);
            $article->setContent('test test test avec le data fixtures.');
            $article->setPublished(True);
            $article->setAuthor($user1);
            $manager->persist($article);

         }
        $manager->flush();

    }

    /**
     * 
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // l'ordre dans lequel les fichiers sont chargés
    }
}