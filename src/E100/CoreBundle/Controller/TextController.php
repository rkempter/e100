<?php

namespace E100\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TextController extends Controller
{
    /**
     * @Route("/{id}")
     * @Template("E100CoreBundle:BibleText:text.html.twig")
     */
    public function indexAction($id)
    {
    	$repository = $this->getDoctrine()->getRepository('E100CoreBundle:Text');
    	$text = $repository->findOneBy(array('id' => $id));

        if($this->getUser()) {
            $user = $this->getUser();
            $user->setLastRead($text);
            $this->getDoctrine()->getEntityManager()->persist($user);
            $this->getDoctrine()->getEntityManager()->flush();
        }
        
        return array('text' => $text);
    }
}
