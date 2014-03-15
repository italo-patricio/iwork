<?php  if(!defined('BASEPATH')) exit(header('Location: ./../../'));
/**
 * Description of menuControl
 * Serve para exibir as view's
 * @author italo
 */


class menu extends controller {
    
    /* variavel $res serve para enviar paramentros de resultados para a view requisitada 
     * o valor dela antes de chegar na view passa pelo arquivo controller.php recebebendo
     * um outro nome de variável, a qual será utilizada dentro da view
     * @varivavel
     */
    private $res = array();
    
    /*
     * Variavel $atr_page serve para informar atributos básico para a view informada 
     * @variavel 
     */
     private $atr_page;
    
    function __construct() {
        parent::__construct();
      
    }

   

    public function index(){
        //titulo da pagina
        $this->atr_page['titulo'] = 'Primeira Página com iwork';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
        
       $this->view('inicio', $this->res);  
    }
   
     /*
     * Páginas de erro
     */
     public function erro404(){
       //titulo da pagina
        $this->atr_page['titulo'] = 'Error 404 ';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
 
       $this->view('error/404',  $this->res);
     }
     
     
     /*
      * Páginas internas
      */
     public function test(){
        
        //titulo da pagina
        $this->atr_page['titulo'] = 'teste';    
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
        
       $this->view('teste', $this->res);  
    }
    

}


