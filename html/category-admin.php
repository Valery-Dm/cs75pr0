<?php
	require_once('../controller/controller.php');
	require_once('../controller/admincontroller.php');
	
	// common image
	$image = '../images/pizza_thumbnail.jpg';

	// set default title
	$title = '';

	// set actual title based on query
	$id = 0;
	if ( isset($_GET['id']) ){
		$id += $_GET['id'];
		if ( is_int($id) and $id < count($items) ){
			$title = $data['categories'][$id];
		} elseif( is_int($id) and $id == count($items) ) {
			// create new category at the end of array
			create_element( $id, 'category' );
			// go back to main admin-page
			header('Location:admin.php');
			exit;
		} else {
			// fall back to main admin-page if id is wrong
			header('Location:admin.php');
			exit;
		}
	}

	if ( isset($_GET['new']) and $_GET['new'] == 1 ){
		// create new item
		create_element( $id, 'item' );
		// refresh the page
		header("Location:category-admin.php?id=$id");
		exit;
	}

	$postitems = '';
	// if submit is clicked
	if ( count($_POST) > 0 ){
		$postitems = $_POST;
		// save possible modifications to a file
		save_changes($postitems, $id);
		header('Location:admin.php');
		exit;
	}
 	
	render('header', array('title' => $title)); 
?>
	<pre>
		
	You can add photo, change names and prices. Type 0 in the name field to remove item or category.
	All changes will be applied when you click submit button.
	
	</pre>

	<form method="post">
		<button type="submit" class="btn btn-warning btn-lg adminsubmit add-new" >
		  <span class="glyphicon glyphicon-save"></span> Submit changes
		</button>
		<label>Category name: 
			<input class="form-control adminheaders" type="text" 
					name="newcategory" value="<?= $title; ?>" />
		</label>
		
		<div class="row-marketing clear">
			<?php $i = 0; foreach ($items[$id] as $item): ?>
				
				<div class="col-md-4">
					
					<input class="form-control adminheaders" type="text" name="name[<?= $i; ?>]" 
							value="<?= htmlspecialchars($item->name); ?>" /><br/>
					<img src=<?= $image ?> alt="Pizza image"/>
					
					<div class="form-group">
						<label>Small: 
							<input type="number" name="small[<?= $i; ?>]" step="any" min="0" max="200"
									value="<?= ($item->price->small > 0) ? htmlspecialchars($item->price->small) : 0; ?>"/>
						</label>
						<input class="form-control" type="number" name="quantity" min="1" max="20" value="1" disabled />
						<br/>
						<button type="submit" class="btn btn-default btn-sm" disabled>
						  <span class="glyphicon glyphicon-shopping-cart"></span> add to Shopping Cart
						</button>
					</div>
					
					<div class="form-group">
						<label>Large: 
							<input type="number" name="large[<?= $i; ?>]" step="any" min="0" max="200"
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
	
	<a href="category-admin.php?id=<?= $id; ?>&amp;new=1">	
		<div class="col-md-4 add-new">
			<h4>&#43;</h4>
		</div>
	</a>

<?php render('footer', $data); ?>
