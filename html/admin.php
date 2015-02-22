<?php
	require_once('../controller/controller.php');
	render('header', array('title' => 'Administrator\'s page')); 
?>
	
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
			<a href="category-admin.php?id=<?= $id++; ?>">	
		  		<div class="col-md-4">
					<h4><?= htmlspecialchars($node) ?></h4>
				</div>
			</a>
		<?php endwhile; ?>
		
		<a href="category-admin.php?id=<?= count($data['categories']); ?>">
			<div class="col-md-4 add-new">
				  <h4>&#43;</h4>
			</div>
		</a>
	</div>

<?php render('footer', $data); ?>
