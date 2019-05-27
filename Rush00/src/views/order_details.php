<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<h1>MY ORDER HISTORY</h1>
	<div class="box">
		<div id="table">
			<div id="print-display" style="display: none">
				<h1 align="center">FT_MINISHOP BILL</h1>
				<style>
					table {
						border-collapse: collapse;
						width: 100%;
					}

					td, th {
						border: 1px solid #ddd;
						padding: 8px;
					}

					tr {
						background-color: #e2e2e2;
					}

					tr:nth-child(even){
						background-color: #f2f2f2;
					}

					th {
						padding-top: 12px;
						padding-bottom: 12px;
						text-align: left;
						background-color: #1867c0;
						color: white;
					}
				</style>
			</div>
			<table style="width: 100%" border="1">
				<thead>
					<h2>ORDER # <?= $id ?></h2>
					<tr>
						<th>PRODUCT</th>
						<th>PRICE</th>
						<th>AMOUNT</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($products as $product) : ?>
					<tr>
						<td><?= $product['name'] ?></td>
						<td><?= $product['price'] ?></td>
						<td><?= $product['amount']?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<p style="text-align:right;"><b>TOTAL AMOUNT: €<?= $order_sum[$id]?></b></p>
		</div>
		<div class="btn"><a href="/users/orders">RETURN</a></div>
		<button id="print">PRINT</button>
	</div>
</div>

<script>
const btn = document.getElementById('print');

btn.addEventListener('click', () => {
	const elems =  Array.from(document.getElementsByClassName('action'));
	const title = document.getElementById('print-display');
	title.style.display = 'block';
	elems.forEach((e) => e.style.display = 'none');
	printJS({ printable: 'table', type: 'html'});
	elems.forEach((e) => e.style.display = 'block');
	title.style.display = 'none';
});
</script>

<?php include "components/footer.php"; ?>
