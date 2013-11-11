<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

 
if(isset($_REQUEST['install'])){
if(ini_get('allow_url_fopen') == 1){
      
        $fp = fopen(BASESYSTEM."configDB.php", "w+");     
        
    
         if($fp){
        $escreve = fwrite($fp, 
"<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

/**
 * Description of configDB
 *
 * @author italo
 */
  class configDB{

            protected \$db_host  = '{$_REQUEST['host']}';
            protected \$db_driver = 'mysql';
            protected \$db_port ='{$_REQUEST['port']}';
            protected \$db_user = '{$_REQUEST['user']}';
            protected \$db_senha = '{$_REQUEST['senha']}';
            protected \$db_name = '{$_REQUEST['dbname']}';
   }");

        fclose($fp);
        
            print 'criado com sucesso!';
            redirecionar('action=index');
                 }
            else {
          print 'Falha ao tentar criar arquivo!';    
         }
 
    }
    else {
           print 'fopen desativo!';
        }
 }
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instalação phpIwork</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript">
 $(function(){
     $('#dadosDB').validate({
         rules:{
             host:{required: true},
             port:{required: true},
             user:{required: true},
             senha:{required:true},
             dbname:{required:true}
         },
         messages:{
             host: "Preencha o campo HOST!",
             port: "Preencha o campo PORTA!",
             user: "Preenhca o campo USUARIO",
             senha: "Preencha o campo SENHA",
             dbname:"Preencha o campo DBNAME"
         }
     });
 });
</script>
</head>
    <body>
        <h1>Instalando phpIwork...</h1>
        <div> 
            <fieldset>
            <legend>Informações da base de dados</legend>
            <form action="" method="POST" id="dadosDB">
                <label>Host:</label><br><input type="text" name="host" /><br>
                <label>Porta:</label><br><input type="text" name="port" /><br>
                <label>Usuario:</label><br><input type="text" name="user" /><br>
                <label>Senha:</label><br><input type="text" name="senha" /><br>
                <label>DbName:</label><br><input type="text" name="dbname" /><br>
                <input type="submit" class=""   name="install" value="Próximo" />
            </form>
            </fieldset>
        </div>
        
    </body>
</html>
 
 
 
 
 
 