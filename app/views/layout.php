<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $params['titulo'] ?></title>
<?php
   //Insira aqui as includes para o style 
?>

</head>

<body>  
<h1> LAYOUT</h1>
        <?php 
            if(isset($content)){
                echo $content;} 
        ?>
</body>
</html>
