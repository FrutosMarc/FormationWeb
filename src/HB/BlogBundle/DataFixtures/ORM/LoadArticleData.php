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

        $article1 = new Article();
        $article1->setTitle('un article test 1');
        $article1->setContent('test test test avec le data fixtures.');
        $article1->setPublished(True);
        $article1->setAuthor($user1);
        $manager->persist($article1);
        
        $user2 = $this->getReference("user2");        
        $article2 = new Article();
        $article2->setTitle('un article test 2');
        $article2->setContent('test2 test2 test2 avec le data fixtures.');
        $article2->setPublished(True);
        $article2->setAuthor($user2);
        $manager->persist($article2); 
        
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