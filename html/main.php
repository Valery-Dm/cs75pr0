<?php

	require_once('../controller/controller.php');

?>

<?php render('header', array('title' => 'Welcome to ' . $data['company_name'][0])); ?>

	<div class="jumbotron backimage">
        <h1><?= $data['company_name'][0] ?></h1>
        <p class="lead">Restaurant</p>
        <p class="lead">Pizza Grinders</p>
      </div>

      <div class="row marketing">
        <?php while(list(,$node) = each($data['categories'])): ?>
			<div class="col-lg-6">
			  <a href="category.php"><h4><?= $node ?></h4></a>
			</div>
		<?php endwhile; ?>
	</div>

<?php render('footer', $data); ?>
