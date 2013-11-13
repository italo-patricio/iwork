<?php

class PaginaController extends iController 
{
	
	public function indexAction()
	{
		$this->model->inserir();
		
		$this->render('index',array(
			'titulo'=>'Página 1'
		));
	}
	 
}
