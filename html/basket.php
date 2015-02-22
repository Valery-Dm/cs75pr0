<?php
	require_once('../controller/controller.php');
	
	if (isset($_SESSION['basket'])){
		if (isset($_POST['operation'])){
			if( $_POST['operation'] == 'recalculate' ){
				recalculate($_POST);
			} else {
				checkout();
			}
			header('Location:basket.php');
			exit;
		}
	}
	render('header', array('title' => 'Shopping cart')); 
?>

	<div class="jumbotron">
		
		<form method="post" name="recalculate">
			<table class="table" data-toggle="table" data-height="300">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="name">Name</th>
						<th data-field="type">Size</th>
						<th data-field="quantity">Quantity</th>
						<th data-field="price">Price</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
					if (isset($_SESSION['basket'])){
						$itemid = 0;
						foreach( $_SESSION['basket'] as $item ){ ?>
							<tr>
								<td id="tr-id-<?= ++$itemid; ?>"><?= $itemid; ?></td>
								<td><?= htmlspecialchars($item['item']); ?></td>
								<td><?= htmlspecialchars($item['type']); ?></td>
								<td>
									<input class="shprice" name="<?= $itemid; ?>" type="number" 
									min="0" max="20" value="<?= htmlspecialchars($item['quantity']); ?>"/>
								</td>
								<td><?= number_format(($item['price'] * $item['quantity']), 2); ?></td>
							</tr>
				<?php 	}
					} ?>
				</tbody>
				
			</table>
			
			<button type="submit" name="operation" value="buy" class="btn btn-default shsubmit">Buy</button>
			<button type="submit" name="operation" value="recalculate" class="btn btn-default shsubmit">Re-calculate</button>
		</form>
		
	</div>
	
<?php render('footer', $data); ?>
