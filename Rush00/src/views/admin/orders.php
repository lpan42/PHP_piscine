<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>ORDERS</h1>
	<div class="box">
		<h2>ORDERS LIST</h2>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>User</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($orders as $order) : ?>
				<tr>
					<td><?= $order['id'] ?></td>
					<td><?= $order['login'] ?></td>
					<td><?= date("Y/m/d H:i", $order['date']) ?></td>
					<td align="right" width="140px">
						<div class="btn" style="width: 50px; margin-bottom: 20px"><a style="margin-bottom: 5px" href="/admin/order/<?= $order['id'] ?>">See products</a></div>
						<form action="/admin/orders" method="post">
							<input type="hidden" name="id" value="<?= $order['id'] ?>">
							<input type="submit" name="delorder" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include "components/footer.php"; ?>
