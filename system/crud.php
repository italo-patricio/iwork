<?php
    class crud extends configDB{
        private $dsn;
        private $user;
        private $senha;
        private $pdo;  
        
       function monta_obj(){
           
           $this->dsn = "{$this->db_driver}:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";
           $this->user= $this->db_user;
           $this->senha= $this->db_senha;
           
        }
        
         
        
        function __construct() {
            $this->monta_obj();
        }
        function __clone() {
        }
        private function conectar(){
            
            if(empty($this->pdo)){
                try {
                    $this->pdo = new PDO($this->dsn, $this->user, $this->senha);
                  
                 return $this->pdo;
                }
                catch (PDOException $e) {
                    echo exit(utf8_decode('Falha na conexão do banco <br/> contate o administrador <br/> Erro: '.$e->getMessage()));
		}
           }
           
        }
    
        public function inserir(array $campos, $tabela){
            $coluna = implode(", ",  array_keys($campos));
            $valor = "'".implode("', '", array_values($campos))."'";
            
            $query = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$valor})";
            
            try{
                $this->conectar()->exec($query);
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
            };
            
            $order = ($order == null) ? null : "ORDER BY {$order}";
            $limit = ($limit == null) ? null : "LIMIT {$limit}";
            
            $query = "SELECT {$select} FROM {$tabela} {$where} {$order} {$limit}";
            
             try{
               $result = $this->conectar()->query($query)->fetchAll(PDO::FETCH_ASSOC);
  
              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            
            return $result;
        }
        
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