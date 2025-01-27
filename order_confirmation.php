<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}

require_once 'php/db_connect.php';

// Get order details
if (!isset($_GET['order_id'])) {
	header("Location: index.php");
	exit();
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Get order information
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
	header("Location: index.php");
	exit();
}

// Get order items
$stmt = $conn->prepare("
	SELECT oi.*, p.name, p.image 
	FROM order_items oi 
	JOIN products p ON oi.product_id = p.id 
	WHERE oi.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Confirmation - ShopHub</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.confirmation-container {
			max-width: 800px;
			margin: 2rem auto;
			padding: 2rem;
			background: white;
			border-radius: 8px;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}
		.order-details {
			margin: 2rem 0;
			padding: 1rem;
			background: #f9f9f9;
			border-radius: 4px;
		}
		.order-items {
			margin-top: 2rem;
		}
		.order-item {
			display: grid;
			grid-template-columns: auto 1fr auto;
			gap: 1rem;
			padding: 1rem;
			border-bottom: 1px solid #eee;
		}
		.order-item img {
			width: 80px;
			height: 80px;
			object-fit: cover;
			border-radius: 4px;
		}
		.success-message {
			text-align: center;
			color: #22c55e;
			margin-bottom: 2rem;
		}
		.back-button {
			display: inline-block;
			padding: 0.5rem 1rem;
			background: var(--primary-color);
			color: white;
			text-decoration: none;
			border-radius: 4px;
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

	<div class="confirmation-container">
		<div class="success-message">
			<h1>Order Confirmed!</h1>
			<p>Thank you for your purchase</p>
		</div>

		<div class="order-details">
			<h2>Order #<?php echo $order['id']; ?></h2>
			<p>Date: <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
			<p>Name: <?php echo htmlspecialchars($order['name']); ?></p>
			<p>Email: <?php echo htmlspecialchars($order['email']); ?></p>
			<p>Address: <?php echo htmlspecialchars($order['address']); ?></p>
			<p>Phone: <?php echo htmlspecialchars($order['phone']); ?></p>
			<p>Status: <?php echo ucfirst($order['status']); ?></p>
		</div>

		<div class="order-items">
			<h2>Order Items</h2>
			<?php foreach ($items as $item): ?>
			<div class="order-item">
				<img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
				<div>
					<h3><?php echo htmlspecialchars($item['name']); ?></h3>
					<p>Quantity: <?php echo $item['quantity']; ?></p>
				</div>
				<div>
					<p>$<?php echo number_format($item['price'], 2); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
			
			<div class="total" style="text-align: right; margin-top: 1rem;">
				<h3>Total: $<?php echo number_format($order['total_amount'], 2); ?></h3>
			</div>
		</div>

		<a href="index.php" class="back-button">Continue Shopping</a>
	</div>
</body>
</html>