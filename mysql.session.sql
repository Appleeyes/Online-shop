-- USERS TABLE
CREATE TABLE `users` (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    thumbnail VARCHAR(30) NOT NULL,
    is_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = no, 1 = yes'
);

-- CATEGORIES TABLE
CREATE TABLE `categories` (
    category_id TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL
);

-- PRODUCTS TABLE
CREATE TABLE `products` (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    thumbnail VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category_id TINYINT NOT NULL,
    is_featured TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = yes, 1 = no',
    FOREIGN KEY(category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- REVIEWS TABLE
CREATE TABLE `reviews` (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    review TEXT NOT NULL,
    rating TINYINT NOT NULL,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- ORDERS TABLE
CREATE TABLE `orders` (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    size VARCHAR(50) NOT NULL,
    quantity TINYINT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    product_id INT NOT NULL,
    is_paid TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = not paid, 1 = paid',
    FOREIGN KEY(product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

ALTER TABLE `products`
ADD is_new TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = yes, 1 = no';


CREATE TABLE carts (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    size VARCHAR(10),
    quantity INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
