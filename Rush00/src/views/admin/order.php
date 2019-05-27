<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>ORDER PRODUCTS</h1>
	<div class="box">
		<h2>PRODUCTS LIST</h2>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['price'] ?></td>
					<td><?= $product['amount'] ?></td>
					<td align="right">
						<form action="/admin/order/<?= $order_id ?>" method="post">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="submit" name="delproduct" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include "components/footer.php"; ?>
