<?php  if(!defined('BASEPATH')) exit(header('Location: ./../../'));
/**
 * Description of menuControl
 * Serve para exibir as view's
 * @author italo
 */


class menuControl extends controller {
    
    
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
     
     public function syncdb(){
         core::syncdb();
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


