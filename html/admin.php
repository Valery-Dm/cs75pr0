<?php

	require_once('../controller/controller.php');

?>

<?php render('header', array('title' => 'Administrator\'s page')); ?>
	
	<pre>
		
	Select category you want to edit or click '+' sign to add a new one.
	All changes will be recorded into xml file.
	<?php echo ( isset($_SESSION['changes']) ) ? 'Modifications have been applied: ' . $_SESSION['changes'] . '<br/>' : '' ?>
	</pre>
	
	<div class="jumbotron backimage">
        <h1><?= htmlspecialchars($data['company_name'][0]) ?></h1>
        <p class="lead italic">Restaurant</p>
        <p class="lead italic">Pizza. Grinders</p>
      </div>
		
      <div class="row marketing">
        <?php $id = 0; while(list(,$node) = each($data['categories'])): ?>
			<div class="col-lg-6">
			  <a href="category-admin.php?id=<?= $id++; ?>">
				  <h4><?= htmlspecialchars($node) ?></h4>
			  </a>
			</div>
		<?php endwhile; ?>
		<div class="col-lg-6 add-new">
			  <a href="category-admin.php?id=<?= count($data['categories']); ?>">
				  <h4>&#43;</h4>
			  </a>
			</div>
	</div>

<?php render('footer', $data); ?>
