<?php
namespace IcyMat\WebsiteBundle\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class IcyMatWebsiteExtension extends \Twig_Extension {

	private $router;

	public function __construct(UrlGeneratorInterface $generator) {
		$this->router = $generator;
	}

	public function getFunctions() {
		return array(
			new \Twig_SimpleFunction('icymat_website_path', array($this, 'getPath')),
			new \Twig_SimpleFunction('icymat_website_resource', array($this, 'getResource')),
		);
	}

	public function getPath($pageName)
	{
		return $this->router->generate('icymat_website_homepage') . $pageName;
	}

	public function getResource($resource, $file)
	{
		$file = explode('.', $file);
		$type = array_pop($file);

		return $this->router->generate('icymat_website_resource', [
			'resource' => $resource,
			'fileName' => implode('.', $file),
			'type' => $type
		]);
	}

	public function getName() {
		return 'icymat_website_extension';
	}
}