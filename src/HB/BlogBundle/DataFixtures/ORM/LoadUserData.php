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
use HB\BlogBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)    {
        $user1 = new User();
        $user2 = new User();
        
        $user1->setLogin('Login1');
        $user1->setPassword('123456');
        $user1->setName("Name1");
        $user1->setBirthDate(new \DateTime("08/18/1971"));
        $user1->setCreationDate(new \DateTime());
        $user1->setLastEditDate(new \DateTime());
        $user1->setEnabled(true);
        $manager->persist($user1);

         
        $user2->setLogin('Login2');
        $user2->setPassword('123456');
        $user2->setName("Name2");
        $user2->setBirthDate(new \DateTime("08/18/1971"));
        $user2->setCreationDate(new \DateTime());
        $user2->setLastEditDate(new \DateTime());
        $user2->setEnabled(true);
        $manager->persist($user2);
      
         $manager->flush();
         // on stocke dans le repository des fixtures, les objets à partager
         $this->addReference("user1", $user1);
         $this->addReference("user2", $user2);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}