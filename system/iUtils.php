<?php

class iUtils
{
	private static $baseURL = null;
	
	private static $baseResource = null;
	
	/**
	 * Carregando as configurações para as outras funções
	 */
	public static function start()
	{
		
		if (iWork::$config['https'])
			self::$baseURL = 'https://'.$_SERVER['SERVER_NAME'].'/';
		else
			self::$baseURL = 'http://'.$_SERVER['SERVER_NAME'].'/';
			
		
		self::$baseResource = self::$baseURL.'resources/';
	}
	
	/**
	 * Cria os css listados na config
	 */
	public static function registerCSS()
	{
		if(isset(iWork::$config['static']['css']))
			foreach(iWork::$config['static']['css'] as $tag)
				self::link($tag);
	}
	
	/**
	 * Cria os js listados na config
	 */
	public static function registerJS()
	{
		if(isset(iWork::$config['static']['js']))
			foreach(iWork::$config['static']['js'] as $tag)
				self::script($tag);
	}
	
	public static function base()
	{
		echo '<base href="'.self::$baseResource.DS.'images'.DS.'" >';
	}
	
	public static function createURL($url, $params = array())
	{
		return self::$baseURL.$url;
	}
	
	/**
     * Criar uma tag link
	 */
	public static function link($file)
	{
		echo '<link type="text/css" rel="stylesheet" href="'.self::$baseResource.'css'.DS.$file.'.css" />';
	}
	
	/**
	 * Cria uma tag script
	 */
	public static function script($file)
	{
		echo '<script type="text/javascript" src="'.self::$baseResource.'js'.DS.$file.'.js"></script>';
	}
	
	/**
	 * Cria uma tag <a>
	 * 
	 * $url => string('link'); ou array('link'=>...,'token'=>true,'external'=>true)
	 * token=true para antiCSRF via GET,
	 * external=>true para links externos,
	 * 
	 * $params => array('id'=>..,'css'=>...,'style'=>...)
	 * 
	 * @param string $name
	 * @param string/array $url controlle/action
	 * @param array $params
	 */
	public static function a($name, $url, $params=array())
	{
		$html = '';
		
		// se for um array
		if(is_array($url))
		{
			if(isset($url['external'])) 
				$html .= '<a href="'.$url['link'].'/';
			else
				$html .= '<a href="'.self::$baseURL.$url['link'].'/';	
	
			// desabilitando estes dois caras aqui
			$url['link'] = null;
			$url['external'] = null;
		
			foreach ($url as $k => $p)
			{
				if($k != '' && $k != null && $p != '' && $p != null)
				{
					$html .= $k . iWork::$config['url'] . $p . '/'; // $key:$p/
				}
			}
		
		} else {
			$html = '<a href="'.self::$baseURL.$url;
		}
		
		// fechando o link da url
		$html .= '" ';
		
		// cria os atributos da tag
		foreach ($params as $k => $p)
		{
			$html .= $k.'="'.$p.'" ';
		}
		
		$html .= '>'.$name.'</a>';

		echo $html;
	}
	
	/**
	 * Redireciona o usuário
	 * @param string $local
	 */
	public static function redirecionar($url)
	{
		$a = self::createURL($url);
		header('location:  ' . $a);
	}
	
}
