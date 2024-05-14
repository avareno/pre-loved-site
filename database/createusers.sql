CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR NOT NULL,
    permissions VARCHAR(50) NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    small_description VARCHAR(255),
    country Varchar(50),
    city VARCHAR(50),
    phone_number VARCHAR(13),
    image VARCHAR DEFAULT '../../../assets/Default_pfp.svg.png'
);


INSERT INTO users (username, email, password, permissions) VALUES 
    ('admin','admin@m.m','$2y$10$SlJh9XD5Cm8UXvS0Q8xwUeNFAY4wvVN/wlU4crXOLgNIoJAhGNGSG','admin')/*admin, admin123

;