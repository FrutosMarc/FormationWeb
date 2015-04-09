<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
                    ->getHomePageArticles($page);
        if ($page>0)
            $lienPagePrecedente = $this->generateUrl('blog_index_page',array("page"=>$page - 1 ));
        else
            $lienPagePrecedente = NULL;
        
        
        $pageTotal = $em->getRepository('HBBlogBundle:Article')
                        ->getHomePageCountArticles();
         if ($page +1< $pageTotal )
            $lienPageSuivante = $this->generateUrl('blog_index_page',array("page"=>$page + 1 ));
         else
             $lienPageSuivante = NULL;
         
        
        return array(
            'entities' => $entities,
            'lienPageSuivante' => $lienPageSuivante,
            'lienPagePrecedente' => $lienPagePrecedente,
            'page'=> $page,
            'countPages'=>$pageTotal,
            
        );
    }
    /**
     * 
     * @param \HB\BlogBundle\Controller\Request $request
     * @return type
     */
    public function listAction()
    {
        $entities = $em->getRepository('HBBlogBundle:Article')
                    ->getAll($page);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
}    

}
