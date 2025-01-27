# ShopHub E-Commerce Website

A modern e-commerce website with user authentication, product management, and shopping cart functionality.

## Database Setup

1. Install and start XAMPP/WAMP server
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create a new database:
   - Import the `database/ecommerce.sql` file
   - This will create all necessary tables and sample data

## Configuration

1. Update database connection settings in `php/db_connect.php` if needed:
   - Host: localhost
   - Database: ecommerce
   - Username: root
   - Password: (empty by default)

## Running the Website

1. Place the project folder in your web server directory:
   - For XAMPP: `xampp/htdocs/ecommerce`
   - For WAMP: `wamp/www/ecommerce`

2. Start your web server (Apache and MySQL)

3. Access the website:
   - Open browser and go to: `http://localhost/ecommerce`

## Features

- User Authentication (Register/Login)
- Product Catalog
- Shopping Cart
- Stock Management
- Responsive Design

## Default Database Structure

- Users Table: Stores user accounts
- Products Table: Stores product information
- Cart Table: Manages shopping cart items

## Security Features

- Password Hashing
- SQL Injection Prevention
- Input Validation
- Session Management