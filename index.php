 <?php   
   
    //Constantes definidas com bases de cada diretório 
    define('BASEPATH', getcwd().DIRECTORY_SEPARATOR);
    define('BASECSS','style/css/');
    define('BASEJS','style/js/');
    define('BASEIMAGES', 'style/images/');
    define('BASESYSTEM', 'system/');
    define('BASEMODEL', 'app/model/');
    define('BASEVIEW', 'app/view/');
    define('BASECONTROL', 'app/control/');
    define('BASEVIEWINC', BASEVIEW.'includes/');
   
    //$_SESSION['session'] serve para armazenar os valores em uma session 
    //valores bi-dimensional para realizar uma busca eh preciso utilizar 
    //a seguinte estrutura $_SESSION['session']['nome_da_sessao_criada']
    $_array_geral = array();
    
    
   // echo isset($_GET['control']) ? $_GET['control']:'nao existe ou vazio';
        
    if(file_exists(BASEPATH.'autoload.php')){       
        require_once (BASEPATH.'autoload.php');
        //executa a classe autoload para captura das requisições enviada pela url
        new autoload;      
    }     
    else  
      echo 'Falha no carregamento da p&aacute;gina autoload!';

    