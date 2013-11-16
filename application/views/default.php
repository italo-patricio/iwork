<!DOCTYPE html>
<html lang="en">
<head>
	<?php iUtils::base(); ?>
	<title><?php echo @$params['titulo'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php iUtils::registerCSS(); ?>
</head>

<body>
	<header style="background-color:#CBDEF7; padding-top:24px; padding-bottom:26px">
		<div class="container">
			<div class="col-md-12">
				<h1 class="pull-left"><span style="color:#FF3838" class="glyphicon glyphicon-fire"></span> iWork-MVC</h1>
				<small class="pull-right">
				<?php iUtils::a('https://github.com/auglima/iWork-MVC', array('link'=>'https://github.com/auglima/iWork-MVC','external'=>true), array('style'=>'font-size:14px; color:#333')); ?></small>
			</div>
		</div>
	</header>
	
	<div class="container">
		<div class="col-md-12">
			<?php if(isset($content)){ echo $content; } ?>
		</div>
	</div>
	
  
	<?php iUtils::registerJS(); ?>
</body>
</html>
