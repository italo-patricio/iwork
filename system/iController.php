<?php

class iController
{
	private $_controller;
	
	
	protected $model;
	
	
	function __construct($controller, $model, $config) 
	{
		$this->_controller = $controller;
		$this->model = new $model($config);               // Carregando o model
	}
	
	
	protected function render($nameView, array $params = array())
	{
		iView::render($this->_controller, $nameView, $params);
    }
	
}
