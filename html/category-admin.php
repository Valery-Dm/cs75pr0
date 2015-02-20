<?php
	require_once('../controller/controller.php');
	require_once('../controller/admincontroller.php');
	// common image
	$image = '../images/pizza_thumbnail.jpg';
	// set default title
	$title = 'wrong category';
	// set actual title based on query
	$id = 0;
	if (isset($_GET['id'])){
		$id += $_GET['id'];
		if (is_int($id) and $id < count($items)){
			$title = $data['categories'][$id];
		} else {
			$title = 'wrong category';
			exit;
		}
	}
	$adminitems = '';
	// call buy function and prevent repetitive form action on page refresh
	if (count($_POST) > 0){
		$adminitems = $_POST;
		save_changes($adminitems, $data['categories'][$id], $items[$id]);
		//header('Location:admin.php');
		//exit;
	}
?>

<?php render('header', array('title' => $title)); ?>
	<pre>
		
	You can add photo, change names and prices. Type name 0 to remove item or category.
	All changes will be recorded when you click submit button.
	<?php //print_r($adminitems); ?>
	</pre>
	<form method="post">
		<button type="submit" class="btn btn-warning btn-lg adminsubmit" >
		  <span class="glyphicon glyphicon-save"></span> Submit changes
		</button>
		<label for="newcategory">Category name: 
			<input class="form-control adminheaders" type="text" 
					name="newcategory" value="<?= $title; ?>" />
		</label>
		<div class="row-marketing clear">
			<?php $i = 0; foreach ($items[$id] as $item): ?>
				<div class="col-lg-6">
					<input class="form-control adminheaders" type="text" name="name-<?= $i; ?>" 
							value="<?= htmlspecialchars($item->name); ?>" /><br/>
					<!-- 
					Upload new photo (max 900 x 200 px)
					<input type="file" accept="image/*" class="btn btn-default" name="img-<?php //echo $i; ?>"/>
					-->
					<img src=<?= $image ?> alt="Pizza image"/>
					<!-- Show submit form for small size if it exists -->
					<div class="form-group">
						
							<label for="small-<?= $i; ?>">Small: 
								<input type="number" name="small-<?= $i; ?>" step="any"
										value="<?= ($item->price->small > 0) ? htmlspecialchars($item->price->small) : 0; ?>"/>
							</label>
							<input class="form-control" type="number" name="quantity" min="1" max="20" value="1" disabled />
							<br/>
							<button type="submit" class="btn btn-default btn-sm" disabled>
							  <span class="glyphicon glyphicon-shopping-cart"></span> add to Shopping Cart
							</button>
						
					</div>
					<div class="form-group">
							
							<label for="large-<?= $i; ?>">Large: 
								<input type="number" name="large-<?= $i; ?>" step="any"
										value="<?= ($item->price->large > 0) ? htmlspecialchars($item->price->large) : 0; ?>"/>
							</label>
							<input class="form-control" type="number" name="quantity" min="1" max="20" value="1" disabled />
							<br/>
							<button type="submit" class="btn btn-default btn-sm" disabled>
							  <span class="glyphicon glyphicon-shopping-cart"></span> add to Shopping Cart
							</button>
					</div>
				</div>
			<?php $i++; endforeach ?>
		</div>
	</form>
<?php render('footer', $data); ?>