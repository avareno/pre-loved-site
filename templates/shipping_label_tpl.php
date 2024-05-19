<?php
function drawShippingLabel($db, $sold_product){
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shipping Label</title>
        <link rel="stylesheet" href="../../css/shipping.css">
    </head>
    <body>
    <section class="shipping-label">
                <h1>Shipping Label</h1>
                <p><strong>Product:</strong> <?php echo htmlspecialchars($sold_product['title']); ?></p>
                <p><strong>Buyer:</strong> <?php echo htmlspecialchars($sold_product['buyer_username']); ?></p>
                <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($sold_product['buyer_city']) . ', ' . htmlspecialchars($sold_product['buyer_country']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($sold_product['buyer_phone']); ?></p>
                <p><strong>Order Number:</strong> <?php echo htmlspecialchars($sold_product['id']); ?></p>
                <p>© <?php echo date("Y"); ?> LMT. All rights reserved.</p>
</section>
    </body>
    </html>
<?php    
}
?>