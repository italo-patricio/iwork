<?php if(!defined('BASEPATH')) exit(header('Location: ../../index.php'));

session_start();   
/**
 * Description of controller
 *
 * @author italo
 */
/*Verifica se as bases class e dao foram definidas*/
if(defined('BASEMODEL')){
    core::allLoadArq(BASEMODEL);
}


/*Verifica se as bases class e dao foram definidas*/
  
/* 
     * Descomentar apenas caso utilizar o método core::syncdb()
     * para gerar CLASS e DAO.
 */
 #core::allLoadArq(BASEMODELCLASS);
 #core::allLoadArq(BASEMODELDAO);


class controller{   
    
    /* variavel $res serve para enviar paramentros de resultados para a view requisitada 
     * o valor dela antes de chegar na view passa pelo arquivo controller.php recebebendo
     * um outro nome de variável, a qual será utilizada dentro da view
     * @varivavel
     */
    protected $res = array();
    
    /*
     * Variavel $atr_page serve para informar atributos básico para a view informada 
     * @variavel 
     */
    protected $atr_page;
    
    /*
     * Variavel $base serve para informar qual a base será usada
     * @variavel 
     */
    protected $base = 'base';

    /*
     * Variavel $include serve para informar qual a pasta será usada para include
     * @variavel 
     */
    protected $include = '';    
    
    
    public function __construct() {
       new crud;
    }



//variável $val é utilizada para passar parâmetros para a view requisitada
    protected function view( $nameView,  $val = array() ){
          
      if(file_exists(BASEVIEWINC.$this->include.$nameView.'.php')){
        //Ativa o Buffer que armazena o conteúdo principal da página
       ob_start();   
       require_once (BASEVIEWINC.$this->include.$nameView.'.php');   
       // get content of buffer
       $content_page = ob_get_contents();   
       //discarta o conteudo do Buffer
       ob_end_clean(); 
       
      //Include the Template
      include_once (BASEVIEWPAGEMASTER.$this->base.'.php');
      exit();
    }
    else{ 
        #if(MOD=='test' || MOD=='dev')
            error_reporting (E_ALL);
            
        #throw new Exception (core::redirecionar ('menu/erro404'));
    }	
    
    }
    
}


