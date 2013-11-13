<?php  if(!defined('BASEPATH')) exit('Falha no carregamento do script!');

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$titulo_page ?></title>
<?php
   //Insira aqui as includes para o style 
?>

</head>

<body>  
        <?php 
            if(isset($content_page)){
                echo $content_page;} 
        ?>
</body>
</html>