CREATE TABLE images(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(50) REFERENCES products(title),
    img_url VARCHAR DEFAULT '../../assets/images.png',--remover isto da db
    carousel_img VARCHAR DEFAULT '../../assets/images.png',
    product_id INTEGER,
    FOREIGN KEY (product_id) REFERENCES products(id)
);


INSERT INTO images (title, img_url, carousel_img, product_id) VALUES 
    ('iPhone X', '', '../../assets/iphonex_carousel_img.jpg', (SELECT id FROM products WHERE title = 'iPhone X')),
    ('Vintage Leather Jacket', '', '../../assets/leather_jacket_carousel_img.jpg',  (SELECT id FROM products WHERE title = 'Vintage Leather Jacket')),
    ('Nintendo Switch', '', '../../assets/nintendo_carousel_img.jpg', (SELECT id FROM products WHERE title = 'Nintendo Switch')),
    ('Antique Silverware Set', '', '../../assets/silverware_carousel_img.jpg', (SELECT id FROM products WHERE title = 'Antique Silverware Set')),
    ('Golf Clubs', '', '../../assets/golf_clubs_carousel_img.jpg',  (SELECT id FROM products WHERE title = 'Golf Clubs')),
    ('Samsung Galaxy S10', '', '../../assets/samsung_carousel_img.jpg', (SELECT id FROM products WHERE title = 'Samsung Galaxy S10')),
    ('Sony PlayStation 5', '', '../../assets/ps5_carousel_img.jpg', (SELECT id FROM products WHERE title = 'Sony PlayStation 5')),
    ('MacBook Pro', '', '../../assets/macbook_carousel_img.jpg', (SELECT id FROM products WHERE title = 'MacBook Pro')),
    ('Canon EOS Rebel T7i', '', '../../assets/canon_carousel_img.jpg',  (SELECT id FROM products WHERE title = 'Canon EOS Rebel T7i')),
    ('Apple AirPods Pro', '', '../../assets/airpods_carousel_img.jpg',  (SELECT id FROM products WHERE title = 'Apple AirPods Pro')),
    ('Nike Air Max 270', '', '../../assets/nike_carousel_img.jpeg', (SELECT id FROM products WHERE title = 'Nike Air Max 270')),
    ('Sony WH-1000XM4', '', '../../assets/phones_carousel_img.jpg', (SELECT id FROM products WHERE title = 'Sony WH-1000XM4'))
;