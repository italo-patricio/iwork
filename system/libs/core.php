<?php if(!defined('BASEPATH')) exit(header('Location: ../../index.php'));
/**
 * Description of core
 *
 * @author italo
 */
class core{
    
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
  public static function redirecionar($local=null,$replace=TRUE,$http_response_code=NULL){
           header('location:  /'.url_base.BARRA.$local,$replace,$http_response_code);
           #header($string, $replace, $http_response_code)
    }
 
  public static function allLoadArq($path, $arq=NULL, $ext=NULL){
      $ext = $ext ==NULL ? ".php" : $ext ;
      
      if(is_null($arq)){
      $require = NULL;
      
        
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

 /*------------------Gerador de CRUD para modelo AR-Active Record------------------*/ 
  public static function syncdbAR(){
     $TbName = array(); //armazena os nomes das tabelas existentes no banco pre configurado no configDB
      
      $ColName = array();//armazena os nomes das colunas de cada tabela
       foreach (crud::consultarNometb() as $value) {
           foreach ($value as $val){
               $TbName[] = $val;
           }
       }
       foreach ($TbName as $value){
           $ColName[$value] = crud::consultarNomeColuna($value); 
       }

           
       foreach ($ColName as $key => $value) {
               /*Crio as pastas para inserir a modelagem do sistema gerado de acordo
                *  com a modelagem do banco configurado na configDB*/ 
              try {
                 if( !file_exists(BASEAPLICATION.'model'))
                    if(!mkdir(BASEAPLICATION.'model/'))  
                       throw new Exception;
                 if( !file_exists(BASEVIEWINC.$key))
                    if(!mkdir(BASEVIEWINC.$key.'/'))  
                       throw new Exception;
                  
                 $arquivoControl = fopen(BASECONTROL.$key.'Control.php', 'w+');
                 if($arquivoControl){
                    if (fwrite($arquivoControl, static::gerarControl($key))){
                        echo "Arquivo {$key}Control criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Control !\n<br>";    
                    }
                    fclose($arquivoControl);
                 }  
                 $arquivoModel = fopen(BASEAPLICATION.'model/'.$key.'.php', 'w+');
                 if($arquivoModel){
                    if (fwrite($arquivoModel, static::gerarModelAR($key))){
                        echo "Arquivo {$key} Model criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Dao !\n<br>";    
                    }
                    fclose($arquivoModel);
                  }
                  $arquivoForm = fopen(BASEVIEWINC.$key.BARRA.'_form.php', 'w+');
                 if($arquivoForm){
                    if (fwrite($arquivoForm, static::gerarView_Form($key, $value))){
                        echo "Arquivo {$key}/_form.php criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}/_form.php !\n<br>";    
                    }
                    fclose($arquivoForm);
                  }
                 $arquivoManage = fopen(BASEVIEWINC.$key.BARRA.'_manage.php', 'w+');
                 if($arquivoManage){
                    if (fwrite($arquivoManage, static::gerarView_Manage($key, $value))){
                        echo "Arquivo {$key}/_manage.php criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}/_manage.php !\n<br>";    
                    }
                    fclose($arquivoManage);
                  }
                 $arquivoView = fopen(BASEVIEWINC.$key.BARRA.'_view.php', 'w+');
                 if($arquivoView){
                    if (fwrite($arquivoView, static::gerarView_View($key, $value))){
                        echo "Arquivo {$key}/_view.php criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}/_view.php !\n<br>";    
                    }
                    fclose($arquivoView);
                  }
                 $arquivoUpdate = fopen(BASEVIEWINC.$key.BARRA.'_update.php', 'w+');
                 if($arquivoUpdate){
                    if (fwrite($arquivoUpdate, static::gerarView_Update($key, $value))){
                        echo "Arquivo {$key}/_update.php criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}/_update.php !\n<br>";    
                    }
                    fclose($arquivoUpdate);
                  }
              } catch (Exception $ex) {
                  echo utf8_decode('Falha: Verifique se a pasta model e '.$key.' já existe, se existir '
                  . 'exclua-a e tente executar o método novamente, caso persista '
                  . 'contate o administrador ou clique <a href="https://github.com/itxinho/iwork">aqui</a>.!');
              } 
      }
  }
    private static function gerarControl($tabela){
        $conteudoControl = 
"<?php if (!defined('BASEPATH')) exit(header('Location: ./../../'));

/**
 * Description of {$tabela}Control
 *
 * @author Ítalo Patrício
 * @author Servulo Fonseca 
 */
class {$tabela}Control extends controller {



    public function __construct() {
        parent::__construct();
       \$this->include = '{$tabela}/';
    }

//View's
    public function index() {

    }

    public function manage() {
        try {
            \$this->atr_page['titulo'] = 'Gerenciar {$tabela}';
            \${$tabela} = {$tabela}::all();
            \$this->atr_page['{$tabela}'] = (object) \${$tabela};
            \$this->res[] = \$this->atr_page;

            \$this->view('_manage', \$this->res);
        } catch (ActiveRecord\ExpressionsException \$ex) {
            echo 'Houve falha!';
        }
    }

    public function form() {
        \$this->atr_page['titulo'] = 'Criar {$tabela}';
        \$this->res[] = \$this->atr_page;

        \$this->view('_form', \$this->res);
    }
    public function edit(\$param) {
         \$this->atr_page['titulo'] = 'Alterar {$tabela}';
         \${$tabela} = {$tabela}::find(\$param[0]['valor']);
         \$this->atr_page['{$tabela}'] = (object) \${$tabela};
         \$this->res[] = \$this->atr_page;

        \$this->view('_update', \$this->res);
    }


//Action
    public function create() {
        try {
            \${$tabela} = new {$tabela}(\$_POST);
            \${$tabela}->save(true);
            echo 'Salvo com sucesso!';
        } catch (ActiveRecord\ActiveRecordException \$ex) {
            echo 'Houve falha!';
        }
    }

    public function read(\$param) {
        try {

            \$this->atr_page['titulo'] = 'Visualizar {$tabela}';
            \${$tabela} = {$tabela}::find(\$param[0]['valor']);
            \$this->atr_page['{$tabela}'] = (object) \${$tabela};
            \$this->res[] = \$this->atr_page;

            \$this->view('_view', \$this->res);
        } catch (\ActiveRecord\ExpressionsException \$ex) {
            echo 'Houve falha!';
        }
    }

    public function update(\$param) {
      try {          
            \${$tabela} = {$tabela}::find(\$param[0]['valor']);
            \${$tabela}->update_attributes(\$_POST);
            core::redirecionar(\$this->include.'manage');
        } catch (\ActiveRecord\ExpressionsException \$ex) {
            echo 'Houve falha!';
        }
    }
    public function delete(\$param) {
        try {
            \${$tabela} = {$tabela}::find(\$param[0]['valor']);
            \${$tabela}->delete();
            core::redirecionar(\$this->include.'manage');
        } catch (\ActiveRecord\ExpressionsException \$ex) {
            echo 'Houve falha!';
        }
    }

}
"
            ;
            return $conteudoControl;
    }
    private static function gerarModelAR($tabela){
        $conteudoModel = 
                "<?php "
              . "\n  /* Código Gerado pelo Iwork"
              . "\n     @author Ítalo Patrício "
              . "\n     @author Servulo Fonseca "
              . "\n  */"
              . "\n class {$tabela} extends ActiveRecord\Model{}"
            ;
            return $conteudoModel;      
    }
    private static function gerarView_Form($tabela, $atributos){
        $conteudoForm ='';
        foreach ($atributos as $value) {

        if(stristr('int', $value['Type']))
            $input = "<input type=\"number\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\">";
            if(stristr('varchar', $value['Type']))
            $input = "<input type=\"text\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\">";
            else if(stristr('date', $value['Type']))
            $input = "<input type=\"date\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\">";
            else if(stristr('datetime', $value['Type']))
            $input = "<input type=\"datetime\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\">";
            else if(stristr('text', $value['Type']))
            $input = "<textarea class=\"form-control\" rows=\"4\" cols=\"50\" id=\"{$value['Field']}\" name=\"{$value['Field']}\"></textarea>";
            else 
            $input = "<input type=\"text\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\">";
    
            $conteudoForm .= 
"<div class=\"form-group\">

    <label for=\"{$value['Field']}\">{$value['Field']}</label>

    {$input}

</div> 
               ";
        }
        
        $conteudoModel = 
"<form action=\"<?php echo BARRA.url_base.BARRA.\"{$tabela}/create\" ?>\" method=\"POST\" >"

    .$conteudoForm

."<button type=\"submit\" class=\"btn btn-primary\">Cadastrar</button>

</form>"
            ;
            return $conteudoModel; 
    }
    private static function gerarView_Manage($tabela, $atributos){
        
        $primary_key= '';
        $camposHead = '';
        $camposBody = '';
        foreach ($atributos as $value) {
            if(stristr($value['Key'],'pri'))
                $primary_key = $value['Field'];
            
            $camposHead .= "<th>{$value['Field']}</th>";
            $camposBody .= "<td>{\${$tabela}->{$value['Field']}}</td>";
        }
        
        
        $conteudoManage = 
"<?php \${$tabela} = \$val[0]['{$tabela}']; ?>
   <table class=\"dataTable\">
   <thead>
       {$camposHead}
       <th>Opções</th>    
   </thead>
   <tbody>
     <?php
       foreach (\${$tabela} as \${$tabela}){ 
           echo  \"<tr>\"
               . \"{$camposBody}\"
               . \"<td>\"
                   . \"<a href='\".BARRA.url_base.BARRA.\"{$tabela}/read/id/{\${$tabela}->{$primary_key}}'><span class='glyphicon glyphicon-eye-open' title='Visualizar'></span></a> \"
                   . \"<a href='\".BARRA.url_base.BARRA.\"{$tabela}/edit/id/{\${$tabela}->{$primary_key}}'><span class='glyphicon glyphicon-pencil' title='Editar'></span></a> \"
                   . \"<a href='\".BARRA.url_base.BARRA.\"{$tabela}/delete/id/{\${$tabela}->{$primary_key}}'><span class='glyphicon glyphicon-trash' title='Excluir'></span></a>\"
               . \"</td>\"
               . \"</tr>\"
               ;
       } ?>  
   </tbody>
   </table>"
                ;
        
        return $conteudoManage;
    }
    private static function gerarView_View($tabela, $atributos){
        $dadosView = "";
        
        foreach ($atributos as $value) {
            $dadosView .= "
                            <tr>
                                <td>{$value['Field']}</td>
                                <td><?=\${$tabela}->{$value['Field']}?></td>                
                            </tr>"
                    ;
        }
        
        $conteudoView =""
. "<?php  \${$tabela} = \$val[0]['{$tabela}']; ?>

    <table class=\"table\">
            {$dadosView}
    </table>
        ";
        
        return $conteudoView;
    }    
    private static function gerarView_Update($tabela, $atributos){
        $primary_key  ='';
        $conteudoForm ='';
        foreach ($atributos as $value) {
            if(stristr($value['Key'],'pri'))
            $primary_key = $value['Field']; 
            if(stristr($value['Type'],'int'))
            $input = "<input type=\"number\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\"> value=\"<?=\${$tabela}->{$value['Field']}?>\" ";
            if(stristr($value['Type'],'varchar'))
            $input = "<input type=\"text\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\" value=\"<?=\${$tabela}->{$value['Field']}?>\" >";
            else if(stristr($value['Type'],'date'))
            $input = "<input type=\"date\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\" value=\"<?=\${$tabela}->{$value['Field']}?>\" >";
            else if(stristr($value['Type'],'datetime'))
            $input = "<input type=\"datetime\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\" value=\"<?=\${$tabela}->{$value['Field']}?>\" >";
            else if(stristr($value['Type'],'text'))
            $input = "<textarea class=\"form-control\" rows=\"4\" cols=\"50\" id=\"{$value['Field']}\" name=\"{$value['Field']}\"><?=\${$tabela}->{$value['Field']}?></textarea>";
            else 
            $input = "<input type=\"text\" class=\"form-control\" id=\"{$value['Field']}\" name=\"{$value['Field']}\" placeholder=\"{$value['Field']}\" value=\"<?=\${$tabela}->{$value['Field']}?>\" >";
        
             $conteudoForm .= 
"<div class=\"form-group\">

    <label for=\"{$value['Field']}\">{$value['Field']}</label>

    {$input}

</div> 
               ";
        } 
        
        $conteudoUpdate = ""
. "<?php  \${$tabela} = \$val[0]['{$tabela}']; ?>

<form action=\"<?php echo BARRA . url_base . BARRA . \"{$tabela}/update/id/{\${$tabela}->{$primary_key}}\" ?>\" method=\"POST\" >

 {$conteudoForm}

<button type=\"submit\" class=\"btn btn-primary\">Editar</button>

</form>

            ";
        
       return $conteudoUpdate;          
    }
    
    
  /*------------------Gerador de CRUD de acordo com modelagem------------------*/
  public static function syncdb(){
      
      $TbName = array(); //armazena os nomes das tabelas existentes no banco pre configurado no configDB
      
      $ColName = array();//armazena os nomes das colunas de cada tabela
       foreach (crud::consultarNometb() as $value) {
           foreach ($value as $val){
               $TbName[] = $val;
           }
       }
       foreach ($TbName as $value){
           $ColName[$value] = crud::consultarNomeColuna($value); 
       }
      
       foreach ($ColName as $key => $value) {
               /*Crio as pastas para inserir a modelagem do sistema gerado de acordo
                *  com a modelagem do banco configurado na configDB*/ 
              try {
                if( !file_exists(BASEAPLICATION.'model')){
                        if(!mkdir(BASEAPLICATION.'model/'))  
                            throw new Exception;
                        if(!mkdir(BASEAPLICATION.'model/class/'))  
                            throw new Exception;
                        if(!mkdir(BASEAPLICATION.'model/dao/'))  
                            throw new Exception;
                 }
                  
                 $arquivoClass = fopen(BASEAPLICATION.'model/class'.BARRA.$key.'Class.php', 'w+');
                 if($arquivoClass){
                    if (fwrite($arquivoClass, static::gerarModelClass($key, $value))){
                        echo "Arquivo {$key}Class criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Class !\n<br>";    
                    }
                    fclose($arquivoClass);
                 }  
                 $arquivoDao = fopen(BASEAPLICATION.'model/dao'.BARRA.$key.'Dao.php', 'w+');
                 if($arquivoDao){
                    if (fwrite($arquivoDao, static::gerarModelDao($key, $value))){
                        echo "Arquivo {$key}Dao criado com sucesso!\n<br>";
                    }
                    else{
                        echo "Falha ao criar arquivo {$key}Dao !\n<br>";    
                    }
                    fclose($arquivoDao);
                  }  
              } catch (Exception $ex) {
                  echo utf8_decode('Falha: Verifique se a pasta model já existe, se existir '
                  . 'exclua-a e tente executar o método novamente, caso persista '
                  . 'contate o administrador ou clique <a href="https://github.com/itxinho/iwork">aqui</a>.!');
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
        $arrayAtrSelect = array();
        $whereRead = '';
        foreach ($atributos as $value){
          $atributosWhereRead .= "\n\t \$where_{$value['Field']} = \${$tabela}->get{$value['Field']}() == NULL ? '' : \" {$value['Field']}='{\${$tabela}->get{$value['Field']}()}'\" ;";
          $arrayRead[] = "\$where_{$value['Field']}";
          $arrayAtrSelect[] = $value['Field'];
        }
       $arraySelect = empty($arrayAtrSelect) ? "*" : $arrayAtrSelect; 
       $whereRead = implode(',',$arrayRead);
        $conteudoRead =
                "\n\t #função para consultar {$tabela}"
              . "\n\t public function read(\${$tabela},\$arraySelect = array(),\$or=FALSE){"
              . "\n\t\$select_name = empty(\$arraySelect) ? array('*') : \$arraySelect;"
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
              . "\n\t return crud::consultar(\$select_name,'{$tabela}', \$where, TRUE);"
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