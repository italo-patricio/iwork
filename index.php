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
    require_once ('system/config/config.php');
    
     /*
     * Carrega a classe core que contem os métodos para utilizações diretamente na sua
     * aplicação. Exemplo de utilização: core::NOME_DA_FUNCAO_DO_CORE(); 
     */
    require_once (BASELIBS.'core.php');
    
    /*
     * Carrega a classe para o active record
     */
    core::allLoadArq(BASEPLUGINS.'php-activerecord/','ActiveRecord');
    
    /* Carrega a classe crud que contem o código do crud genérico */
    core::allLoadArq(BASELIBS,'crud');
    
    /* Carrega a classe configAr que contem o método para configuração para utilizar
     * o AR(Active Record) 
     */
    core::allLoadArq(BASECONFIG,'configAR');
    
    /* Carrega a classe controller que contem o método para carregamento das páginas
     * dinâmicas realizando a inclusão das includes dentro na base
     */
    core::allLoadArq(BASELIBS,'controller');
    
    /*
     * Carrega os plugins disponiveis 
     */
    core::allLoadArq(BASEPLUGINS);
    
    if(file_exists(BASELIBS.'autoload.php')){
        try {
               
            core::allLoadArq(BASELIBS,'autoload');
             //executa a classe autoload para captura das requisições enviada pela url
             new autoload;
              
             
        }
      catch (Exception $ex){
            echo '<pre>';
            error_reporting(E_ALL);
            echo $ex;
         #throw new Exception(core::redirecionar('menu/erro404'),404);
         #throw new Exception($message, $code, $previous);
      }
    }     
    else  
        throw new Exception(core::redirecionar('menu/erro404'),404);        
    
    