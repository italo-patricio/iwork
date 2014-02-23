<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
session_start();   
//if(!isset($_SESSION)) session_start();
/**
 * Description of controller
 *
 * @author italo
 */
require_once (BASESYSTEM.'core.php');
require_once (BASESYSTEM.'crud.php');

$core = new core();
$core->allLoadArq(BASEMODELCLASS);
$core->allLoadArq(BASEMODELDAO);

class controller{
   //protected $crud ;
   public function __construct() {
        new crud;
      }

//variável $val é utilizada para passar parâmetros para a view requisitada
    protected function view( $nameView,  $val = array() ){
      if(file_exists(BASEVIEWINC.$nameView.'.php')){
        //Ativa o Buffer que armazena o conteúdo principal da página
       ob_start();   
       require_once (BASEVIEWINC.$nameView.'.php');   
       // get content of buffer
       $content_page = ob_get_contents();   
       //discarta o conteudo do Buffer
       ob_end_clean(); 
      
      //Include the Template
      include_once (TEMPLATE_BASE);
      exit();
    }
    else 
        echo 'ERRO 404';
    }	
    
}

