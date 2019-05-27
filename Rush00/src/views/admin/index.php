<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>Users</h1>
	<div class="box">
	
		<h2>Users list</h2>
		<div class="separator"></div>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Login</th>
					<th>Group</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user) : ?>
				<tr>
					<td><?= $user['id'] ?></td>
					<td><?= $user['login'] ?></td>
					<td align="right">
						<form action="/admin" method="post">
						<input type="hidden" name="id" value="<?= $user['id'] ?>">
							<select name="rank" value="<?= $user['rank'] ?>" style="width: 73%">
								<option value="admin" <?php echo $user['rank'] == "admin" ? "selected" : ''; ?>>Admin</option>
								<option value="user" <?php echo $user['rank'] == "user" ? "selected" : ''; ?>>User</option>
							</select>
							<input type="submit" name="edituser" value="modify" style="width: 25%">
						</form>
					<td align="right">
						<form action="/admin" method="post">
							<input type="hidden" name="id" value="<?= $user['id'] ?>">
							<input type="submit" name="deluser" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php include "components/footer.php"; ?>
