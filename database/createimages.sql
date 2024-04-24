CREATE TABLE images(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(50) REFERENCES products(title),
    img_url VARCHAR,
    carousel_img VARCHAR,
    product_id INTEGER,
    FOREIGN KEY (product_id) REFERENCES products(id)
);


INSERT INTO images (title, img_url, carousel_img, product_id) VALUES 
    ('iPhone X', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'iPhone X')),
    ('Vintage Leather Jacket', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg',  (SELECT id FROM products WHERE title = 'Vintage Leather Jacket')),
    ('Nintendo Switch', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Nintendo Switch')),
    ('Antique Silverware Set', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Antique Silverware Set')),
    ('Golf Clubs', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg',  (SELECT id FROM products WHERE title = 'Golf Clubs')),
    ('Samsung Galaxy S10', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Samsung Galaxy S10')),
    ('Sony PlayStation 5', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Sony PlayStation 5')),
    ('MacBook Pro', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'MacBook Pro')),
    ('Canon EOS Rebel T7i', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg',  (SELECT id FROM products WHERE title = 'Canon EOS Rebel T7i')),
    ('Apple AirPods Pro', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg',  (SELECT id FROM products WHERE title = 'Apple AirPods Pro')),
    ('Nike Air Max 270', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Nike Air Max 270')),
    ('Sony WH-1000XM4', '', 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg', (SELECT id FROM products WHERE title = 'Sony WH-1000XM4'))
;