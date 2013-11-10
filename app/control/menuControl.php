<?php  if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
/**
 * Description of menuControl
 *
 * @author italo
 */
//require_once (BASEMODEL.'conexaoBD.php');//realiza a conexao com o banco
//require_once (BASEMODELDAO.'usuarioDAO.php');
//require_once (BASEMODELDAO.'permissaoDAO.php');
//require_once (BASEMODELDAO.'menuDAO.php');
   

class menu extends controller {
    
    //variavel $res serve para enviar paramentros de resultados para a view requisitada 
    //o valor dela antes de chegar na view passa pelo arquivo controller.php recebebendo
    //um outro nome de variável, a qual será utilizada dentro da view
    //Obs.: É preciso que a variável esteja iniciada com um array vazio para não dar erro
    private $res = array();
    
    function __construct() {}
    function __clone() {}

    public function index(){
        
       //$this->carregaMenu(); 
       $this->view('index', $this->res);  
    }
    public function dados_pessoal(){
        //$this->carregaMenu();        
        $this->view('dados_pessoal',  $this->res);    
    }
    public function senha_pessoal(){
        //$this->carregaMenu();        
        $this->view('senha_pessoal',  $this->res);    
    }
    public function especialidade(){
        //$this->carregaMenu();        
        $this->view('especialidade',  $this->res);    
    }
    public function territorio(){
        //$this->carregaMenu();        
        $this->view('territorio',  $this->res);    
    }
    public function seguranca(){
        $this->view('seguranca', $this->res);
    }
    public function logoff(){        
        session_start();
        session_unset('session');
        redirecionar('?action=seguranca');
    }
}


