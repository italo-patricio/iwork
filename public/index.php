 <?php
 
	// @see http://codexico.com.br/blog/linux/tutorial-simples-como-usar-o-git-e-o-github
 
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	define('DS', DIRECTORY_SEPARATOR);
	
	define('BASEPATH'  , dirname(__FILE__) . DS . '..' . DS);
	define('BASEAPP'   , BASEPATH.'app' . DS);
		define('APPCONTROLLERS', BASEAPP.'controllers'.DS);
		define('APPMODELS', BASEAPP.'models'.DS);
		define('APPVIEWS', BASEAPP.'views'.DS);
    define('BASESYSTEM', BASEPATH.'system' . DS);
    
    
    require_once(BASESYSTEM.'iWork.php');
    $config = BASEAPP.'config.php';
    
    iWork::createApplication()->run($config);
