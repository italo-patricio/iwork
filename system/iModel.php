<?php

// UTILIZAR PADRÃO SINGLETON AQUI
// USAR PDO PARA PODER UTILIZAR MYSQL E POSTGRE

class iModel {

    private static $_instance = null;
	
	private $_config;
	
    protected $_model;
    

    protected $_result;
    
    protected $_table;
    
    public function __construct($config)
    {
		$this->_config = $config;
		$this->_model = get_class($this);
		$this->_table = $this->_model."s";
		//$this->connect();
	}
	
	//private static function getDB()
	//{
	//	if (self::$_instance === null)
	//		self::$_instance = new i
	//	return self::$_instance;
	//}
	
	/*
	public function connect() 
    {
		if($this->_instance == null)
		{
			$this->_instance = mysql_connect($this->_config['address'], $this->_config['username'], $this->_config['password']);
			
			if($this->_instance) 
			{
				if (!mysql_select_db($this->_config['dbname'], $this->_instance))
					echo exit(utf8_decode('Banco de dados não encontrado <br/> Erro: '. mysql_error()));
			} else echo exit(utf8_decode('Falha na conexão do banco <br/> contate o administrador <br/> Erro: ' . mysql_error()));		
		}
		return $this->_instance;
    }

	public function inserir(array $campos, $tabela)
	{
		$coluna = implode(", ",  array_keys($campos));
		$valor = "'".implode("', '", array_values($campos))."'";
		
		$query = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$valor})";
		
		try{
			//$this->connect()->exec($query);
		}
		catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
			$result = -1;
		}
	}
	
	public function consultar(array $select, $tabela, $where = null, $order = null, $limit = null){
		$where = ($where == null) ? null : "WHERE {$where}";
	
		if($select != "*"){
			$select = implode(", ", $select);
		} else {
			$select = "*";
		}
		
		$order = ($order == null) ? null : "ORDER BY {$order}";
		$limit = ($limit == null) ? null : "LIMIT {$limit}";
		
		$query = "SELECT {$select} FROM {$tabela} {$where} {$order} {$limit}";

		try {
			$result = $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
			$result = -1;
		}

		return $result;
	}
 
 /*



    
        
        
        
        
        public function deletar($tabela, $where){
            $query = "DELETE FROM {$tabela} WHERE {$where}";
            
             try{
                $this->conectar()->exec($query);
              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            return $result;  
        }
        
        public function atualizar($tabela, array $set, $where){
            foreach($set as $chave => $valor){
                $campos[] = "{$chave}='{$valor}'";
            };
            $campos = implode(", ", $campos);
            $query = "UPDATE {$tabela} SET {$campos} WHERE {$where}";
          
            try{
                $result = $this->conectar()->exec($query);
              }
            catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
             }
          return $result; 
       }
}


	* 
	* */
    
}

