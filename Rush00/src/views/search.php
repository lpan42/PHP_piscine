<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<?php if (isset($error)) : ?>
<h1 class="error">Error: <?= $error ?></h1>
<?php endif; ?>
<div class="container"  style="display: flex; flex-direction: row; flex-wrap: wrap">
	<div class="search-container">
		<form method="post">
			<input class="shadow" type="text" style="width: 100%" name="text" placeholder="Type for search....">
			<button  type="submit" style="width: 100%" name="search">Search</button>
		</form>
	</div>

	<?php foreach ($products as $product) : ?>
		<?php include "components/product-card.php" ?>
	<?php endforeach; ?>
</div>

<?php include "components/footer.php"; ?>
