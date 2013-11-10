<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

/*
 * Arquivo core:
 *  Contém métodos para ajudar na criação do sistema.
 */
require_once (BASESYSTEM.'GeradorForm.php');  
  //carrega o Css  
  function loadCss($arquivoCss){ 
        if(file_exists(BASECSS.$arquivoCss.'.css')) 
        return print ('<link  rel="stylesheet" href="'.BASECSS.$arquivoCss.'.css" type="text/css" />');
        else
        return print ("Falha no carregamento do arquivo {$arquivoCss}.css");
  }
  //carrega o js
  function loadJs($arquivoJs){ 
     if(file_exists(BASEJS.$arquivoJs.'.js')) 
     return print ('<script  src="'.BASEJS.$arquivoJs.'.js" type="text/javascript"></script>');
     else
     return print ("Falha no carregamento do arquivo {$arquivoJs}.js");
  }
  //redireciona 
  function redirecionar($local=null){
           header('location:  '.$local);
  }
