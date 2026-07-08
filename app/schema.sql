DROP DATABASE IF EXISTS myprojectdb;
CREATE DATABASE myprojectdb;
USE myprojectdb;

-- ===========================
-- MENU ITEMS TABLE
-- ===========================

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    image_url VARCHAR(255) DEFAULT 'images/placeholder.jpg'
);

-- ===========================
-- ORDERS TABLE
-- ===========================

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(30) DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===========================
-- ORDER ITEMS TABLE
-- ===========================

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,

    FOREIGN KEY (order_id)
        REFERENCES orders(id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES menu_items(id)
);

-- ===========================
-- SAMPLE MENU DATA
-- ===========================

INSERT INTO menu_items
(name, description, price, category, image_url)
VALUES
(
'Classic Burger',
'Juicy grilled chicken burger',
199.00,
'Burger',
'images/burger.jpg'
),

(
'Veggie Burger',
'Healthy veggie burger',
179.00,
'Burger',
'images/veggieburger.jpg'
),

(
'Mix Drink',
'Refreshing cold drink',
99.00,
'Drinks',
'images/mixdrink.jpg'
),

(
'French Fries',
'Crispy golden fries',
129.00,
'Snacks',
'images/placeholder.jpg'
),

(
'Pizza',
'Cheesy Veg Pizza',
299.00,
'Pizza',
'images/placeholder.jpg'
),

(
'Chicken Pizza',
'Loaded chicken pizza',
349.00,
'Pizza',
'images/placeholder.jpg'
),

(
'Ice Cream',
'Vanilla Ice Cream',
89.00,
'Desserts',
'images/placeholder.jpg'
),

(
'Brownie',
'Chocolate Brownie',
149.00,
'Desserts',
'images/placeholder.jpg'
);

-- ===========================
-- SAMPLE ORDER
-- ===========================

INSERT INTO orders
(
customer_name,
phone,
address,
payment_method,
total_price,
status
)
VALUES
(
'Demo Customer',
'9876543210',
'Chennai',
'Cash on Delivery',
398.00,
'Pending'
);

INSERT INTO order_items
(
order_id,
product_id,
quantity
)
VALUES
(1,1,2);