<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');
/**
 * Description of core
 *
 * @author italo
 */
class core extends controller{
    
    public  function __construct() {
        
    }

        public static function seguranca_arq(){
        if(isset($_SESSION['session']['logado'])){//verifica se usuario está logado e para verificar se ele tem acesso a página
            
        }
        else{
            //echo 'nao logado';
            redirecionar();
        }
        
        
    }
    public static function startCookie($name,$value,$expire){
       #Inicia o cookie
        setcookie($name, $value, $expire);
   
   }
   public static function stopCookie($name){
       #Encerra o cookie
        setcookie($name,NULL,-1);
   } 
   //criar sessão NÃO FOI TOTALMENTE TESTADO FUNCIONAMENTO INCERTO
   public static function startSession($nomeDaSessao=NULL,$time=30,$cache_limiter='private'){
          /* Define o limitador de cache para 'private' */
          session_cache_limiter($cache_limiter);

          /* Define o limite de tempo do cache em minutos */
          session_cache_expire($time);
          //session_cache_expire();

          /* Define um nome para sessão */
          session_name($nomeDaSessao);

          /* Define o local do arquivo da session*/
          session_save_path(BASETEMP);

          /* Inicia a sessão */
          session_start();     
       }//
       
   public static function stopSession($nomeDaSessao = NULL){
          if($nomeDaSessao==NULL)
              session_destroy();
          else 
              session_unset ($nomeDaSessao);
  }
   
  //carrega todos os Css's de uma pasta  
  public static function allLoadCss($path){
      
    $diretorio = dir($path);

    while($arquivo = $diretorio -> read()){
       //verifica apenas as extenções do css 
        if(strpos($arquivo, '.css'))
          echo ("<link  rel='stylesheet' href='".BARRA.url_base.BARRA.$path.$arquivo."' type='text/css' />\n");
    }
    $diretorio -> close();

  }
  //carrega todos os Js's de uma pasta  
  public static function allLoadJs($path){
      
    $diretorio = dir($path);

    while($arquivo = $diretorio -> read()){
       //verifica apenas as extenções do js 
        if(strpos($arquivo, '.js'))
          echo ("<script  src='".BARRA.url_base.BARRA.$path.$arquivo."' type='text/javascript'></script>\n");
    }
    $diretorio -> close();

  }  
  //carrega o Css  
  public static function loadCss($arquivoCss,$base=NULL){
      $base = $base!=NULL ? $base : BASECSS;
        if(file_exists($base.$arquivoCss.'.css')) 
        return print ('<link  rel="stylesheet" href="'.BARRA.url_base.BARRA.$base.$arquivoCss.'.css" type="text/css" />');
       else
        return print ("Falha no carregamento do arquivo {$arquivoCss}.css");
  }
  //carrega o js 
  public static function loadJs($arquivoJs,$base=NULL){ 
    $base = $base!=NULL ? $base : BASEJS;
     if(file_exists($base.$arquivoJs.'.js')) 
     return print ('<script  src="'.BARRA.url_base.BARRA.$base.$arquivoJs.'.js" type="text/javascript" ></script>');
     else
     return print ("Falha no carregamento do arquivo {$arquivoJs}.js");
  }
  //redireciona
  public static function redirecionar($local=null){
           header('location:  /'.url_base.BARRA.$local);
    }
 
  public static function allLoadArq($path, $arq=NULL, $ext=NULL){
      $ext = $ext ==NULL ? ".php" : $ext ;
      $require = NULL;
      
      if($arq==NULL){
        
       $diretorio = dir($path);

            while ($arquivo = $diretorio->read()){   
                
                     if(strpos($arquivo, $ext)){
                         #echo "{$arquivo} Incluido!<br>";
                         require_once ($path.$arquivo);
                     }
            }
       $diretorio->close();
      }
      else{
         if(file_exists($path.$arq.$ext)) 
             require_once ($path.$arq.$ext);
      }

   } 


    /**----------Criar mensagens-----------**/
   public static function msg($tipo,$msg){
     switch ($tipo) {
         case '1':
             $tipoMsg = 'success';
             break;
          case '2':
             $tipoMsg = 'info';
             break;
          case '3':
             $tipoMsg = 'warning';
             break;
          case '4':
             $tipoMsg = 'danger';
             break;
         default:
            $tipoMsg = 'info';
             break;
     } 
    $_SESSION['msg'] = array('tipo'=>$tipoMsg,'texto'=>$msg);  
 }
 
