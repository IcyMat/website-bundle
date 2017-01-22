<?php
namespace IcyMat\WebsiteBundle\Service;

class IcyMatWebsiteManager
{
	
	private $resourceDir;
	
	public function __construct($rootDir)
	{
		$this->resourceDir = $rootDir . '/Resources/WebsiteBundle/';
	}
	
	public function getTemplateName($resource, $path) {
		$resource = $this->parsePath($resource);
		$path = $this->parsePath($path);
		
		if ($resource == null) {
			return $this->getDefaultPage();
		}
		
		return $this->getPage($resource, $path);
	}
	
	private function getDefaultPage()
	{
		if ($this->hasLanguages()) {
			return $this->getDefaultLanguagePage();	
		}
		
		return 'index.html.twig';
	}
	
	private function getDefaultLanguagePage()
	{
		return $this->getFirstLanguage() . '/index.html.twig';
	}
	
	private function getPage($resource, $path) {
		if(strlen($resource) == 2) {
			if($path == null) return $this->getLanguagePage($resource, 'index');
			
			return $this->getLanguagePage($resource, $path);
		}
		
		return $resource . '.twig.html';
	}
	
	private function getLanguagePage($lang, $resource) {
		return $lang . '/' . $resource . '.twig.html';
	}
	
	private function hasLanguages()
	{
		if ($dir = opendir($this->resourceDir)) {
			while(false !== ($file = readdir($dir))){
				if ($file != '.' && $file != '..') {
					if (strlen($file) == 2) return true;
				}
			}
			
			closedir($dir);
		}
		
		return false;
	}
	
	private function getFirstLanguage()
	{
		if ($dir = opendir($this->resourceDir)) {
			while(false !== ($file = readdir($dir))){
				if ($file != '.' && $file != '..') {
					if (strlen($file) == 2) return $file;
				}
			}
			
			closedir($dir);
		}
	}
	
	private function parsePath($path) {
		$path = str_replace('..', '', $path);
		
		return str_replace('/', '', $path);
	}
	
}