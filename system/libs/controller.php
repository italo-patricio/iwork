<?php if(!defined('BASEPATH')) exit(header('Location: ../../index.php'));

session_start();   
/**
 * Description of controller
 *
 * @author italo
 */

/*Carrega a classe crud que contem o código do crud genérico */
require_once (BASELIBS.'crud.php');

/*Verifica se as bases class e dao foram definidas*/
if(defined('BASEMODELCLASS') && defined('BASEMODELDAO')){
    core::allLoadArq(BASEMODELCLASS);
    core::allLoadArq(BASEMODELDAO);
}
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
        throw new Exception (core::redirecionar ('menu/erro404'));
    }	
    
}

