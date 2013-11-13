<?php

// Carregando os arquivos do sistema
require_once(BASESYSTEM.'iModel.php');
require_once(BASESYSTEM.'iController.php');
require_once(BASESYSTEM.'iUtils.php');


class iWork {
	
	private $_controller = null;
	
	private $_action = null;
	
	private $_params = array();
	
	private $_config = null;


	
	/**
	 * 
	 */
	public function __construct($config) 
	{
		$this->_config = require($config);	 // Carregando a configuração para a classe
	
		$this->urlManager();                 // Reconhece o controller e action
		
		$this->load();                       // Carrega o contrller e action
	}
	
	
	/**
	 * index.php?url=
	 * link/controller/action/params
	 */
	public function urlManager()
	{
		if (isset($_GET['url']))
		{
			// Quebrando a url recebida
			$url = strtolower($_GET['url']);
			$url = explode('/', $url);
			
			// Defindo o 'controller' e a 'action'
			$this->_controller = (isset($url[0])) ? $url[0] : $this->_config['defaultController'];
			$this->_action     = (isset($url[1])) ? $url[1] : $this->_config['defaultAction'];			
			
			// Definindo os 'params'
			if (count($url) >= 3)
			{
				array_shift($url); // removendo o controller 
				array_shift($url); // removendo a action
				$this->_params = $url;
			}
			
			//print_r($url);
		}
		else 
		{
			$this->_controller = $this->_config['defaultController'];
			$this->_action     = $this->_config['defaultAction'];
		}
		
		print_r($this->_controller.'<br>');
		print_r($this->_action.'<br>');
		print_r($this->_params);
		
	}
	
	
	private function load()
	{
		// Criando uma Nomenclatura
		$controllerName = ucwords($this->_controller).'Controller'; // IndexController, LoginController, ...
		$actionName     = $this->_action.'Action';                  // indexAction    , validarAction
		$modelName      = rtrim(ucwords($this->_controller), 's');  // Index          , Login
	
		
		if(file_exists(BASEAPP.'controller/'.$controllerName.'.php'))
		{
			require_once(BASEAPP.'controller/'.$controllerName.'.php');
			
			if (class_exists($controllerName))
			{
				
				if (method_exists($controllerName, $actionName))
				{
					// Inicia o controller
					$dispatch = new $controllerName($this->_controller, $this->_action, $modelName);

					// A função recebera como parâmetro um array passado pela url
					call_user_func_array(array($dispatch, $actionName), $this->_params);
				} 
				else 
				{
					// Comentário para dev, em production redirecionar para página 404
					echo utf8_decode('<h2>A ação especificada '.$this->_action.' não existe!</h2>');
				}
			}
			else 
			{
				// Comentário para dev, em production redirecionar para página 404
				echo utf8_decode('<h2>A classe '.$controllerName.' não existe!</h2>');
			}
		}
		else 
		{
			// Comentário para dev, em production redirecionar para página 404
			echo utf8_decode('<h2>O arquivo "app/controller/'.$controllerName.'.php" não existe!</h2>');
		}
	}
	
	/**
	 * 
	 *
	private function getController()
	{			
		if($_REQUEST['action']!='validar')
		{
			if (isset($_REQUEST['control']))
			{
				if ($_REQUEST['control'] == null)
					$this->_controller = $this->_config['defaultController'];
				else
					$this->_controller = $_REQUEST['control'];
			} else {
				$this->_controller = $this->_config['defaultController'];
			}
			
			$this->_controller .= 'Controller';
		}
		else
		{
			$vals = $_SESSION['session'];
			$this->_controller = $vals['control'];
			$this->action     = $vals['action'];
		}
	
	}	
*/
	
}



	
 

