<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
/**
 * Description of core
 *
 * @author italo
 */

function seguranca_arq(){
        if(isset($_SESSION['session']['logado'])){//verifica se usuario está logado e para verificar se ele tem acesso a página
            
        }
        else{
            //echo 'nao logado';
            redirecionar();
        }
        
        
    }
   function startCookie($name,$value,$expire){
       #Inicia o cookie
        setcookie($name, $value, $expire);
   
   }
   function stopCookie($name){
       #Encerra o cookie
        setcookie($name,NULL,-1);
   } 
   //criar sessão NÃO FOI TOTALMENTE TESTADO FUNCIONAMENTO INCERTO
   function startSession($nomeDaSessao=NULL,$time=30,$cache_limiter='private'){
          /* Define o limitador de cache para 'private' */
          session_cache_limiter($cache_limiter);

          /* Define o limite de tempo do cache em minutos */
          session_cache_expire($time);
          //session_cache_expire();

          /* Define um nome para sessão */
          session_name($nomeDaSessao);

          /* Define o local do arquivo da session*/
          session_save_path(BASETEMP);

          /* Inicia a sessão */
          session_start();     
       }//
       
  function stopSession($nomeDaSessao = NULL){
          if($nomeDaSessao==NULL)
              session_destroy();
          else 
              session_unset ($nomeDaSessao);
  }
   
  //carrega todos os Css's de uma pasta  
  function allLoadCss($path){
      
    $diretorio = dir($path);

    while($arquivo = $diretorio -> read()){
       //verifica apenas as extenções do css 
        if(strpos($arquivo, '.css')!==FALSE)
          echo ("<link  rel='stylesheet' href='".BARRA.url_base.BARRA.$path.$arquivo."' type='text/css' />\n");
    }
    $diretorio -> close();

  }
  //carrega todos os Js's de uma pasta  
  function allLoadJs($path){
      
    $diretorio = dir($path);

    while($arquivo = $diretorio -> read()){
       //verifica apenas as extenções do css 
        if(strpos($arquivo, '.js')!==FALSE)
          echo ("<script  src='".BARRA.url_base.BARRA.$path.$arquivo."' type='text/javascript'></script>\n");
    }
    $diretorio -> close();

  }  
  //carrega o Css  
  function loadCss($arquivoCss,$base=NULL){
      $base = $base!=NULL ? $base : BASECSS;
        if(file_exists($base.$arquivoCss.'.css')) 
        return print ('<link  rel="stylesheet" href="'.BARRA.url_base.BARRA.$base.$arquivoCss.'.css" type="text/css" />');
       else
        return print ("Falha no carregamento do arquivo {$arquivoCss}.css");
  }
  //carrega o js 
  function loadJs($arquivoJs,$base=NULL){ 
    $base = $base!=NULL ? $base : BASEJS;
     if(file_exists($base.$arquivoJs.'.js')) 
     return print ('<script  src="'.BARRA.url_base.BARRA.$base.$arquivoJs.'.js" type="text/javascript" ></script>');
     else
     return print ("Falha no carregamento do arquivo {$arquivoJs}.js");
  }
  //redireciona
  function redirecionar($local=null){
           header('location:  /'.url_base.BARRA.$local);
    }

/**----------Criar mensagens-----------**/
 function msg($tipo,$msg){
     switch ($tipo) {
         case '1':
             $tipoMsg = 'success';
             break;
          case '2':
             $tipoMsg = 'info';
             break;
          case '3':
             $tipoMsg = 'warning';
             break;
          case '4':
             $tipoMsg = 'danger';
             break;
         default:
            $tipoMsg = 'info';
             break;
     } 
    $_SESSION['msg'] = array('tipo'=>$tipoMsg,'texto'=>$msg);  
 }