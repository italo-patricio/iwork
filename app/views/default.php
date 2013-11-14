<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo @$params['titulo'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">

</head>

<body>
	
	<header style="background-color:#e1e1e1; padding-top:20px; padding-bottom:20px">
		<div class="container">
			<div class="col-md-12">
				<h1 class="pull-left">iWork - MVC</h1>
				<small class="pull-right"><a href="https://github.com/auglima/iWork-MVC">https://github.com/auglima/iWork-MVC</a></small>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="col-md-12">
			<?php if(isset($content)){ echo $content; } ?>
		</div>
	</div>
	
  
  
	<!-- jQuery (necessary for JavaScript plugins) -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- All bootstrap compiled plugins -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
