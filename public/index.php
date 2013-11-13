 <?php
 
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	define('DS', DIRECTORY_SEPARATOR);
	
	define('BASEPATH'  , dirname(__FILE__) . DS . '..' . DS);
	define('BASEAPP'   , BASEPATH.'app' . DS);	
    define('BASESYSTEM', BASEPATH.'system' . DS);
    
    require_once(BASESYSTEM.'iWork.php');
    $config = BASEAPP.'config.php';
    
    new iWork($config);
	
	//$iwork  = dirname(__FILE__).'/../system/iwork.php';
	//$config = dirname(__FILE__).'/../app/config.php';
	
	//require_once($iwork);
	
	//new iwork($config);
	
//	iwork::createApplication($config);
	/*
	//Constantes definidas com bases de cada diretório 
	define('BASEPATH', getcwd().DIRECTORY_SEPARATOR);
	
	define('BASECSS',    'resources/css/');
	define('BASEJS',     'resources/js/');
	define('BASEIMAGES', 'resources/images/');
	
	define('BASECONTROL','app/control/');
	define('BASEMODEL',  'app/model/');
	define('BASEVIEW',   'app/view/');
	define('BASEVIEWINC', BASEVIEW.'includes/');
	
    define('BASESYSTEM', 'system/');
    
    //$_SESSION['session'] serve para armazenar os valores em uma session 
    //valores bi-dimensional para realizar uma busca eh preciso utilizar 
    //a seguinte estrutura $_SESSION['session']['nome_da_sessao_criada']
    $_array_geral = array();
    
    //se a configuração do banco não existir é iniciado o passo de instalação
    if(file_exists(BASESYSTEM.'configDB.php'))
    {	
		if(file_exists(BASEPATH.'autoload.php'))
		{
			try 
			{
				require_once (BASEPATH.'autoload.php');
				
				//executa a classe autoload para captura das requisições enviada pela url
				new autoload;
			}
			catch (Exception $ex)
			{
				echo 'Falha no carregamento da página autoload!';
			}
		} // end if autoload     
		else
			echo 'houve falha';
	}
	else 
		require_once (BASESYSTEM.'instaler.php');
*/
