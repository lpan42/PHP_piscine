<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container-center">
	<div class="vertical-center">
		<?php if (isset($error)) : ?>
		<h1 class="error">Error: <?= $error ?></h1>
		<?php endif; ?>
		<div class="box login">
			<h1>Change my password</h1>
			<form action="/users/modif_pwd" method="post">
				<p><input type="password" placeholder="old password" name="oldpasswd" required></p>
                <p><input type="password" placeholder="new password" name="newpasswd" required></p>
                <p><input type="password" placeholder="confirm new password" name="confirm" required></p>
                <p><input type="submit" name="submit" value="Comfirm"></p>
			</form>
		</div>
	</div>
</div>

<?php include "components/footer.php"; ?>
