<?php

// incluindo as bibliotecas de segurança
require_once(BASESYSTEM.'security'.DS.'iSession.php');
require_once(BASESYSTEM.'security'.DS.'iCsrf.php');


class iSecurity
{
	private $_session = null;
	private $_csrf    = null;
	private static $_security= null;
	
	public function __construct()
	{
		$this->_session = new iSession();
		$this->_csrf     = new iCsrf();
	}
	
	/**
	 * Faz as checagens para o usuário a cada requisição
	 */
	public function check()
	{
		
		// Checando hijacking -> evita que um usuário entre em outro
		if ($this->_session->hijacking())
		{
			session_destroy();
			iUtils::redirecionar('error/code500');
		}
			
		
	}
	
	/**
	 * retorna a session
	 */
	public function session()
	{
		return $this->_session;
	}
	
	/**
	 * retorna csrf para link via get ou form via post
	 */
	public function csrf()
	{
		return $this->_csrf;
	}
	
	public static function start()
	{
		if(self::$_security == null)
		{
			self::$_security = new iSecurity();
		}
		return self::$_security;
	}
	
}