CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR NOT NULL,
    permissions VARCHAR(50) NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (username, email, password, permissions) VALUES 
    ('luis', 'luis@example.com', '12345', 'admin'),
    ('miguel', 'miguel@example.com', '12345', 'admin'),
    ('tomas', 'tomas@example.com', '12345', 'admin')
;