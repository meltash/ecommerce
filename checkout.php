<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}
require_once 'php/db_connect.php';

// Get user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Checkout - ShopHub</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.checkout-container {
			max-width: 800px;
			margin: 2rem auto;
			padding: 0 1rem;
		}
		.checkout-form {
			display: grid;
			gap: 1rem;
		}
		.form-group {
			display: grid;
			gap: 0.5rem;
		}
		.form-group input {
			padding: 0.5rem;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		.order-summary {
			margin-top: 2rem;
			padding: 1rem;
			background: #f9f9f9;
			border-radius: 4px;
		}
		.submit-btn {
			padding: 1rem;
			background: var(--secondary-color);
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			margin-top: 1rem;
		}
	</style>
</head>
<body>
	<nav class="navbar">
		<div class="logo">ShopHub</div>
		<div class="nav-links">
			<a href="index.php">Home</a>
			<a href="products.php">Products</a>
			<a href="cart.php">Cart</a>
			<a href="php/logout.php">Logout</a>
		</div>
	</nav>

	<div class="checkout-container">
		<h1>Checkout</h1>
		<form id="checkout-form" class="checkout-form" method="POST" action="php/process_order.php">
			<div class="form-group">
				<label for="name">Full Name</label>
				<input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
			</div>
			<div class="form-group">
				<label for="address">Shipping Address</label>
				<input type="text" id="address" name="address" required>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<input type="tel" id="phone" name="phone" required>
			</div>
			
			<div class="order-summary">
				<h2>Order Summary</h2>
				<div id="order-items"></div>
				<div class="total">Total: $<span id="order-total">0.00</span></div>
			</div>
			
			<button type="submit" class="submit-btn">Place Order</button>
		</form>
	</div>

	<script>
		// Load cart items for order summary
		fetch('php/get_cart.php')
			.then(response => response.json())
			.then(data => {
				const orderItems = document.getElementById('order-items');
				const orderTotal = document.getElementById('order-total');
				let total = 0;

				orderItems.innerHTML = data.items.map(item => {
					total += item.price * item.quantity;
					return `
						<div class="order-item">
							<p>${item.name} x ${item.quantity} - $${(item.price * item.quantity).toFixed(2)}</p>
						</div>
					`;
				}).join('');

				orderTotal.textContent = total.toFixed(2);
				
				if (data.items.length === 0) {
					window.location.href = 'cart.php';
				}
			});
	</script>
</body>
</html>