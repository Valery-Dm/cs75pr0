<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="../../css/bootstrap.css"/>
		<link rel="stylesheet" href="../templates/style.css"/>
		<script src="../../js/jquery-2.1.3.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
		
		<title><?php echo htmlspecialchars($title); ?></title>
	</head>
	<body>
	    <div class="container">
		  <div class="header">
			<ul class="nav nav-pills pull-right">
			  <li class="active"><a href="#">Home</a></li>
			  <li><a href="basket.php">Basket</a></li>
			</ul>
			<h3 class="text-muted logo"><?php echo htmlspecialchars($title); ?></h3>
		  </div><!--header-->
