<!--
	Início de conteúdo
-->

<h1>Primeira página com PHPIwork.</h1>
<?php 
$array = array('method'=>'post');
$form = new GeradorForm($array);
$form->addCampo('nome','text','Nome:');
$form->addCampo('idade','number','Idade:');
$form->addCampo('bt','submit','','Submeter');
$form->show();
?>
<!--
	Fim de conteúdo
-->
<?php
   
    // titulo pagina
  $titulo_page = 'Primeira Página com PHPIwork';
 
   // conteudo do buffer
  $content_page = ob_get_contents(); 
  
  // Descarta o conteudo do Buffer
  ob_end_clean(); 
  
  //Include com o Template
  include(BASEVIEW."masterpage.php");
