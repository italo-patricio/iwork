<?php

//url base
define('url_base', 'iwork');
//pagina base
define('PAGEBASE', 'base');

//Constantes definidas com bases de cada diretório 
    define('BARRA', '/');
    define('BASEVIEWPAGEMASTER', 'app/view/base/');    
    define('BASEPATH', getcwd().DIRECTORY_SEPARATOR);
    define('BASECSS','style/css/');
    define('BASEJS','style/js/');    
    define('BASEFONTS','style/font/');
    define('BASEIMAGES', 'style/images/');
    define('BASESYSTEM', 'system/');
    define('BASEVIEW', 'app/view/');
    define('BASECONTROL', 'app/control/');
    define('BASEMODELCLASS', 'app/model/class/');
    define('BASEMODELDAO', 'app/model/dao/');
    
    define('BASEVIEWINC', BASEVIEW.'includes/');
    define('TEMPLATE_BASE', BASEVIEWPAGEMASTER.'base.php');
    /**opcional*/
    define('BOOTSTRAPCSS','style/dist/css/');
    define('BOOTSTRAPJS','style/dist/js/');
    define('BOOTSTRAPFONTS','style/dist/fonts/');
    /**opcional*/
    

//Pasta temp
#define('BASETEMP',BASESYSTEM.'temp/');


//carrega as configurações do banco
    require_once (BASESYSTEM.'configDB.php');
   
    
    
                                                                                                                                                                                                                                                                                          