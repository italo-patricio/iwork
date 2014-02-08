<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

class autoload{    
    
    //Variavel $array_url serve para armazenar o control, action e os params enviado pelo link 
    //e capturado pelo metodo get
    private $array_url = array();
    private $params    = array();
    
    function __construct() {
              $this->getController();        
              $this->getUrl();

          #echo $this->array_url[2].'..'.$this->array_url[3];
          #var_dump($this->array_url);
          #var_dump($this->params);
         
     
        $this->load($this->array_url[2], $this->array_url[3], $this->params);
          
           
    }

    
    private function getUrl(){

     $this->array_url = explode("/", $_SERVER["REQUEST_URI"]);
     //Garante que não existam controles nem ações repetidas
     //$this->array_url = array_unique($this->array_url);
     
       $this->array_url[1] = url_base;
           
        //load control
        if(isset($this->array_url[2]) && $this->array_url[2]== NULL ||
           isset($this->array_url[2]) && !$this->getExistControl($this->array_url[2])||
           !isset($this->array_url[2])
                ){
                $this->array_url[2] = 'menu';
        }
        //load action
        if(isset($this->array_url[3]) && $this->array_url[3] ==NULL ||!isset($this->array_url[3])){
            $this->array_url[3] = 'index';
        }     
        //load param
        if(isset($this->array_url[4]) && $this->array_url[4] !=NULL){
            $j=0;
            for($i=4;$i<count($this->array_url);$i++){
                if(isset($this->array_url[$i]) && isset($this->array_url[($i+1)]) && $this->array_url[($i+1)]!=NULL){
                    
                    $this->params[$j]['parametro'] = $this->array_url[$i];                   
                    $this->params[$j]['valor'] = $this->array_url[$i+1];
                    
                    $j++;$i++;
                }
            }         
        }
   }
   public static function getExistControlUrl($controlUrl){
          $url = explode("/", $_SERVER["REQUEST_URI"]);
          $cont = 0;
          foreach ($url as $value) {
              if($value == $controlUrl){
                  return TRUE;
              exit();
          
             }
          }
    return FALSE;  
   }

   private function getExistControl($nameControl){
        if(file_exists(BASECONTROL.$nameControl.'Control.php')){
            return TRUE;
        }
        else return FALSE; 
    }
    private function getController(){//passo 3 
        if(file_exists(BASESYSTEM.'controller.php')){
            try{require_once (BASESYSTEM.'controller.php');}
            catch (Exception $ex){echo 'Falha no carregamento da página '.'controller.php';}
        }
    }
    private function load($classe,$action,array $params){//passo 4
      
        if(file_exists(BASECONTROL.$classe."Control.php")){
             require_once (BASECONTROL.$classe."Control.php");
            
              $app = new $classe();
                 if(method_exists($classe,$action)){
                     $app->$action($params);
                 }
                else echo utf8_decode("A ação especificada {$action} não existe! <br> Retornar a página inicial <a href='/".url_base."/menu/index'>clique aqui</a>")
                ;  
          } 
      
        else {
            echo utf8_decode("A classe {$classe} não existe! <br> Retornar a página inicial <a href='/".url_base."/menu/index'>clique aqui</a>")
                ;  
        } 
      
    }
 
  
}//fim da classe



      