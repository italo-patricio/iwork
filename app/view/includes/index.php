<!--
	Início de conteúdo
-->

<h1>Primeira página com PHPIwork.</h1>
<?php 

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
