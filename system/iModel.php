<?php

class iModel {
	
	private $_config;
	
    protected $_model;
    
    protected $_instance;

    protected $_result;
 
 
 /*
    public function __construct() {
        $this->_model = get_class($this);
        $this->_table = strtolower($this->_model)."s";
    }
 
    public function __destruct() {
    }
    
    private function connect() 
    {
		if($this->_instance != null)
		{
			$this->_instance = mysql_connect($this->_config['mysql']['address'], $this->_config['mysql']['username'], $this->_config['password']);
			
			if($this->_instance) 
			{
				if (!mysql_select_db($this->_config['mysql']['dbname'], $this->_instance))
					echo exit(utf8_decode('Banco de dados não encontrado <br/> Erro: '. mysql_error()));
			} else echo exit(utf8_decode('Falha na conexão do banco <br/> contate o administrador <br/> Erro: ' . mysql_error()));
		
		}
    }

    
    
    
    public static function setConfig($config)
    {
		$this->_config = $config;
		$this->connect();
	}*/
    
}

