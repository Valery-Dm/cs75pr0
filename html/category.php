<?php
	require_once('../controller/controller.php');

	// common image
	$image = '../images/pizza_thumbnail.jpg';

	// set default title
	$title = '';

	// set actual title based on query
	$id = 0;
	if (isset($_GET['id'])){
		$id += $_GET['id'];
		if (is_int($id) and $id < count($items)){
			$title = $data['categories'][$id];
		} else {
			// fall back to main page if id is wrong
			header('Location:main.php');
			exit;
		}
	}

	// call buy function and prevent repetitive form action on page refresh
	if (count($_POST) > 0){
		buy($_POST);
		header("Location:category.php?id=$id");
		exit;
	}

	render('header', array('title' => $title)); 
?>
	
	<div class="row-marketing">
		<?php foreach ($items[$id] as $item): ?>
		
			<div class="col-md-4">
				<h2><?= htmlspecialchars($item->name); ?></h2>
				<img src=<?= $image ?> alt="Pizza image"/>
				
				<!-- Show submit form for each size if it has nonzero price -->
				<?php if ($item->price->small > 0): ?>
					<div class="form-group">
						<form method="post">
							<label>Small: $<?= htmlspecialchars($item->price->small); ?></label>
							<input type="hidden" name="item" value="<?= htmlspecialchars($item->name); ?>"/>
							<input type="hidden" name="type" value="small"/>
							<input type="hidden" name="price" value="<?= htmlspecialchars($item->price->small); ?>"/>
							<input class="form-control" type="number" name="quantity" min="1" max="20" value="1"/>
							<br/>
							<button type="submit" class="btn btn-default btn-sm">
							  <span class="glyphicon glyphicon-shopping-cart"></span> add to Shopping Cart
							</button>
						</form>
					</div>
				<?php endif ?>
				
				<?php if ($item->price->large > 0): ?>
					<div class="form-group">
						<form method="post">
							<label>Large: $<?= htmlspecialchars($item->price->large); ?></label>
							<input type="hidden" name="item" value="<?= htmlspecialchars($item->name); ?>"/>
							<input type="hidden" name="type" value="large"/>
							<input type="hidden" name="price" value="<?= htmlspecialchars($item->price->large); ?>"/>
							<input class="form-control" type="number" name="quantity" min="1" max="20" value="1"/>
							<br/>
							<button type="submit" class="btn btn-default btn-sm">
							  <span class="glyphicon glyphicon-shopping-cart"></span> add to Shopping Cart
							</button>
						</form>
					</div>
				<?php endif ?>
				
			</div>
		
		<?php endforeach ?>
	</div>

<?php render('footer', $data); ?>
