<?php
	require_once('../controller/controller.php');
	render('header', array('title' => 'Orders history')); 
	
	$orders = simplexml_load_file($orders_file);
	
?>
	<div class="jumbotron">
		<div class="table-responsive">
			<table class="table">
			
				<thead>
					<tr>
						<th rowspan="2" id="date">ID / Date / Total</th>
						<th id="items" colspan="3">Purchased Items</th>
					</tr>
					<tr>
						<th headers="items" id="name">Name / Size</th>
						<th headers="items" id="quantity">Quantity</th>
						<th headers="items" id="price">Price</th>
					</tr>
				</thead>
			<?php $num = 1; foreach( $orders as $order ){ ?>
				<tbody>
					<tr>
						<td rowspan="<?= count($order->items->name); ?>" >
							<strong><?= sprintf('%05d', $num); ?></strong>
							<br/>
							<?php 
								$date = getdate((float)$order->time);
								echo 
									$date['mday'] . ' ' . 
									$date['month'] . ' ' . 
									$date['year'] . '<br/>' . 
									$date['hours'] . ':' . 
									$date['minutes'] . ':' . 
									$date['seconds'];
							?> <br/> 
							$<?= $order->total ?>
						</td>
							
						<?php 
						foreach( $order->items as $item ){ 
							for( $i = 0, $len = count($item->name); $i < $len; $i++ ){ 
								// close previous row and open next one 
								if( $i > 0 ) echo '</tr><tr>';
								
								echo '<td>' . $item->name[$i] . '</td>';
								echo '<td>' . $item->quantity[$i] . '</td>';
								echo '<td>$' . $item->price[$i] . '</td>';
								
							}
						} 
						?>
					</tr>
				</tbody>
			<?php $num++; } ;?>
		
			</table>
		</div>
	</div>

<?php render('footer', $data); ?>
