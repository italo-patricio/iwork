<?php

//url base
define('url_base', 'iwork');
//pagina base
define('PAGEBASE', 'base');

//Constantes definidas com bases de cada diretório 
    define('BASEAPLICATION', 'app/');
    define('BARRA', '/');
    define('BASEVIEWPAGEMASTER', BASEAPLICATION.'view/base/');    
    define('BASEPATH', getcwd().DIRECTORY_SEPARATOR);
    define('BASECSS','style/css/');
    define('BASEJS','style/js/');    
    define('BASEFONTS','style/font/');
    define('BASEIMAGES', 'style/images/');
    define('BASESYSTEM', 'system/');
    define('BASECONFIG', 'system/config/');
    define('BASELIBS', 'system/libs/');    
    define('BASEVIEW', BASEAPLICATION.'view/');
    define('BASECONTROL', BASEAPLICATION.'control/');
    
    /*Descomentar apenas caso utilizar o método core::syncdb()*/
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
    require_once (BASECONFIG.'configDB.php');
   
    
    
                                                                                                                                                                                                                                                                                          