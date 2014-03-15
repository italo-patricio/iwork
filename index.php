<?php   
   
    //Garante a exibição de todos os erros
    error_reporting(E_ALL);
    
    /*
     * Desativa o limite de memória 
     */
    ini_set('memory_limit', '-1');
    
    /*
     * Carrega as configurações do sistema
     */
    include_once ('system/config/config.php');
    /* Carrega a classe controller que contem o método para carregamento das páginas
     * dinâmicas realizando a inclusão das includes dentro na base
     */
    
    include_once (BASELIBS.'core.php');
    
    //$_SESSION['session'] serve para armazenar os valores em uma session 
    //valores bi-dimensional para realizar uma busca eh preciso utilizar 
    //a seguinte estrutur $_SESSION['session']['nome_da_sessao_criada']
    include_once (BASELIBS.'controller.php');
    /*
     * Carrega a classe core que contem os métodos para utilizações diretamente na sua
     * aplicação. Exemplo de utilização: core::NOME_DA_FUNCAO_DO_CORE(); 
     */
    
    $_array_geral = array();
    
   
    if(file_exists(BASECONFIG.'configDB.php')){//se a configuração do banco não existir é iniciado o passo de instalação
    
    if(file_exists(BASELIBS.'autoload.php')){
        try {
               
             require_once (BASELIBS.'autoload.php');
             //executa a classe autoload para captura das requisições enviada pela url
             new autoload;
              
             
        }
      catch (Exception $ex){
         throw new Exception(core::redirecionar('menu/erro404'),404);
         #throw new Exception($message, $code, $previous);
      }
    }     
    else  
        throw new Exception(core::redirecionar('menu/erro404'),404);        
    }
    else {
        require_once ('install/instaler.php');
    }
    