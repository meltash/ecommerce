<?php
session_start();
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get the form data
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// Add your database connection here
	$conn = new mysqli("localhost", "root", "", "ecommerce");
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Prepare SQL statement to prevent SQL injection
	$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc();
		// Verify the password
		if (password_verify($password, $user['password'])) {
			// Password is correct, set session and redirect
			$_SESSION['user_id'] = $user['id'];
			header("Location: index.php");
			exit();
		} else {
			$error = "Invalid email or password";
		}
	} else {
		$error = "Invalid email or password";
	}
	
	$stmt->close();
	$conn->close();
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - ShopHub</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
</head>

	<div class="flex justify-center items-center min-h-screen">
		<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
			<h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
			<?php if (isset($error)): ?>
				<p class="text-red-500 mb-4"><?php echo $error; ?></p>
			<?php endif; ?>
			<form class="space-y-4" method="POST" action="">
				<div>
					<label for="email" class="block text-sm font-medium text-gray-700">Email</label>
					<input type="email" name="email" id="email" placeholder="Email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
				</div>
				<div>
					<label for="password" class="block text-sm font-medium text-gray-700">Password</label>
					<input type="password" name="password" id="password" placeholder="Password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
				</div>
				<div>
					<button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Login</button>
				</div>
			</form>
			<p class="mt-4 text-center text-sm text-gray-600">Don't have an account? <a href="register.php" class="text-blue-600 hover:text-blue-800">Register</a></p>
		</div>
	</div>
</body>
</html>