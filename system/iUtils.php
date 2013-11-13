<?php

class iUtils
{
	private $config = array();
	
	public static function setConfig($var)
	{
		$config = $var;
	}
	
	public static function getConfig()
	{
		return $this->config;
	}
	
	
}/*
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
*/
