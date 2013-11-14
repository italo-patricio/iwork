<?php

class SiteController extends iController 
{
	
	public function indexAction()
	{
		//$this->layout = 'index';
		$this->render('index',array());
	}
}
