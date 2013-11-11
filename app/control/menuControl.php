<?php  if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
/**
 * Description of menuControl
 *
 * @author italo
 */
   

class menu extends controller {
    
    //variavel $res serve para enviar parametros de resultados para a view requisitada 
    //o valor dela antes de chegar na view passa pelo arquivo controller.php recebebendo
    //um outro nome de variável, a qual será utilizada dentro da view
    private $res = array();
    
    function __construct() {}
    function __clone() {}

    public function index(){
        $this->view('index', $this->res);  
    }
    
}


