<?php
session_start();
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once 'php/db_connect.php';
	
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	$errors = [];
	
	if (strlen($password) < 6) {
		$errors[] = "Password must be at least 6 characters long";
	}
	
	if ($password !== $confirm_password) {
		$errors[] = "Passwords do not match";
	}
	
	// Check if email already exists
	$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	if ($stmt->get_result()->num_rows > 0) {
		$errors[] = "Email already registered";
	}
	
	if (empty($errors)) {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $email, $hashed_password);
		
		if ($stmt->execute()) {
			$_SESSION['user_id'] = $stmt->insert_id;
			header("Location: login.php");
			exit();
		} else {
			$errors[] = "Registration failed. Please try again.";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - ShopHub</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.auth-container {
			max-width: 400px;
			margin: 50px auto;
			padding: 2rem;
			background: white;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
		}
		.auth-form {
			display: flex;
			flex-direction: column;
			gap: 1rem;
		}
		.auth-form input {
			padding: 0.8rem;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		.auth-form button {
			padding: 0.8rem;
			background: var(--primary-color);
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		.error {
			color: red;
			margin-bottom: 1rem;
		}
	</style>
</head>
<body>


	<div class="auth-container">
		<h2>Register</h2>
		<?php if (!empty($errors)): ?>
			<?php foreach ($errors as $error): ?>
				<p class="error"><?php echo $error; ?></p>
			<?php endforeach; ?>
		<?php endif; ?>
		<form class="auth-form" method="POST" action="">
			<input type="text" name="name" placeholder="Full Name" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="password" name="password" placeholder="Password" required>
			<input type="password" name="confirm_password" placeholder="Confirm Password" required>
			<button type="submit">Register</button>
		</form>
		<p>Already have an account? <a href="login.php">Login</a></p>
	</div>
</body>
</html>