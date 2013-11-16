<?php

class iController
{
	private $_controller;
	
	protected $model;
	
	protected $layout = 'default';
	
	
	public function __construct($controller, $model) 
	{
		$this->_controller = $controller;
		//$this->model = new $model($config['mysql']);               // Carregando o model
	}
	
	
	protected function render($nameView, array $params = array())
	{
		iView::render($this->_controller, $nameView, $params, $this->layout);
    }
	
}
