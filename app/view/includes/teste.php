<?php if(!defined('BASEPATH')) exit(header('Location: ../../../'));

?>

<!-- INICIO CONTEUDO -->
<?php
    $form = new GeradorForm(array('id'=>'form','method'=>'post'));
        #$form->setAtributos_form();
        $form->addCampo(NULL,'maskDate','data','text','Data: ','dia/mes/ano',NULL,NULL,TRUE);
        $form->addSelect('cor',['1'=>'Azul','2'=>'Amarelo','3'=>'Branco']);
        $form->addCampo(NULL,NULL,'bt','submit',NULL,'Validar');
        $form->show();
?>
        
<!-- FIM CONTEUDO -->