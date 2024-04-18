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
    ('Golf Clubs', 'Complete set of golf clubs with bag', 150.00, 'Used', 'Sports', 4)
    ;
