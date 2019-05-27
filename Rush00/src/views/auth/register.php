<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container-center">
	<div class="vertical-center">
		<?php if (isset($error)) : ?>
		<h1 class="error">Error: <?= $error ?></h1>
		<?php endif; ?>
		<div class="box login">
			<h1>Inscription</h1>
			<form action="/auth/register" method="post">
				<p><input type="text" placeholder="login" name="login" required></p>
				<p><input type="password" placeholder="passwd" name="passwd" required></p>
				<p><input type="password" placeholder="confirm" name="confirm" required></p>
				<p><div class="g-recaptcha" data-sitekey="6LdBjaUUAAAAAGUiSh4dLoBTtIhuA44_t8AlbCew"></div><p>
				<p><input type="submit" name="submit" value="Inscription"></p>
			</form>
		</div>
	</div>
</div>

<?php include "components/footer.php"; ?>
