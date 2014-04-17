<?php if(!defined('BASEPATH')) exit(header('Location: ../../index.php'));

/**
 * Description of config
 *
 * @author italo
 */
  class configDB{

            protected $db_host  = 'ENDEREÇO DO BANCO';#'localhost';
            protected $db_driver = 'TIPO DO BANCO'; #pgsql #mysql
            protected $db_port ='PORTA DO BANCO';
            protected $db_user = 'NOME DO USUARIO';
            protected $db_senha = 'SENHA DO BANCO';
            protected $db_name = 'NOME DO BANCO';
   }