<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testeControl
 *
 * @author Ítalo
 */
class teste {
    public function test(){
        //$usuario = $_SESSION['session']['logado'][0];
  //echo 'Nome do cara: '.$usuario['nome'];
 //addCampo($name,$tipo,$label=NULL,$placeholder=NULL,$value=NULL,$onClick=NULL,$endl=FALSE,$required=FALSE,$pattern=NULL)
        $form = new GeradorForm(array('id'=>'form','method'=>'post'));
        #$form->setAtributos_form();
        $form->addCampo(NULL,'maskDate','data','text','Data: ','dia/mes/ano',NULL,NULL,TRUE);
        $form->addSelect('cor',['1'=>'Azul','2'=>'Amarelo','3'=>'Branco']);
        $form->addCampo(NULL,NULL,'bt','submit',NULL,'Validar');
        $form->show();
    }
}
