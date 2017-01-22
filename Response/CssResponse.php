<?php
namespace IcyMat\WebsiteBundle\Response;

use Symfony\Component\HttpFoundation\Response;

class CssResponse extends Response {
	
	public function __construct($content) {
		parent::__construct($content, 200, ['Content-type' => 'text/css']);
	}
	
}