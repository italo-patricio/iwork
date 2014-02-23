<?php
    class crud extends configDB{
        private static $dsn;
        private static $user;
        private static $senha;
        private static $pdo;  
        
       function monta_obj(){
           
           static::$dsn   = "{$this->db_driver}:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";
           static::$user  = $this->db_user;
           static::$senha = $this->db_senha;
           

        }
        
         
        
        public function __construct() {
            $this->monta_obj();
            //new crud;
        }


        private function __clone() {}
        
        private static function conectar(){
            
            if(empty(static::$pdo)){

                try {
                    static::$pdo = new PDO(static::$dsn, static::$user, static::$senha);
                    static::$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION  );
                    return static::$pdo;
                }
                catch (PDOException $e) {
                  
                    echo exit(utf8_decode("Falha na conexão do banco  <br/> contate o administrador <br/> Erro: {$e->getMessage()}"));
		}
           }
           
        }
        
        public static function consultarNomeColuna($tabela){
           
            $query = "SHOW COLUMNS FROM {$tabela}";
            
             try{
               if(empty(static::$pdo))
                   $result = static::conectar()->query($query)->fetchAll(PDO::FETCH_ASSOC);
               else
               $result = static::$pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            
            return $result;
        }
        public static function consultarNometb(){
           
            $query = "SHOW TABLES ";
            
             try{
               if(empty(static::$pdo))
                   $result = static::conectar()->query($query)->fetchAll(PDO::FETCH_ASSOC);
               else
               $result = static::$pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            
            return $result;
        }
        public static function create_Table_Temp($nameTbTemp,$comando){
            
            $query = " DROP TABLE IF EXISTS {$nameTbTemp}; 
                        CREATE TEMPORARY TABLE {$nameTbTemp} AS({$comando});";
            try{
                if(empty(static::$pdo))
                    $result = static::conectar()->exec($query);
                else
                    $result = static::$pdo->exec($query);
            }
            catch (PDOException $e){
                echo 'Erro: '.$e->getMessage();
             $result = -1;
            }
          return $result;
        }
        public static function inserir(array $campos, $tabela){
            $coluna = implode(", ",  array_keys($campos));
            $valor = "'".implode("', '", array_values($campos))."'";
            
            $query = "INSERT INTO {$tabela} ({$coluna}) VALUES ({$valor})";
            
            try{
                if(empty(static::$pdo))
                    $result = static::conectar()->exec($query);
                else
                   $result = static::$pdo->exec($query);
             }
            catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
             $result = -1;
            }
           return $result; 
        }
        
        public static function consultar(array $select, $tabela, $where = null,$returnObject = FALSE , $order = null, $limit = null){
            $where = ($where == null) ? null : "WHERE {$where}";
            $fetch = ($returnObject) ?  PDO::FETCH_OBJ : PDO::FETCH_ASSOC; 
            
            if($select != "*"){
                $select = implode(", ", $select);
            } else {
                $select = "*";
            };
            
            $order = ($order == null) ? null : "ORDER BY {$order}";
            $limit = ($limit == null) ? null : "LIMIT {$limit}";
            
            $query = "SELECT {$select} FROM {$tabela} {$where} {$order} {$limit}";
            
             try{
                 if(empty(static::$pdo))
                  $result = static::conectar()->query($query)->fetchAll($fetch);
                 else
                  $result = static::$pdo->query($query)->fetchAll($fetch);
              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            
            return $result;
        }
        
        public static function deletar($tabela, $where){
            $query = "DELETE FROM {$tabela} WHERE {$where}";
            
             try{
                if(empty(static::$pdo))
                    $result = static::conectar()->exec($query);
                else
                    $result = static::$pdo->exec($query);
              }
              catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
              }
            return $result;  
        }
        
        public static function atualizar($tabela, array $set, $where){
            foreach($set as $chave => $valor){
                $campos[] = "{$chave}='{$valor}'";
            };
            $campos = implode(", ", $campos);
            $query = "UPDATE {$tabela} SET {$campos} WHERE {$where}";
          
            try{
                if(empty(static::$pdo))
                    $result = static::conectar()->exec($query);
                else
                    $result = static::$pdo->exec($query);
              }
            catch (PDOException $e) {
                 echo 'Erro: '.$e->getMessage();
              $result = -1;
             }
          return $result; 
       }
}