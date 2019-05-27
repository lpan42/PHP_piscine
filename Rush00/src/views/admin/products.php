<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>PRODUCTS</h1>
	<div class="box">
		<h2>PRODUCTS LIST</h2>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td>
						<form action="/admin/products" method="post">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="hidden" name="stock" value="<?= $product['stock'] ?>">
							<input type="hidden" name="price" value="<?= $product['price'] ?>">
							<input type="text" name="name" value="<?= $product['name'] ?>" style="width: 73%">
							<button type="submit" name="editproduct" value="name" style="width: 25%">Modify</button>
						</form>
					</td>
					<td>
						<form action="/admin/products" method="post">
							<input type="hidden" name="stock" value="<?= $product['stock'] ?>">
							<input type="hidden" name="name" value="<?= $product['name'] ?>">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="number" step="any" name="price" value="<?= $product['price'] ?>" style="width: 73%">
							<button type="submit" name="editproduct" value="price" style="width: 25%">Modify</button>
						</form>
					</td>
					<td>
						<form action="/admin/products" method="post">
							<input type="hidden" name="price" value="<?= $product['price'] ?>">
							<input type="hidden" name="name" value="<?= $product['name'] ?>">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="number" min="0" step="1" name="stock" value="<?= $product['stock'] ?>" style="width: 73%">
							<button type="submit" name="editproduct" value="stock" style="width: 25%">Modify</button>
						</form>
					</td>
					<td align="right">
						<form action="/admin/products" method="post">
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
		<form action="/admin/products" method="post" enctype="multipart/form-data">
			<input type="text" placeholder="product name"name="name" >
			<input type="number" placeholder="product price" step="any" name="price" >
			<label for="file" class="file-upload">
				Upload Image
			</label>
			<input id="file" type="file" name="image">
			<input type="submit" name="addproduct" value="add">
		</form>
	</div>
</div>

<?php include "components/footer.php"; ?>
