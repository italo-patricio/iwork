<?php if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

/**
 * Description of usuarioControl
 *
 * @author italo
 */

 //Inicio a sessão para poder utilizar a session com os valores das requisições
 session_start();

 class usuario extends crud{
      
    
   public function validar(){
        
    //armazeno na variavel $var os valores na sessão vals
    $var = $_SESSION['session'];
       
    $ret = $this->validarusu($var['user'],$var['pass']);
    //print_r($ret);  
    if($ret!=NULL){
          $_SESSION['session']['logado']= $ret;
          
          redirecionar('?action=index');          
      } 
      else {
         redirecionar('?action=seguranca');
      }
    }
    
  private function validarusu($login,$senha){   
   

               
               //$crud = new crud();
               
               $dados = array('*');
               /*CONSULTAR*/
               $res = self::consultar($dados,'advogado',"login='{$login}' AND senha_pessoal='{$senha}'");
               
               return $res; 
               
               
              
               
        }
   private function cadastrar(){
            
                
   }
}

 /*CONSULTAR*/
               /*  $dados = array('(SELECT nome FROM menu WHERE idmenu = menu_idmenu) as menu');
               
               $res = $crud->consultar($dados, 'permissao','usuario_idusuario = 3');
               foreach ($res as $row){
                   echo '<br />'.$row['menu'];
               }*/
               /*FIM CONSULTA */
               
               /*DELETAR*/
               /*
               $tabela = 'setor' ;
               $valor ='teste';
               $where = "nome ='{$valor}'";
               $result = $crud->deletar($tabela, $where);
                if($result > 0){
                    echo 'deletado  com sucesso';
                }
                else {
                    echo 'falha ao tentar deletar';
                }*/
               /*FIM DELETAR */
               
               /*INSERIR */
               /* $nome = 'test' ;
               $dadosAlt = array( 'nome' =>$nome );
               
               $result = $crud->inserir($dadosAlt, 'setor');
                if($result > 0){
                    echo 'insercao realizada com sucesso';
                }
                else {
                    echo 'falha na insercao';
                }*/
               /*FIM INSERIR */
               
               /*ATUALIZAR */
               /* 
               $nome = 'usuario' ;
               $senha = '123';
               $dadosAlt = array( 'nome' =>$nome,
                                  'senha'=>$senha  
                   );
               $where = 'idusuario = 3';
               $result = $crud->atualizar('usuario', $dadosAlt, $where);
                if($result > 0){
                    echo 'atualizacao realizada com sucesso';
                }
                else {
                    echo 'falha na atualizacao';
                }*/
               /*FIM ATUALIZAR */

