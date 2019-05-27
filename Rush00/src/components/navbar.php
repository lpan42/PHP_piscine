<div class="navbar">
	
	<div class="title">FT<b>MINISHOP  <?= ($GLOBALS['context']['controller'] == 'admin' ? '- ADMIN' : '') ?></b></div>
	<div class="list">
		<a class="label" href="/home">Home</a>
	</div>
	<?php if ($GLOBALS['context']['controller'] != 'admin') : ?>
	<div class="list">
		<a class="label" href="/home/categories">Categories</a>
	</div>
	<div class="list">
		<a class="label" href="/home/products">Products</a>
	</div>
	<div class="list">
		<a class="label" href="/home/search">Search</a>
	</div>
	<?php elseif ($_SESSION['user']['rank'] == 'admin') : ?>
	<div class="list">
		<a class="label" href="/admin">Users</a>
	</div>
	<div class="list">
		<a class="label" href="/admin/categories">Categories</a>
	</div>
	<div class="list">
		<a class="label" href="/admin/products">Products</a>
	</div>
	<div class="list">
		<a class="label" href="/admin/orders">Orders</a>
	</div>
	<?php endif; ?>
	<div class="right">
		<div class="list" style="width: auto">
			<a class="label" style="width: auto" href="/home/cart" >Cart (<?= count($_SESSION['cart']) ?> Items - € <?= $GLOBALS['total_cart'] ?>)</a>
		</div>
		<?php if ($_SESSION['user']) : ?>
		<div class="list">
			<div class="label"><?= $_SESSION['user']['login'] ?></div>
			<div class="elements">
				<a href="/users/orders">My orders</a>
				<a href="/users/modif_pwd">Change Password</a>
				<a href="/auth/logout">Deconnexion</a>
				<?php if ($_SESSION['user']['rank'] == 'admin') : ?>
				<a href="/admin">Admin</a>
				<?php endif; ?>
			</div>
		</div>
		<?php else : ?>
		<div class="list">
			<a class="label" href="/auth/login">Connexion</a>
		</div>
		<div class="list">
			<a class="label" href="/auth/register">Inscripton</a>
		</div>
		<?php endif; ?>
	</div>
</div>
