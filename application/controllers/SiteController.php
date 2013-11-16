<?php

class SiteController extends iController 
{
	
	public function indexAction($a = null)
	{
		$_SESSION['teste'] = 'index';
		//$this->layout = 'index';
		$this->render('index');
	}
	
}
