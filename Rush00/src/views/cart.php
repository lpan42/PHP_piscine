<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>CART</h1>
	<div class="box">
		<h2>PRODUCTS ADDED TO CART</h2>
		<table style="width: 100%" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Total price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['price'] ?>€</td>
					<td><?= $product['amount'] ?></td>
					<td><?= $product['totalprice'] ?>€</td>
					<td align="right">
						<form action="/home/cart" method="post">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="submit" name="delproduct" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p>TOTAL : <?= $total ?>€</p>
		<form action="/home/cart" method="post">
			<input type="submit" name="submitorder" value="comfirm my order" style="width: 48%">
			<input type="submit" name="cancelcart" value="clear my cart" style="width: 48%; float right; right: 0; display: inline">	
		</form>
	</div>
</div>


<?php include "components/footer.php"; ?>
