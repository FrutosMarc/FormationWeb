<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// src/HB/BlogBundle/Menu/Builder.php
namespace HB\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Description of Builder
 *
 * @author Marc
 */
class Builder extends ContainerAware{
    //put your code here
    
   public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root',array('childrenAttributes'=>array('class'=>'nav'),
                                            'currentClass'=>'active'));

        $menu->addChild('Home', array('route' => 'blog_index'));
        $menu->addChild('Liste des articles',array('route'=>'article'));
        $menu->addChild('Liste des utilisateur',array('route'=>'user'));
        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // récupère les 10 premiers articles
        $articles = $em->getRepository('HBBlogBundle:Article')->getHomePageArticles(10);
        
        $menu->addChild('Derniers articles',
              array(
                  'uri'=>"#",
                  'linkAttributes'=>array('class'=>'dropdown-toggle',
                                    'data-toggle'=>'dropdown'),
                  'attributes'=>array('class'=>'dropdown'),
                  'childrenAttributes'=> array('class'=>'dropdown-menu')  
              ));
        
        foreach($articles as $article)
        {
            $menu['Derniers articles']->addChild($article->getTitle(), array(
                'route' => 'article_show',
                'routeParameters' => array('id' => $article->getId())
            ));
        }
            $menu['Derniers articles']->addChild("Test", array(
                'route' => 'article_show',
                'routeParameters' => array('id' => 0)
            ));
        return $menu;
    }}
