<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div id="container_slides">
	<div class="slides">
		<div style="background: url('/public/slides/art42.jpg') no-repeat center center; width: 100%; height:500px"></div>
	</div>
	<div class="slides">
		<div style="background: url('/public/slides/streetartcat.jpg') no-repeat center center; width: 100%; height:500px"></div>
	</div>
	<div id="slide-left" class="slide-btn"></div>
	<div id="slide-right" class="slide-btn"></div>
</div>


<div class="index-container">
	<div style="position: relative; min-height: 200px" class="box">
		<h1>LAST BOUGHT PRODUCTS</h1>
		<?php if (count($products) !== 0) : ?>
		<div class="slide-cards" id="slide-cards">
			<?php foreach ($products as $product) : ?>
				<?php include "components/product-card.php" ?>
			<?php endforeach; ?>
		</div>
		<div id="slide-left-cards" class="slide-btn" onClick="document.querySelector('#slide-cards').scrollBy({left:-250, top:0, behavior: 'smooth'})"></div>
		<div id="slide-right-cards" class="slide-btn" onClick="document.querySelector('#slide-cards').scrollBy({left:250, top:0, behavior: 'smooth'})"></div>
		<?php else : ?>
			<h3 align="center">Nothing to show</h3>
		<?php endif; ?>
	</div>
</div>


<style>

.index-container {
	margin-left: 15px;
	margin-right: 15px;
}

.slide-cards .product {
	display: inline-block;
	white-space: normal;
}

.slide-cards {
	min-height: 200px;
	position: relative;
	overflow-x: scroll;
	overflow-y: hidden;
	white-space: nowrap;
	width: 100%;
}

</style>

<script>
	const container = document.getElementById('container_slides');
	const slides = Array.from(container.getElementsByClassName('slides'));
	let selected = 0;

	document.getElementById('slide-left').addEventListener('click', (e) => {
		selected--;
		if (selected < 0)
			selected = slides.length - 1;
		redraw();
	});

	document.getElementById('slide-right').addEventListener('click', (e) => {
		selected++;
		if (selected >= slides.length)
			selected = 0;
		redraw();
	});

	function redraw()
	{
		slides.forEach((elem, i) => {
			if (i == selected)
				elem.style.display = 'block';
			else
				elem.style.display = 'none';
		});
	}
	redraw();



</script>

<?php include "components/footer.php"; ?>