<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modern E-Commerce</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
	<nav class="navbar">
		<div class="logo">ShopHub</div>
		<div class="nav-links">
			<a href="index.php">Home</a>
			<a href="products.php">Products</a>
			<a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
			<?php if (isset($_SESSION['user_id'])): ?>
				<a href="php/logout.php">Logout</a>
			<?php else: ?>
				<a href="login.php" id="authLink">Login</a>
			<?php endif; ?>
		</div>
	</nav>

	<header class="hero">
		<h1>Welcome to ShopHub</h1>
		<p>Discover Amazing Products</p>
	</header>

	<main class="featured-products">
		<h2>Featured Products</h2>
		<div class="products-grid" id="featuredProducts">
			<!-- Products will be loaded dynamically -->
		</div>
	</main>

	<footer>
		<p>&copy; 2024 ShopHub. All rights reserved.</p>
	</footer>

	<script src="js/main.js"></script>
</body>
</html>