<?php

// Defindo os caminhos
defined('DS')         or define('DS', DIRECTORY_SEPARATOR);
defined('PATH')       or define('PATH', dirname(__FILE__).DS.'..'.DS);
defined('BASEAPP')    or define('BASEAPP' , PATH.'application'.DS);
defined('BASESYSTEM') or define('BASESYSTEM', PATH.'system'.DS);
defined('BASETEMP')   or define('BASETEMP', PATH.'tmp'.DS);

defined('APPCONTROLLERS') or define('APPCONTROLLERS', BASEAPP.'controllers'.DS);
defined('APPMODELS')      or define('APPMODELS'     , BASEAPP.'models'.DS);
defined('APPVIEWS')       or define('APPVIEWS'      , BASEAPP.'views'.DS);


// Carregando os arquivos do sistema
//require_once(BASESYSTEM.'iAutoloader.php'); ??? - futuramente usar o iAutoloader para carregar o system
require_once(BASESYSTEM.'iController.php');
require_once(BASESYSTEM.'iModel.php');
require_once(BASESYSTEM.'iSecurity.php');
require_once(BASESYSTEM.'iUtils.php');
require_once(BASESYSTEM.'iView.php');



class iWork 
{
	/**
	 * Armazena o nome do controlador
	 * @var string
	 */
	private $_controller = null;
	/**
	 * Armazena o node da ação
	 * @var string
	 */
	private $_action = null;
	/**
	 * Armazena os parâmetros, ie: id=>100
	 * @var string
	 */
	private $_params = array();
	/**
	 * Instância da classe iSecurity
	 * @var iSecurity Object
	 */
	private $_security = null;
	/**
	 * Armazena as configurações de BASEAPP/app/config.php
	 * @var array()
	 */
	public static $config = array();
	/**
	 * Instância da classe iWork
	 * @var iWork object
	 */
	private static $_application = null;
	
	
	/**
	 * Construtor da classe
	 */
	public function __construct()
	{
		// Checar se o SSL esta ligado
		if(isset($_SERVER['HTTPS']))
			if ($_SERVER['HTTPS'] == 'On')
				self::$config['https'] = true;
			else
				self::$config['https'] = false;
		else
			self::$config['https'] = false;
		
		// Carregando as configurações de iUtils
		iUtils::start();
		
		// Carregando a segunrança no sistema: aqui ou la na run()??
		iSecurity::start()->check();
	}
	
	/**
	 * Detecta o controller, action e os params passados pela url. O '.htaccess' reescreve a url
	 * e passa uma $_GET['url'] --> index.php?url=......... para o sistema e assim podemos trocar a url
	 * covêncional para 'link/controller/action/params' deixando uma visualização mais amigável
	 * params => /id=10/blog=1/arg=x/....
	 */
	public function urlManager()
	{		
		if (isset($_GET['url']))
		{
			// Quebrando a url recebida
			$url = strtolower($_GET['url']);
			$url = explode('/', $url);
			
			// Defindo o 'controller' e a 'action'
			$this->_controller = (isset($url[0])) ? (($url[0] == '' || $url[0] == null) ? self::$config['defaultController'] : $url[0] ) : self::$config['defaultController'];
			$this->_action     = (isset($url[1])) ? (($url[1] == '' || $url[1] == null) ? self::$config['defaultAction'] : $url[1] ) : self::$config['defaultAction'];

			// Definindo os 'params'
			if (count($url) > 2)
			{
				array_shift($url);     // removendo o controller
				array_shift($url);     // removendo a action
				
				// carregando os parâmetros /arg:xxx/arg2:qqq/
				foreach($url as $value)
				{
					if ($value != null && $value != '')
					{
						$arg = explode(self::$config['url'], $value);
						if ($arg[0] != '' && $arg[0] != null)
							$this->_params[$arg[0]] = $arg[1];
					}
				}
			}
			//print_r($url);
		}
		else // Defindo valores padrões para a controller e action
		{
			$this->_controller = self::$config['defaultController'];
			$this->_action     = self::$config['defaultAction'];
		}
		
		//print_r($this->_controller.'<br>');
		//print_r($this->_action.'<br>');
		//print_r($this->_params);
	}
	/**
	 * Carrega a controller e sua respectiva action
	 */	
	private function load()
	{
		// Criando uma Nomenclatura
		$controllerName = ucwords($this->_controller).'Controller'; // IndexController, LoginController, ...
		$actionName     = $this->_action.'Action';                  // indexAction    , validarAction
		$modelName      = rtrim(ucwords($this->_controller), 's');  // Index          , Login
	
		
		if(file_exists(APPCONTROLLERS.$controllerName.'.php'))
		{
			require_once(APPCONTROLLERS.$controllerName.'.php');
			
			if (class_exists($controllerName))
			{
				
				if (method_exists($controllerName, $actionName))
				{
					
					$dispatch = new $controllerName($this->_controller, $modelName);
					
					// A função recebera como parâmetro um array passado pela url
					call_user_func_array(array($dispatch, $actionName), $this->_params);
				} 
				else 
				{
					//iUtils::redirecionar('error/code404');
					// Comentário para dev, em production redirecionar para página 404
					echo utf8_decode('<h2>A ação especificada '.$this->_action.' não existe!</h2>');
				}
			}
			else 
			{
				//iUtils::redirecionar('error/code404');
				// Comentário para dev, em production redirecionar para página 404
				echo utf8_decode('<h2>A classe '.$controllerName.' não existe!</h2>');
			}
		}
		else 
		{
			//iUtils::redirecionar('error/code404');
			// Comentário para dev, em production redirecionar para página 404
			echo utf8_decode('<h2>O arquivo "app/controller/'.$controllerName.'.php" não existe!</h2>');
		}
	}
	/**
	 * Inicia o programa
	 */
	public function run() 
	{
			
		$this->urlManager();                 // Reconhece o controller e action
		
		$this->load();                       // Carrega o contrller e action
	}
	/**
	 * Deixar isso aqui???
	 */
	public static function createApplication()  // funciona????
	{
		// Carregando a configuração para aplicação9
		self::$config = require_once(BASEAPP.'config.php'); // variáveis globais
		
		if(self::$_application == null)
		{
			self::$_application = new iWork();
		}
		return self::$_application;
	}
	
}



	
 

