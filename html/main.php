<?php
	require_once('../controller/controller.php');
	render('header', array('title' => 'Welcome to ' . $data['company_name'][0])); 
?>
	
	<div class="jumbotron backimage">
        <h1><?= htmlspecialchars($data['company_name'][0]) ?></h1>
        <p class="lead italic">Restaurant</p>
        <p class="lead italic">Pizza. Grinders</p>
	</div>
		
	<div class="row marketing">
        <?php $id = 0; while(list(,$node) = each($data['categories'])): ?>
		<a href="category.php?id=<?= $id++; ?>">	
			<div class="col-md-4">
				<h4><?= htmlspecialchars($node) ?></h4>
			</div>
		</a>
		<?php endwhile; ?>
	</div>

<?php render('footer', $data); ?>
