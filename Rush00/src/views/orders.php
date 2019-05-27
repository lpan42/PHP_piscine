<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<h1>MY ORDER HISTORY</h1>
	<div class="box">
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ORDER ID</th>
					<th>LOGIN</th>
					<th>DATE</th>
					<th>TOTAL AMOUNT</th>
					<th>VIEW</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($orders as $order) : ?>
				<tr>
					<td><?= $order['id'] ?></td>
					<td><?= $order['login'] ?></td>
					<td><?= date("Y/m/d H:i",$order['date'])?></td>
					<td>€<?= $order_sum[$order['id']] ?></td>
					<td><div class="btn"><a href="/users/order/<?= $order[id]?>">DETAILS</a></div></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include "components/footer.php"; ?>
