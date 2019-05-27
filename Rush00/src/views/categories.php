<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container" style="display: flex; flex-direction: row; flex-wrap: wrap">
	<?php foreach ($categories as $category) : ?>
	<a class="category" href="/home/category/<?= $category['id'] ?>">
		<div class="title"><?= $category['name'] ?></div>
		<div class="img-container">
			<img src="/<?= CATEGORIES_FOLDER.'/'.$category['id'] ?>" width="100%">
		</div>
	<a>
	<?php endforeach; ?>
</div>

<?php include "components/footer.php"; ?>
