<?php

namespace IcyMat\WebsiteBundle\Controller;

use IcyMat\WebsiteBundle\Response\BmpResponse;
use IcyMat\WebsiteBundle\Response\CssResponse;
use IcyMat\WebsiteBundle\Response\GifResponse;
use IcyMat\WebsiteBundle\Response\JpegResponse;
use IcyMat\WebsiteBundle\Response\JsResponse;
use IcyMat\WebsiteBundle\Response\PngResponse;
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

	public function filesAction($resource, $fileName, $type)
	{
		if(!file_exists($this->getParameter('kernel.root_dir') . '/Resources/') ||
			!file_exists($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/') ||
			!file_exists($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/public/')
		) {
			throw new BadRequestHttpException('Directory with templates doesn\'t exists!');
		}

		if(!file_exists($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/public/' . $resource . '/' . $fileName . '.' . $type)) {
			throw new NotFoundHttpException();
		}

		$content = file_get_contents($this->getParameter('kernel.root_dir') . '/Resources/WebsiteBundle/public/' . $resource . '/' . $fileName . '.' . $type);

		switch ($type) {
			case 'jpeg':
			case 'jpg':
				return new JpegResponse($content);
			case 'png':
				return new PngResponse($content);
			case 'gif':
				return new GifResponse($content);
			case 'bmp':
				return new BmpResponse($content);

			case 'css':
				return new CssResponse($content);

			case 'js':
				return new JsResponse($content);

			default:
				throw new NotFoundHttpException();
		}
	}
}
