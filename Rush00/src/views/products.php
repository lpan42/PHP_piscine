<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container"  style="display: flex; flex-direction: row; flex-wrap: wrap">
	<?php foreach ($products as $product) : ?>
		<?php include "components/product-card.php" ?>
	<?php endforeach; ?>
</div>

<?php include "components/footer.php"; ?>
