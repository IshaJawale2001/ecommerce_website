# ecommerce_website

# Laravel E-Commerce CMS & API with Razorpay Integration

This is a Laravel-based e-commerce backend application featuring admin product management (with multiple images), cart functionality, API endpoints, and Razorpay test payment gateway integration. Designed to meet real-world project requirements with clean code, a good UI, and complete backend logic.

---

## ✅ Features

- Admin Login System (secured with fixed credentials)
- Product CRUD (Add, Edit, Delete, List) with multiple image uploads
- Add to Cart (API + CMS view)
- Cart Item Update/Delete (API)
- Checkout via Razorpay (Test Mode)
- Order Listing and Order Detail View
- REST APIs with proper response formats

---

## 📌 Admin Credentials

- **Email:** isha123@gmail.com
- **Password:** Pass@123

---

## 🚀 Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/IshaJawale2001/ecommerce_website.git
   cd ecommerce_website 

2. Install PHP & JS Dependencies
composer install
npm install && npm run build

3. Set Up Environment
Copy .env.example to .env

Update DB & Razorpay keys:
DB_DATABASE=ecommerce_website 
DB_USERNAME=root
DB_PASSWORD=

RAZORPAY_KEY=rzp_test_Ng1Ly4na8v8BLk
RAZORPAY_SECRET=wjHFJaDDlcztSFJ2iTaV4ib8

4. Import SQL
Import the included file: ecommerce_website.sql into MySQL (v8+)
5. Run the Application
6. Login as Admin
Go to: http://localhost:8000/admin/login  OR   
php -S localhost:9000 -t public  

Razorpay Test Payment
Use the following test card for payment simulation:

Card No: 4111 1111 1111 1111

Expiry: Any future date

CVV: Any 3 digits

OTP: 123456

API Collection
Postman collection is included as ecommerce_postman_collection.json.

Required Packages
Laravel 12

PHP >= 8.1

MySQL >= 8

Composer

Node.js

Razorpay PHP SDK (razorpay/razorpay)
composer require razorpay/razorpay

 APIs Overview:
GET /api/products — List products with images

POST /api/cart — Add to cart

GET /api/cart — View cart

PUT /api/cart/{id} — Update quantity

DELETE /api/cart/{id} — Remove item

POST /api/checkout — Checkout and place order
