<?php if (!defined('BASEPATH')) exit(header('Location: ../../../'));

       if(isset($this->atr_page['titulo']) && $this->atr_page['titulo'] !=NULL);
       else $this->atr_page['titulo'] = 'sem titulo'; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">


        <title><?= $this->atr_page['titulo'] ?></title>

        <!-- Carrega todos os CSS's -->
<?php
core::allLoadCss(BASECSS);
?>


        <!-- Bootstrap core JavaScript
        ================================================== -->
<?php
core::allLoadJs(BASEJS);
?>

    </head>

    <body>

        <!-- Wrap all page content here -->
        <div id="wrap">


            <div class="container">  
<?php
if (isset($content_page))
    echo $content_page;
else
    echo "Falha no carregamento da página!";
?>
            </div>
        </div>

        <div id="footer">
            <div class="container">
                <p class="text-muted">Todos os direitos reservados à <a href="http://www.italopatricio.com.br">IWORK</a>.</p>
            </div>
        </div>



        <!-- Placed at the end of the document so the pages load faster -->
    </body>
</html>


