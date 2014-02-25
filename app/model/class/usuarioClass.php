<?php
  /* Código Gerado pelo Iwork
     @author Ítalo Patrício 
  */
 class usuarioClass extends controller {

	 #Atributos

	 private $nome;
	 private $login;
	 private $senha;
	 private $id;

	 #Propriedades dos atributos
	 public function setnome($nome){
	   $this->nome=$nome;
	 }
	 public function getnome(){
	   return $this->nome;
	 }
	 public function setlogin($login){
	   $this->login=$login;
	 }
	 public function getlogin(){
	   return $this->login;
	 }
	 public function setsenha($senha){
	   $this->senha=$senha;
	 }
	 public function getsenha(){
	   return $this->senha;
	 }
	 public function setid($id){
	   $this->id=$id;
	 }
	 public function getid(){
	   return $this->id;
	 }
}