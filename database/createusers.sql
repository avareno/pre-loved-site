CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR NOT NULL,
    permissions VARCHAR(50) NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (username, email, password, permissions) VALUES 
    ('luis', 'luis@example.com', 'admin_password_hash', 'admin'),
    ('miguel', 'miguel@example.com', 'buyer_password_hash', 'buyer'),
    ('tomas', 'tomas@example.com', 'seller_password_hash', 'seller'),
    ('restivo', 'restivo@example.com', 'both_password_hash', 'buyer,seller')
;