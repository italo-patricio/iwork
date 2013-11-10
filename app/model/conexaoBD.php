<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

/*
* Classe conexão DAO
* -------------------------------------
*/
class conexaoBanco extends controller{

	public $pdo;

	public function conectar(){
            
		// Conexao com MySQL via PDO
                $dsn = "{$this->db_driver}:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";
                $usuario = $this->db_user;
                $senha = $this->db_senha;
            $opcoes = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_CASE => PDO::CASE_LOWER
		);

		try {
			$this->pdo = new PDO($dsn, $usuario, $senha, $opcoes);
		} catch (PDOException $e) {
			echo utf8_decode('Falha na conexão do banco <br/> contate o administrador <br/> Erro: '.$e->getMessage());
		}
	}
}

