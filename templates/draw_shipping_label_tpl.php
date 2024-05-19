<?php
function drawShippingLabel($db, $sold_product){
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shipping Label</title>
        <link rel="stylesheet" href="../../css/shipping_label.css">
    </head>
    <body>
    <section class="shipping-label">
            <h1>Shipping Label</h1>
            <p><strong>Product:</strong> <?php echo htmlspecialchars($sold_product['title']); ?></p>
            <p><strong>Buyer:</strong> [Insert Buyer Name]</p>
            <p><strong>Shipping Address:</strong> [Insert Shipping Address]</p>
            <p><strong>Order Date:</strong> [Insert Order Date]</p>
            <p><strong>Order Number:</strong> <?php echo htmlspecialchars($sold_product['id']); ?></p>
</section>
    </body>
    </html>
<?php    
}
?>