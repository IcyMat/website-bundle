<?php
namespace IcyMat\WebsiteBundle\Response;

use Symfony\Component\HttpFoundation\Response;

class JpegResponse extends Response {
	
	public function __construct($content) {
		parent::__construct($content, 200, ['Content-type' => 'image/jpeg']);
	}
	
}