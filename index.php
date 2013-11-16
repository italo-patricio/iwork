 <?php
 	
	// @see http://codexico.com.br/blog/linux/tutorial-simples-como-usar-o-git-e-o-github
	// @see http://www.php.net/manual/en/refs.basic.vartype.php
	
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	define('DS', DIRECTORY_SEPARATOR);
	
	$iwork = dirname(__FILE__).DS.'system'.DS.'iWork.php';
	require_once($iwork);
	
	iWork::createApplication()->run();
