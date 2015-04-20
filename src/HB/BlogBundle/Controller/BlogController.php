<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HB\BlogBundle\Entity\Article;
use HB\BlogBundle\Form\ArticleType;


class BlogController extends Controller
{
    /**
     * @Route("/", name = "blog_index")
     * @Route("/page/{page}", name = "blog_index_page")
     * @Template()
     */
    public function indexAction($page = 0)
    {
         $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('HBBlogBundle:Article')
                    ->getHomePageArticles();
        // Gestion des pages
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $page/*page number*/,
            5/*limit per page*/
        );
        $pagination->setUsedRoute("blog_index_page");
        return array(
            'pagination' => $pagination
        );
    }
//    /**
//     * 
//     * @param \HB\BlogBundle\Controller\Request $request
//     * @return type
//     */
//    public function listAction()
//    {
//        $entities = $em->getRepository('HBBlogBundle:Article')
//                    ->getAll($page);
//
//        $paginator  = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//            $query,
//            $request->query->get('page', 1)/*page number*/,
//            10/*limit per page*/
//        );
//
//        // parameters to template
//        return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
//    }
    /**
    * @Route("/Blog/{slug}", name = "blog_article_slug")
    * @Template()
    * @param type $slug
    * @return type
    */
    public function showAction(Article $article){
      if (!$article){
          throw $this->createNotFoundException("Impossible de trouver cet article.");
          exit();
      } 
          
      return array('article'=>$article);
        
    }

 

}
