
# **ShopHub E-Commerce Website 🛍️**

A modern e-commerce platform with user authentication, product management, shopping cart functionality, and an easy-to-use admin panel for efficient store management. Perfect for managing products, orders, categories, users, and more.

---

## 👤 **About Me**

Hi there! I'm **Geofery Mwathi**, a passionate web developer with a love for building dynamic and user-friendly web applications. I specialize in front-end and back-end development, with expertise in PHP, JavaScript, HTML/CSS, and various modern frameworks. When I'm not coding, you can find me exploring new technologies or playing around with design tools.

---

## 🚀 **Features**

### **For Users:**
- **🔐 User Authentication**: Register and log in to access personalized features.
- **📦 Product Catalog**: Browse a wide range of products.
- **🛒 Shopping Cart**: Add products to your cart and proceed to checkout.
- **📜 Order History**: Track and view past orders.

### **For Admins:**
- **🖥️ Admin Login**: Secure admin login to access the dashboard.
  - [Admin Login Page](http://localhost/ecommerce/admin/login.php)
- **📊 Dashboard**: View key metrics like total products, orders, low-stock items, and more.
- **🛠️ Product Management**: Add, edit, or delete products in the catalog.
- **📂 Category Management**: Create, update, or delete product categories.
- **📑 Order Management**: Manage and update the status of customer orders.
- **👤 User Management**: Remove users from the system if needed.

---

## 🛠️ **Technologies Used**

This project is built with the following technologies:

### **Frontend:**
- **HTML5** 📄
- **CSS3** 🎨
- **JavaScript** ⚡
- **Tailwind CSS** 💨 (for styling)

### **Backend:**
- **PHP** 🖥️
- **MySQL** 🗄️ (for database management)

---

## **Installation Guide** 📦

### 1. **Database Setup:**

- **Install XAMPP/WAMP**:
   - Download and install [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/).
   - Start **Apache** and **MySQL** services.

- **Create and Import Database**:
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a new database named **ecommerce**.
   - Import the `database/ecommerce.sql` file to create the necessary tables.

### 2. **Configuration:**
- Update database connection details in `php/db_connect.php` (if necessary):
  ```php
  $host = 'localhost';
  $dbname = 'ecommerce';
  $username = 'root';
  $password = ''; // Default is empty
  ```

### 3. **Running the Website:**
- **Place the project folder** in your web server directory:
  - For **XAMPP**: `xampp/htdocs/ecommerce`
  - For **WAMP**: `wamp/www/ecommerce`

- Start Apache and MySQL.

- Open your browser and navigate to:
  - **User Landing Page**: [http://localhost/ecommerce/index.php](http://localhost/ecommerce/index.php)
  - **Admin Login**: [http://localhost/ecommerce/admin/login.php](http://localhost/ecommerce/admin/login.php)

---

## **Database Structure** 🗃️

- **Users Table**: Stores user account details.
- **Products Table**: Stores product details (name, price, stock, etc.).
- **Cart Table**: Manages cart items.
- **Orders Table**: Keeps track of customer orders and their status.

---

## **Security Features** 🔐

- **Password Hashing**: All user passwords are securely hashed.
- **SQL Injection Prevention**: Prepared statements are used to protect against SQL injection.
- **Input Validation**: All user inputs are validated before being processed.
- **Session Management**: Ensures users and admins remain securely logged in.

---

## **Preview** 📸

### **User Interface:**

#### Homepage:
![Homepage Preview](images/homepage-preview.jpg)

#### Product Page:
![Product Page Preview](images/product-page-preview.jpg)

### **Admin Dashboard:**

#### Admin Login:
![Admin Login Preview](images/admin-login-preview.jpg)

#### Admin Dashboard:
![Admin Dashboard Preview](images/admin-dashboard-preview.jpg)

---

## 💡 **How to Contribute** 🌱

Feel free to contribute to this project:

1. **Fork the Repository**: Create a copy of this repository.
2. **Create a New Branch**: `git checkout -b feature-branch`.
3. **Make Changes**: Add your feature or fix bugs.
4. **Commit Changes**: `git commit -m 'Add new feature'`.
5. **Push to Your Fork**: `git push origin feature-branch`.
6. **Create a Pull Request**: Open a pull request for review.

---

## 📬 **Contact Me**

- **Email**: [your-email@example.com](mailto:your-email@example.com)
- **GitHub**: [https://github.com/meltash](https://github.com/meltash)
- **LinkedIn**: [https://linkedin.com/in/yourprofile](https://linkedin.com/in/yourprofile)

---

## **License** 📜

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

### **Made with ❤️ by Geofery Mwathi**

![users](https://github.com/user-attachments/assets/2478e0ab-ff8d-43a7-83b6-b01e78c3c956)
![user home](https://github.com/user-attachments/assets/172f0de4-86ea-457b-b970-01a50bd5f0b2)
![products](https://github.com/user-attachments/assets/d1a785a4-0706-4454-8c88-e3c39410ddeb)
![products admin](https://github.com/user-attachments/assets/7fdabe3f-99ad-489f-832c-4252b8843229)
![orders](https://github.com/user-attachments/assets/db364bc2-ee22-4a2f-8125-10a07745910e)
![categories](https://github.com/user-attachments/assets/bcd0303f-11db-43ac-9d84-4227352878a3)
![cart](https://github.com/user-attachments/assets/12175424-629f-455a-b960-84eb9700dd7c)
![admin](https://github.com/user-attachments/assets/0ddf9930-028d-44cf-99fe-30066fa79e98)

