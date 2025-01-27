# Setup Instructions for ShopHub E-Commerce

## Required Software
1. Install XAMPP (or WAMP) from:
   - XAMPP: https://www.apachefriends.org/
   - WAMP: https://www.wampserver.com/

## Installation Steps

1. Start XAMPP/WAMP:
   - Start Apache and MySQL services
   - Verify they are running (green indicators)

2. Database Setup:
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create new database named 'ecommerce'
   - Import database/ecommerce.sql

3. Website Setup:
   - Copy entire 'ecommerce' folder to:
	 * XAMPP: C:/xampp/htdocs/
	 * WAMP: C:/wamp64/www/

4. Access Website:
   - Open browser
   - Go to: http://localhost/ecommerce/
   - Do NOT open files directly from file system

## Common Issues

1. If seeing PHP code instead of rendered pages:
   - Ensure Apache is running
   - Access through localhost URL, not file system
   - Check PHP is enabled in Apache

2. Database connection issues:
   - Verify MySQL is running
   - Check credentials in php/db_connect.php
   - Default: username='root', password=''

3. 404 errors:
   - Ensure folder is in correct location
   - Check all file permissions
   - Verify Apache configuration