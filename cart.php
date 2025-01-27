<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}
require_once 'php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cart - ShopHub</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.cart-container {
			max-width: 1200px;
			margin: 2rem auto;
			padding: 0 1rem;
		}
		.cart-item {
			display: grid;
			grid-template-columns: auto 1fr auto auto;
			gap: 1rem;
			align-items: center;
			padding: 1rem;
			border-bottom: 1px solid #ddd;
		}
		.cart-item img {
			width: 100px;
			height: 100px;
			object-fit: cover;
		}
		.quantity-controls {
			display: flex;
			gap: 0.5rem;
			align-items: center;
		}
		.quantity-controls button {
			padding: 0.5rem 1rem;
			background: var(--primary-color);
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		.total {
			text-align: right;
			margin-top: 2rem;
			font-size: 1.2rem;
			font-weight: bold;
		}
		.checkout-btn {
			display: block;
			width: 200px;
			margin: 2rem 0 0 auto;
			padding: 1rem;
			background: var(--secondary-color);
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			text-align: center;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<nav class="navbar">
		<div class="logo">ShopHub</div>
		<div class="nav-links">
			<a href="index.php">Home</a>
			<a href="products.php">Products</a>
			<a href="cart.php" class="active"><i class="fas fa-shopping-cart"></i> Cart</a>
			<a href="php/logout.php">Logout</a>
		</div>
	</nav>

	<div class="cart-container">
		<h1>Your Cart</h1>
		<div id="cart-items">
			<!-- Cart items will be loaded dynamically -->
		</div>
		<div class="total">Total: $<span id="cart-total">0.00</span></div>
		<a href="checkout.php" class="checkout-btn" id="checkout-btn">Proceed to Checkout</a>
	</div>

	<script>
		function loadCart() {
			fetch('php/get_cart.php')
				.then(response => response.json())
				.then(data => {
					const cartItems = document.getElementById('cart-items');
					const cartTotal = document.getElementById('cart-total');
					let total = 0;

					cartItems.innerHTML = data.items.map(item => {
						total += item.price * item.quantity;
						return `
							<div class="cart-item">
								<img src="${item.image}" alt="${item.name}">
								<div>
									<h3>${item.name}</h3>
									<p>$${item.price}</p>
								</div>
								<div class="quantity-controls">
									<button onclick="updateQuantity(${item.id}, -1)">-</button>
									<span>${item.quantity}</span>
									<button onclick="updateQuantity(${item.id}, 1)">+</button>
								</div>
								<button onclick="removeItem(${item.id})">Remove</button>
							</div>
						`;
					}).join('');

					cartTotal.textContent = total.toFixed(2);
				});
		}

		function updateQuantity(itemId, change) {
			fetch('php/update_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({ itemId, change })
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					loadCart();
				}
			});
		}

		function removeItem(itemId) {
			fetch('php/remove_from_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({ itemId })
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					loadCart();
				}
			});
		}

		// Disable checkout button if cart is empty
		function updateCheckoutButton(items) {
			const checkoutBtn = document.getElementById('checkout-btn');
			if (items.length === 0) {
				checkoutBtn.style.opacity = '0.5';
				checkoutBtn.style.pointerEvents = 'none';
			} else {
				checkoutBtn.style.opacity = '1';
				checkoutBtn.style.pointerEvents = 'auto';
			}
		}

		// Update the loadCart function to include checkout button state
		function loadCart() {
			fetch('php/get_cart.php')
				.then(response => response.json())
				.then(data => {
					const cartItems = document.getElementById('cart-items');
					const cartTotal = document.getElementById('cart-total');
					let total = 0;

					cartItems.innerHTML = data.items.map(item => {
						total += item.price * item.quantity;
						return `
							<div class="cart-item">
								<img src="${item.image}" alt="${item.name}">
								<div>
									<h3>${item.name}</h3>
									<p>$${item.price}</p>
								</div>
								<div class="quantity-controls">
									<button onclick="updateQuantity(${item.id}, -1)">-</button>
									<span>${item.quantity}</span>
									<button onclick="updateQuantity(${item.id}, 1)">+</button>
								</div>
								<button onclick="removeItem(${item.id})">Remove</button>
							</div>
						`;
					}).join('');

					cartTotal.textContent = total.toFixed(2);
					updateCheckoutButton(data.items);
				});
		}

		// Load cart on page load
		document.addEventListener('DOMContentLoaded', loadCart);
	</script>
</body>
</html>