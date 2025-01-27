# ShopHub E-Commerce Website

A modern e-commerce website that provides user authentication, product management, and shopping cart functionality. Admins have full control over the site, with the ability to manage products, categories, orders, and users.

## Features

### **For Users:**
- **User Authentication**: Users can register and log in to access their account.
- **Product Catalog**: Users can browse through various products available in the store.
- **Shopping Cart**: Users can add products to their cart and view the cart’s contents.
- **Order Management**: Users can place orders and view their past order history.

### **For Admin:**
- **Admin Login**: Admin can securely log in to manage the website.
  - **Admin Login Link**: [http://localhost/ecommerce/admin/login.php](http://localhost/ecommerce/admin/login.php)
- **Dashboard Overview**: Admin can view an overview of:
  - Total Products
  - Total Orders
  - Low Stock Items
  - Total Users
- **Product Management**: Admin can:
  - Add new products
  - Edit or delete existing products
- **Category Management**: Admin can:
  - Add new categories
  - Edit or delete existing categories
- **Order Management**: Admin can view details of each order and change its status.
- **User Management**: Admin can remove users from the system.

## Installation

Follow these steps to get the **ShopHub E-Commerce Website** running locally:

### **Database Setup:**

1. **Install and Start XAMPP/WAMP Server:**
   - Download and install [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/).
   - Start the Apache and MySQL services.

2. **Create the Database:**
   - Open [phpMyAdmin](http://localhost/phpmyadmin) in your browser.
   - Create a new database called **ecommerce**.
   - Import the provided `database/ecommerce.sql` file into the newly created database. This will set up the required tables and sample data.

### **Configuration:**

1. **Update Database Connection:**
   - Open the file `php/db_connect.php`.
   - Ensure the database connection settings are as follows:
     ```php
     $host = 'localhost';
     $dbname = 'ecommerce';
     $username = 'root';
     $password = ''; // Default is empty
     ```

### **Running the Website:**

1. **Place Project Folder:**
   - Copy the `ecommerce` project folder to the following location based on your server:
     - For **XAMPP**: `xampp/htdocs/ecommerce`
     - For **WAMP**: `wamp/www/ecommerce`

2. **Start the Web Server:**
   - Start Apache and MySQL services in XAMPP/WAMP.

3. **Access the Website:**
   - Open your browser and navigate to:
     - **User Landing Page**: [http://localhost/ecommerce/index.php](http://localhost/ecommerce/index.php)
     - **Admin Login Page**: [http://localhost/ecommerce/admin/login.php](http://localhost/ecommerce/admin/login.php)

## Database Structure

The website uses the following database tables:

- **Users Table**: Stores user account information.
- **Products Table**: Stores product details including name, price, stock, etc.
- **Cart Table**: Manages items added to the shopping cart.
- **Orders Table**: Manages placed orders with their statuses.

## Security Features

The application includes the following security measures to ensure safe usage:

- **Password Hashing**: All user passwords are hashed before being stored in the database.
- **SQL Injection Prevention**: Prepared statements are used to protect against SQL injection attacks.
- **Input Validation**: User inputs are validated to prevent malicious data.
- **Session Management**: Proper session handling ensures users and admins are securely logged in.

## Access Control:

### **For Users:**
- **Registration & Login**: Users can create an account and log in to view their cart and place orders.
- **Product Viewing & Cart Management**: Users can add products to their cart and place an order once they’re ready.

### **For Admin:**
- **Admin Panel**: Admins can log in to access a comprehensive dashboard where they can view:
  - Total products
  - Total orders
  - Low-stock items
  - Total registered users
- **Product Management**: Admins can add new products, or edit/delete existing ones.
- **Category Management**: Admins can manage product categories (add, edit, delete).
- **Order Management**: Admins can view all orders and manage their statuses.
- **User Management**: Admins can remove users from the system as necessary.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP/WAMP

## Contributing

We welcome contributions! If you have suggestions or improvements, feel free to:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add new feature'`).
5. Push to your forked repository (`git push origin feature-branch`).
6. Submit a pull request for review.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or need support, feel free to reach out:

- **Email**: [your-email@example.com](mailto:your-email@example.com)
- **GitHub**: [https://github.com/meltash](https://github.com/meltash)

