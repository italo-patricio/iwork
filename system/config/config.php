<?php

//url base
define('url_base', 'isr');
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
    define('BASEPLUGINS', 'system/libs/plugins/');    
    define('BASEVIEW', BASEAPLICATION.'view/');
    define('BASECONTROL', BASEAPLICATION.'control/');
    
    define('BASEMODEL', 'app/model/');
    
    /* 
     * Descomentar apenas caso utilizar o método core::syncdb()
     * para gerar CLASS e DAO. Lembrar de descomentar a inclusão das class
     * no arquivo controller.php
     */
    #define('BASEMODELCLASS', 'app/model/class/');
    #define('BASEMODELDAO', 'app/model/dao/');
    
    define('BASEVIEWINC', BASEVIEW.'includes/');
    define('TEMPLATE_BASE', BASEVIEWPAGEMASTER);
    /**opcional*/
    define('BOOTSTRAPCSS','style/dist/css/');
    define('BOOTSTRAPJS','style/dist/js/');
    define('BOOTSTRAPFONTS','style/dist/fonts/');
    /**opcional*/
    

//Pasta temp
#define('BASETEMP',BASESYSTEM.'temp/');


        
    
    
                                                                                                                                                                                                                                                                                          