 /*------------------Gerador de CRUD de acordo com modelagem------------------*/
  public static function syncdb(){
       #$crud = new crud();
       
       $TbName = array(); //armazena os nomes das tabelas existentes no banco pre configurado no configDB
       //var_dump($tables[0]);
       $ColName = array();//armazena os nomes das colunas de cada tabela
       foreach (crud::consultarNometb() as $value) {
           foreach ($value as $val){
               $TbName[] = $val;
           }
       }
       foreach ($TbName as $value){
           $ColName[$value] = crud::consultarNomeColuna($value); 
       }
       //var_dump($ColName);
       
       foreach ($ColName as $key => $value) {
           ///echo "<b>Tabela:{$key}</b><br>";
           #foreach ($value as $k => $val) {
               //echo "Coluna[$k]:{$val['Field']}<br>";
                 $arquivoClass = fopen(BASEMODELCLASS.BARRA.$key.'Class.php', 'w+');
                 if($arquivoClass){
                    if (fwrite($arquivoClass, static::gerarModelClass($key, $value))){
                        echo "Arquivo {$key}Class criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Class !\n<br>";    
                    }
                    fclose($arquivoClass);
                 }  
                 $arquivoDao = fopen(BASEMODELDAO.BARRA.$key.'Dao.php', 'w+');
                 if($arquivoDao){
                    if (fwrite($arquivoDao, static::gerarModelDao($key, $value))){
                        echo "Arquivo {$key}Dao criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Dao !\n<br>";    
                    }
                    fclose($arquivoDao);
                  }
      }
       
       
     
    }
    private static function gerarModelDao($tabela,$atributos){
        $conteudoDao = 
                "<?php "
              . "\n  /* Código Gerado pelo Iwork"
              . "\n     @author Ítalo Patrício "
              . "\n  */"
              . "\n class {$tabela}Dao extends controller {\n"
              . "\n"
              . static::gerarMethodCreate($tabela, $atributos)
              . static::gerarMethodRead($tabela, $atributos)
              . static::gerarMethodUpdate($tabela, $atributos)
              . static::gerarMethodDelete($tabela, $atributos)
              . "\n}"
            ;
            return $conteudoDao;      
    }
    private static function gerarMethodCreate($tabela,$atributos){
        $atributosCreate = '';
        foreach ($atributos as $value){
            $atributosCreate .= "\n\t \$create ['{$value['Field']}'] = \${$tabela}->get{$value['Field']}();";
        }
           $conteudoCreate = 
                "\n\t #função para criar {$tabela} "
              . "\n\t public function create(\${$tabela}){"
              . "\n\t \$create = array();"
              . $atributosCreate
              . "\n\t return crud::inserir(\$create,'{$tabela}');"
              . "\n\t }"        
           ;
         return $conteudoCreate;       
    }

    private static function gerarMethodRead($tabela,$atributos){
        $atributosWhereRead ='';
        $arrayRead  = array();
        $whereRead = '';
        foreach ($atributos as $value){
          $atributosWhereRead .= "\n\t \$where_{$value['Field']} = \${$tabela}->get{$value['Field']}() == NULL ? '' : \" {$value['Field']}='{\${$tabela}->get{$value['Field']}()}'\" ;";
          $arrayRead[] = "\$where_{$value['Field']}";
          
        }
       $whereRead = implode(',',$arrayRead);
        $conteudoRead =
                "\n\t #função para consultar {$tabela}"
              . "\n\t public function read(\${$tabela},\$or=FALSE){"
              . "\n"
              . $atributosWhereRead
              . "\n\t \$array = array({$whereRead});"
              . "\n\t \$cont = 0;"
              . "\n\t \$where = '';"
              . "\n\t \$and_or = \$or ? '  OR  ' : '  AND  ';"
              . "\n\t foreach (\$array as \$value){"
              . "\n\t   if(\$cont > 0 && \$value!=''){"
              . "\n\t      \$where .= \$and_or.\$value;"
              . "\n\t   }"
              . "\n\t   else if(\$value!=''){"
              . "\n\t       \$where .=\$value;"
              . "\n\t       \$cont+=1;"
              . "\n\t   }"
              . "\n\t }"
              . "\n"
              . "\n\t return crud::consultar(array('*'),'{$tabela}', \$where, TRUE);"
              . "\n\t }"
            ;
      return $conteudoRead;       
    }
    private static function gerarMethodUpdate($tabela,$atributos){
        $whereUpdate ='';
        foreach ($atributos as $value){
           if($value['Key']=='PRI')
           $whereUpdate .= "\n\t   \$where_pk_id = \${$tabela}->get{$value['Field']}();";  
           else    
           $whereUpdate .= "\n\t   if(\${$tabela}->get{$value['Field']}() != NULL) \$update['{$value['Field']}'] = \${$tabela}->get{$value['Field']}();"; 
        }
        $conteudoUpdate = 
                  "\n\t #função para atualizar {$tabela}"
                . "\n\t public function update(\${$tabela}){ "
                . "\n\t  \$update = array();"
                . "\n"
                . $whereUpdate
                . "\n"
                . "\n\t return crud::atualizar('{$tabela}', \$update, \$where_pk_id);"
                . "\n\t }"
            ;
     return $conteudoUpdate;          
    }
    
    private static function gerarMethodDelete($tabela,$atributos){
        $whereUpdate = ''; 
        foreach ($atributos as $value){
           if($value['Key']=='PRI')
           $whereUpdate .= "\n\t   \$where_pk_id = \${$tabela}->get{$value['Field']}() == NULL ? '' : \" {$value['Field']}='{\${$tabela}->get{$value['Field']}()}' \" ;";  
         }
        $conteudoDelete = 
                  "\n\t #função para excluir {$tabela} por pk "
                . "\n\t public function delete(\${$tabela}){"
                . $whereUpdate
                . "\n\t return crud::deletar('{$tabela}', \$where_pk_id);"
                . "\n\t }"
            ;
      return $conteudoDelete; 
    }
    private static function gerarModelClass($tabela, $atributos){
        
        $conteudoAtributos = "\n\t #Atributos\n";
        $conteudoGetSet = "\n\t #Propriedades dos atributos";
        
        foreach ($atributos as $value) {
            $conteudoAtributos .="\n\t private \${$value['Field']};";
            $conteudoGetSet .= 
              "\n\t public function set{$value['Field']}(\${$value['Field']}){\n"
            . "\t   \$this->{$value['Field']}=\${$value['Field']};"
            . "\n\t }"
            . "\n\t public function get{$value['Field']}(){\n"
            . "\t   return \$this->{$value['Field']};"
            . "\n\t }";
           
        }
        
        
        $conteudoClass = "<?php"
                . "\n  /* Código Gerado pelo Iwork"
                . "\n     @author Ítalo Patrício "
                . "\n  */"
                . "\n class {$tabela}Class extends controller {\n"
                . "{$conteudoAtributos}"
                . "\n{$conteudoGetSet}"
                . "\n}"
            ;
       return $conteudoClass;
    }
 
} 