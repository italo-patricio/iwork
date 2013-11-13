<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

session_start();

class autoload 
{    
    //Variavel $control serve para armazenar o controle enviado pelo link 
    //e capturado pelo metodo get
    private $control;
   
    //Variavel $action serve para armazenar a ação em determinado controle 
    //enviado pelo link e capturado pelo metodo get  
    private $action;        
   
    function __construct() 
    {  
              $this->getControl();    //passo 1
              $this->getAction();     //passo 2
              $this->getController(); //passo 3
              
             
             //echo $this->control.'..'.$this->action;
             $this->load($this->control, $this->action);//passo 4              
    }

    private function getControl(){ //passo 1
        if($_REQUEST['action']!='validar'){
               
         $_REQUEST['control'] = isset($_REQUEST['control']) ? 
			($_REQUEST['control']==null ? 'menu':$_REQUEST['control']): 'menu';
            
          return $this->control = $_REQUEST['control'];
        }
        else  {

            $vals = $_SESSION['session'];
            $this->control = $vals['control'];
            $this->action  = $vals['action'];
         
           
        }
        
    }
    private function getAction(){//passo 2
        $_REQUEST['action'] = isset($_REQUEST['action']) ?
                 ($_REQUEST['action']==null ? 'index': $_REQUEST['action'] ):'index';
        return $this->action = $_REQUEST['action'];
    }
    private function getController(){//passo 3 
        if(file_exists(BASESYSTEM.'controller.php')){
            try{require_once (BASESYSTEM.'controller.php');}
            catch (Exception $ex){echo 'Falha no carregamento da página '.'controller.php';}
        }
    }
    private function load($classe,$action = NULL){//passo 4
      $action = ($action==null ? 'index': $action);
        if(file_exists(BASECONTROL.$classe."Control.php")){
             require_once (BASECONTROL.$classe."Control.php");

              $app = new $classe();
                 if(method_exists($classe,$action)){
                     $app->$action();
                 }
                else echo utf8_decode("A ação especificada {$action} não existe! <br> Retornar a página inicial <a href='?action=index'>clique aqui</a>")
                ;  
          } 
      
        else {
            echo utf8_decode("A classe {$classe} não existe! <br> Retornar a página inicial <a href='index.php?action=index'>clique aqui</a>")
                ;  
        }
    }
 
  
}//fim da classe



      
