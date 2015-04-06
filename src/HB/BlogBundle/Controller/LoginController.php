<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use HB\BlogBundle\Entity\User;
/**
 * Login controller.
 *
 */
class LoginController extends Controller
{

    /**
     * Connection user.
     *
     * 
     * 
     */
   public function loginAction()
    {
       $user = $this->getUser();
       if ($user === null){
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render("HBBlogBundle:Login:login.html.twig",array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'user'          => $user)
        );
           
       }
       else
       {
           return $this->render("HBBlogBundle:Logout:logout.html.twig",array("user"=>$user)) ;
       }
    }
   /**
    * 
    * @route("/login" )
    * @Template("HBBlogBundle:Login:login.html.twig")
    */
   public function indexAction()
    {
       $user = new User();
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'user'          => $user)
       ;
     }

}
