<?php 
  /* Código Gerado pelo Iwork
     @author Ítalo Patrício 
  */
 class usuarioDao extends controller {


	 #função para criar usuario 
	 public function create($usuario){
	 $create = array();
	 $create ['nome'] = $usuario->getnome();
	 $create ['login'] = $usuario->getlogin();
	 $create ['senha'] = $usuario->getsenha();
	 $create ['id'] = $usuario->getid();
	 return crud::inserir($create,'usuario');
	 }
	 #função para consultar usuario
	 public function read($usuario,$arraySelect = array(),$or=FALSE){
         $select_name = empty($arraySelect) ? array('*') : $arraySelect;
	 $where_nome = $usuario->getnome() == NULL ? '' : " nome='{$usuario->getnome()}'" ;
	 $where_login = $usuario->getlogin() == NULL ? '' : " login='{$usuario->getlogin()}'" ;
	 $where_senha = $usuario->getsenha() == NULL ? '' : " senha='{$usuario->getsenha()}'" ;
	 $where_id = $usuario->getid() == NULL ? '' : " id='{$usuario->getid()}'" ;
	 $array = array($where_nome,$where_login,$where_senha,$where_id);
	 $cont = 0;
	 $where = '';
	 $and_or = $or ? '  OR  ' : '  AND  ';
	 foreach ($array as $value){
	   if($cont > 0 && $value!=''){
	      $where .= $and_or.$value;
	   }
	   else if($value!=''){
	       $where .=$value;
	       $cont+=1;
	   }
	 }

	 return crud::consultar($select_name,'usuario', $where, TRUE);
	 }
	 #função para atualizar usuario
	 public function update($usuario){ 
	  $update = array();

	   if($usuario->getnome() != NULL) $update['nome'] = $usuario->getnome();
	   if($usuario->getlogin() != NULL) $update['login'] = $usuario->getlogin();
	   if($usuario->getsenha() != NULL) $update['senha'] = $usuario->getsenha();
	   $where_pk_id = $usuario->getid();

	 return crud::atualizar('usuario', $update, $where_pk_id);
	 }
	 #função para excluir usuario por pk 
	 public function delete($usuario){
	   $where_pk_id = $usuario->getid() == NULL ? '' : " id='{$usuario->getid()}' " ;
	 return crud::deletar('usuario', $where_pk_id);
	 }
}