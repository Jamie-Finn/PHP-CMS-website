<?php

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {
	?>

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>CMS</title>
			<link rel="stylesheet" href="./assets/main.css">
		</head>
		<body>
			<div class="container">
				<a href="index.php" id="logo">CMS</a>

				<br/>
				
				<ol>
					<li><a href="add.php">Add Article</a></li>
					<li><a href="delete.php">Delete Article</a></li>
					<li><a href="logout.php">Log out</a></li>
				</ol>
			</div>
		</body>
	</html>

	<?php
} else {
	if(isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		if(empty($username) || empty($password)) {
			$error = 'All fields are required.';
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");

			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();

			if($num == 1) {
 				$_SESSION['logged_in'] = true;
 				header('Location: index.php');
 				exit();
			} else {
				$error = 'The details you entered are incorrect!';
			}
		}
	}
	?>

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>CMS</title>
			<link rel="stylesheet" href="../assets/main.css">
		</head>
		<body>
			<div class="container">
				<a href="index.php" id="logo">CMS</a>

				<br><br>

				<?php if(isset($error)): ?>
					<small style="color:#aa0000;"><?php echo $error; ?></small>
					<br><br>
				<?php endif; ?>

				<form action="index.php" method="post" autocomplete="off">
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
					<input type="submit" value="Sign in">
				</form>
			</div>
		</body>
	</html>

	<?php
}