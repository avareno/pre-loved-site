CREATE TABLE products(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(50),
    category VARCHAR(100),
    seller_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (title, description, price, condition, category, seller_id) VALUES 
    ('iPhone X', 'Used iPhone X in good condition', 500.00, 'Used', 'Electronics', 1),
    ('Vintage Leather Jacket', 'Classic leather jacket in excellent condition', 100.00, 'Like New', 'Clothing', 2),
    ('Nintendo Switch', 'Nintendo Switch console with accessories', 300.00, 'Used', 'Electronics', 3),
    ('Antique Silverware Set', 'Vintage silverware set from the 1920s', 200.00, 'Refurbished', 'Home & Garden', 1),
    ('Golf Clubs', 'Complete set of golf clubs with bag', 150.00, 'Used', 'Sports', 4),
    ('Samsung Galaxy S10', 'Brand new Samsung Galaxy S10', 600.00, 'New', 'Electronics', 2),
    ('Sony PlayStation 5', 'Next-gen gaming console', 700.00, 'New', 'Electronics', 1),
    ('MacBook Pro', 'Latest model MacBook Pro with Retina display', 1500.00, 'New', 'Electronics', 3),
    ('Canon EOS Rebel T7i', 'DSLR camera with advanced features', 800.00, 'Used', 'Electronics', 4),
    ('Apple AirPods Pro', 'Wireless earbuds with active noise cancellation', 250.00, 'New', 'Electronics', 5),
    ('Nike Air Max 270', 'Stylish and comfortable athletic shoes', 120.00, 'New', 'Fashion', 6),
    ('Sony WH-1000XM4', 'Premium wireless noise-canceling headphones', 350.00, 'New', 'Electronics', 7)
;

UPDATE products 
SET created_at = '2024-04-24 08:00:00' 
WHERE title = 'Antique Silverware Set';

UPDATE products 
SET created_at = '2024-04-24 09:00:00' 
WHERE title = 'Golf Clubs';

UPDATE products 
SET created_at = '2024-04-24 10:00:00' 
WHERE title = 'Samsung Galaxy S10';

UPDATE products 
SET created_at = '2024-04-24 11:00:00' 
WHERE title = 'Sony PlayStation 5';

UPDATE products 
SET created_at = '2024-04-24 12:00:00' 
WHERE title = 'MacBook Pro';

UPDATE products 
SET created_at = '2024-04-24 13:00:00' 
WHERE title = 'Canon EOS Rebel T7i';

UPDATE products 
SET created_at = '2024-04-24 14:00:00' 
WHERE title = 'Apple AirPods Pro';

UPDATE products 
SET created_at = '2024-04-24 15:00:00' 
WHERE title = 'Nike Air Max 270';

UPDATE products 
SET created_at = '2024-04-24 16:00:00' 
WHERE title = 'Sony WH-1000XM4';

