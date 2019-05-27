<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>CATEGORY <?= $category['name'] ?></h1>
	<div class="box">
		<h2>PRODUCT LIST</h2>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['price'] ?></td>
					<td align="right">
						<form action="/admin/category/<?= $category['id'] ?>" method="post">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="submit" name="delproduct" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box" style="margin-top: 10px;">
		<h2>ADD PRODUCT</h2>
		<form action="/admin/category/<?= $category['id'] ?>" method="post" >
			<select name="product">
				<?php foreach ($all_products as $product) : ?>
					<option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
				<?php endforeach; ?>
			</select>
			<input type="submit" name="addproduct" value="add">
		</form>
	</div>
</div>

<?php include "components/footer.php"; ?>
