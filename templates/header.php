<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" href="../templates/style.css"/>
		<script src="../../js/jquery-2.1.3.min.js"></script>
		
		<title><?= htmlspecialchars($title); ?></title>
	</head>
	<body>
	    <div class="container">
		  <div class="header">
			<ul class="nav nav-pills pull-right">
			  <li><a href="main.php">Home</a></li>
			  <li>
				  <a href="basket.php"><?= htmlspecialchars($_SESSION['message'] . $_SESSION['total']); ?>
					<span class="glyphicon glyphicon-shopping-cart"></span>
				  </a>
			  </li>
			</ul>
			<h3 class="text-muted logo"><?= htmlspecialchars($title); ?></h3>
		  </div><!--header-->
