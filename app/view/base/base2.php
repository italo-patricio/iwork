<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?= $this->atr_page['titulo'] ?> </title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php
                    core::allLoadCss(BASETHEME.'template1/css/');
                ?>
	</head>
	<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Painel de Controle</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li><a href="#">Usuario</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="glyphicon glyphicon-lock"></i> Sair</a></li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
<div class="row">
	<div class="col-md-3">
      <!-- Left column -->
      <a href="#"><strong><i class="glyphicon glyphicon-home"></i> Inicio</strong></a>  
      
      <hr>
      
      
        
            <ul class="list-unstyled collapse in" id="userMenu">
                
                
                 </li>
        <li class="nav-header">
        <a href="#" data-toggle="collapse" data-target="#menu3">
          <h5>Produtos <i ></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu3">
                <li><a href="system/produtos/cadastro.html"><i ></i> Cadastro</a></li>
                <li><a href="system/produtos/pesquisa.html"><i ></i> Gerenciar</a></li>
            </ul>
            
        </li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">
          <h5>Usuario<i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu2">
                <li><a href="system/usuario/cadastro.html">Cadastro</a>
                </li>
                <li><a href="system/usuario/pesquisa.html">Gerenciar</a>
                </li>
            </ul>
        </li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1">
          <h5>Funcionario<i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu1">
                <li><a href="system/funcionario/cadastro.html">Cadastro</a>
                </li>
                <li><a href="system/funcionario/pesquisa.html">Gerenciar</a>
                </li>
            </ul>
        </li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu4">
          <h5>Cliente<i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu4">
                <li><a href="system/clientes/cadastro.html">Cadastro</a>
                </li>
                <li><a href="system/clientes/pesquisa.html">Gerenciar</a>
                </li>
            </ul>
        </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5">
          <h5>Veiculos<i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu5">
                <li><a href="system/veiculos/cadastro.html">Cadastro</a>
                </li>
                <li><a href="system/veiculos/pesquisa.html">Gerenciar</a>
                </li>
            </ul>
        </li> 
                <li><a href="#"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
            </ul>
        </li>
      
       
          
      
           
      <hr>
      
      <a href="system/finaceiro/finaceiro.html"><strong><i class="glyphicon glyphicon-link"></i> Finaceiro</strong></a>  
      
      <hr>
  	</div><!-- /col-3 -->
    <div class="col-md-9">
        <?php 
            if(isset($content_page))
                echo $content_page;
        ?>
        
        <?php 
        
        ?>
    </div><!--/col-span-9-->
</div>
</div>
<!-- /Main -->

<footer class="text-center">ISR STOCK <a href="#"></a></footer>



  
	<!-- script references -->

        <?php 
            core::allLoadJs(BASETHEME.'template1/js/');
        ?>
	</body>
</html>
