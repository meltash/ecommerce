<?php
session_start();
require_once 'php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Products - ShopHub</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.products-container {
			max-width: 1200px;
			margin: 2rem auto;
			padding: 0 1rem;
		}
		.products-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
			gap: 2rem;
			padding: 2rem 0;
		}
		.product-card {
			background: white;
			border-radius: 8px;
			box-shadow: 0 2px 5px rgba(0,0,0,0.1);
			overflow: hidden;
			transition: transform 0.3s;
		}
		.product-card:hover {
			transform: translateY(-5px);
		}
		.product-card img {
			width: 100%;
			height: 200px;
			object-fit: cover;
		}
		.product-info {
			padding: 1rem;
		}
		.product-info h3 {
			margin: 0 0 0.5rem 0;
		}
		.product-info p {
			color: #666;
			margin-bottom: 1rem;
		}
		.price {
			font-size: 1.2rem;
			font-weight: bold;
			color: var(--primary-color);
		}
		.add-to-cart {
			display: block;
			width: 100%;
			padding: 0.8rem;
			background: var(--primary-color);
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			transition: background 0.3s;
		}
		.add-to-cart:hover {
			background: #2980b9;
		}
		.add-to-cart:disabled {
			background: #ccc;
			cursor: not-allowed;
		}
	</style>
</head>
<body>
	<nav class="navbar">
		<div class="logo">ShopHub</div>
		<div class="nav-links">
			<a href="index.php">Home</a>
			<a href="products.php" class="active">Products</a>
			<a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
			<?php if (isset($_SESSION['user_id'])): ?>
				<a href="php/logout.php">Logout</a>
			<?php else: ?>
				<a href="login.php">Login</a>
			<?php endif; ?>
		</div>
	</nav>

	<div class="products-container">
		<h1>Our Products</h1>
		<div class="products-grid" id="products-grid">
			<!-- Products will be loaded dynamically -->
		</div>
	</div>

	<script>
		function loadProducts() {
			fetch('php/get_products.php')
				.then(response => response.json())
				.then(products => {
					const productsGrid = document.getElementById('products-grid');
					productsGrid.innerHTML = products.map(product => `
						<div class="product-card">
							<img src="${product.image}" alt="${product.name}">
							<div class="product-info">
								<h3>${product.name}</h3>
								<p>${product.description}</p>
								<p class="price">$${product.price}</p>
								<button 
									onclick="addToCart(${product.id})" 
									class="add-to-cart"
									${product.stock <= 0 ? 'disabled' : ''}
								>
									${product.stock <= 0 ? 'Out of Stock' : 'Add to Cart'}
								</button>
							</div>
						</div>
					`).join('');
				});
		}

		function addToCart(productId) {
			fetch('php/add_to_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({ productId })
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					alert('Product added to cart!');
					loadProducts(); // Refresh products to update stock
				} else {
					if (data.message === 'Please login first') {
						window.location.href = 'login.php';
					} else {
						alert(data.message);
					}
				}
			});
		}

		// Load products on page load
		document.addEventListener('DOMContentLoaded', loadProducts);
	</script>
</body>
</html>