<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>CATEGORIES</h1>
	<div class="box">
		<h2>CATEGORIES LIST</h2>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($categories as $category) : ?>
				<tr>
					<td><?= $category['id'] ?></td>
					<td><?= $category['name'] ?></td>
					<td align="right" width="100px">
						<div class="btn" style="width: 50px; margin-bottom: 20px"><a style="margin-bottom: 5px" href="/admin/category/<?= $category['id'] ?>">Edit</a></div>
						<form action="/admin/categories" method="post" style="display: inline-block; width: 100px">
							<input type="hidden" name="name" value="<?= $category['name'] ?>">
							<input type="hidden" name="id" value="<?= $category['id'] ?>">
							<input type="submit" name="delcategory" value="delete" style="width: 100px">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="box" style="margin-top: 10px;">
		
		<h2>ADD CATEGORY</h2>
		<form action="/admin/categories" method="post" enctype="multipart/form-data">
			<input type="text" name="name" placeholder="Category name"required style="width: 50%; display: inline-block">
			<label for="file" class="file-upload" style="width: 44%; display: inline-block">
				Upload Image
			</label>
			<input id="file" type="file" name="image">
			<button type="submit" name="addcategory" value="add">Add Category</button>
		</form>
	</div>
</div>

<?php include "components/footer.php"; ?>
