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
	
	
}
