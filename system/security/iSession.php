<?php

/**
 * @see http://simonholywell.com/post/2013/05/improve-php-session-cookie-security.html
 * @see http://www.wikihow.com/Create-a-Secure-Session-Managment-System-in-PHP-and-MySQL
 * @see http://www.php.net/manual/en/ref.session.php
 */

class iSession
{	
	/**
	 * Nome do arquivo
	 * @var string
	 */
	private $fileName = 'session_';
	
	private $antiHijackingName = 'SESSIONHIJACKING';
	
	/**
	 * Construtor da classe
	 */
	public function __construct()
	{
		// Define o local onde as session serão gravadas
		session_save_path(BASETEMP);
		
		// Definindo funções custumizadas para o tratamento das sessions
		session_set_save_handler(array($this, 'sessionOpen'), array($this, 'sessionClose'), array($this, 'sessionRead'), array($this, 'sessionWrite'), array($this, 'sessionDestroy'), array($this, 'sessionGC'));
		
		// Previni efeitos inesperados quando se usa objetos como 'save handlers'
		register_shutdown_function('session_write_close');
		
		// iniciando a segurança
		$this->security_start('iwork', false); // false = http, deixar automático depois para http e https
	}
	/**
	 * Utilizar no lugar de session_start()
	 * $secure = true => HTTPS | false = HTTP
	 * @param string $session_name
	 * @param string $secure 
	 */
	private function security_start($session_name, $secure)
	{
		// Garantir que a session cookie não é acessível via javascript.
		$httponly = true;
		
		// Hash algoritmo para usar na sessionid. 
		//Usar hash_algos() para pegar uma lista de hashes disponíveis
		$session_hash = 'sha512';
		
		// Checando se o hash esta disponível
		if (in_array($session_hash, hash_algos())) {
			// Definindo a função de hash.
			ini_set('session.hash_function', $session_hash);
		}
		
		// Quantos bits por caracteres de um hash.
		// Os possíveis valores são '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
		ini_set('session.hash_bits_per_character', 5);
		
		// Diz para o navegador não exibir o cookie para o lado do cliente
		ini_set('session.cookie_httponly', 'On');
		
		// Faz com que as session usem apenas cookies, ou seja, desabilita a
		// session ID passado pelo GET
		ini_set('session.use_only_cookies', 'On');
		
		// Garantir que as session cookies sejam somente enviadas em conexões seguras
		ini_set('session.cookie_secure', 'On');
		
		//ini_set('session.use_cookies', 'On'); ???
		
		// Carregando os parâmestros da 'session cookie'
		$cookieParams = session_get_cookie_params(); 
		
		// Definindo os parâmetros da 'session cookie'
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
		
		// Mudando o nome da seesion
		session_name($session_name);
		
		// Iniciando a session
		session_start();
		
		// Regenera a session e deleta a antiga.
		session_regenerate_id(true);
		
		// Prevenindo Hijacking
		$this->hijacking('start');
	}
	/**
	 * Checa se o usuário é válido para aquela sessão
	 * @return boolean
	 */
	public function hijacking($create = null)
	{
		if ($create == 'start') {
			$_SESSION = array();
			$_SESSION[$this->antiHijackingName] = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		}
		else
		{
			if($_SESSION[$this->antiHijackingName] === md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
				return false;
			else
				return true;
		}
	}
	/**
	 * Funciona como construtor da função session_start() é chamada, a função retorna 'true' o 'false'
	 * @param string $savePath
	 * @param string $sessionName
	 * @return boolean
	 */
	public function sessionOpen($savePath, $sessionName)
	{
		if(!is_dir(BASETEMP))
			if(!mkdir(BASETEMP, 0777))
				return false;
		
		return true;
	}
	/**
	 * Funciona como desconstrutor. Ele é acionada pala chamda da função session_write_close()
	 * @return boolean
	 */
	public function sessionClose()
	{
		return true;
	}
	/**
	 * Ler um session
	 * @param string $sessionId
	 */
	public function sessionRead($sessionId)
	{
		return (string)@file_get_contents(BASETEMP.$this->fileName.$sessionId);
	}
	/**
	 * Grava uma session
	 * @param string $sessionId
	 * @param string $data
	 * @return boolean
	 */
	public function sessionWrite($sessionId, $data)
	{
		return file_put_contents(BASETEMP.$this->fileName.$sessionId, $data) === false ? false : true;
	}
	/**
	 * Chamada quando uma session é destruida com session_destroy()
	 * @param string $sessionId
	 * @return boolean
	 */
	public function sessionDestroy($sessionId)
	{
		$file = BASETEMP.$this->fileName.$sessionId;
		if(file_exists($file))
			unlink($file);
		
		return true;
	}
	/**
	 * Invocado internamente pelo PHP periodicamente para eliminar sessions velhas
	 * @param string $lifetime
	 * @return boolean
	 */
	public function sessionGC($lifetime)
	{
		foreach(glob(BASETEMP.$this->fileName.'*') as $file)
		{
			// tempo da última modificação + $lifetime < time() && arquivo existe?
			if (filemtime($filename) + $lifetime < time() && file_exists($file))
				unlink($file);
		}
		return true;
	}
	
}