<?php

namespace IcyMat\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction($resource = null, $pageName = null)
    {
    	if(!file_exists($this->getParameter('kernel.root_dir') . '/Resources/') ||
    		!file_exists($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/') ||
    		!file_exists($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/views/')
    	) {
    		throw new BadRequestHttpException('Directory with templates doesn\'t exists!');
    	}
    	
    	$templateName = $this->get('icymat.website.manager')->getTemplateName($resource, $pageName);
    	
    	try {
    		return $this->render($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/views/'
    			. $templateName); 
    	} catch(\Exception $e) {
    		throw new NotFoundHttpException($e->getMessage());
    	}
    }
}
