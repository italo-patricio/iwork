<?php

class ErrorController extends iController
{
	
	public function code404Action()
	{
		http_response_code(404);
		$this->render('code404');
	}
	
	public function code500Action()
	{
		http_response_code(500);
		$this->render('code500');
	}
	
}