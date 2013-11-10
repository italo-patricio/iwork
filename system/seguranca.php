<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
/**
 * Description of seguranca
 *
 * @author italo
 */

session_start();



    function redirecionar($local=null){
           header('location:  '.$local);
    }


